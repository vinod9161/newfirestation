<?php

namespace App\Http\Controllers;
require_once app_path('Libraries/requests/library/Requests.php');

\Requests::register_autoloader();

require_once app_path('Libraries/razorpay_loader.php');

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Service;
use App\Models\PricingRule;
use App\Models\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ServiceBill;
use App\Models\Models\Standby;
use App\Services\SmsService;

class PaymentController extends Controller
{
    public function index($service_type, $reference_id)
    {
        $service = null;
        $payment = null;
        $title = '';

        $covered_area = 0;
        $per_meter_rate = 0;
        $noc_charges = 0;
        $processing_fee = 0;

        $cgst_percent = 9;
        $sgst_percent = 9;

        $cgst_amount = 0;
        $sgst_amount = 0;
        $total_amount = 0;

        if (in_array($service_type, ['pre-establishment', 'pre-operational', 'periodic-renewal'])) {

            $serviceMaster = Service::where('code', strtoupper($service_type))->first();

            if (!$serviceMaster) {
                abort(404, 'Service not found');
            }

            $service = Application::where('application_no', $reference_id)->firstOrFail();

            $title = 'NOC Application Payment';

            $coveredAreaData = json_decode($service->total_covered_area, true);

            $covered_area = (float) ($coveredAreaData['total_covered_area'] ?? 0);

            $pricingRule = PricingRule::where('service_id', $serviceMaster->id)->first();

            if (!$pricingRule) {
                abort(404, 'Pricing rule not found');
            }

            $per_meter_rate = (float) ($pricingRule->rate ?? 0);
            $processing_fee = (float) ($pricingRule->processing_fee ?? 0);

            $noc_charges = $covered_area * $per_meter_rate;

            $taxable_amount = $noc_charges + $processing_fee;

            $cgst_amount = ($taxable_amount * $cgst_percent) / 100;
            $sgst_amount = ($taxable_amount * $sgst_percent) / 100;

            $total_amount = $taxable_amount + $cgst_amount + $sgst_amount;

        } elseif (in_array($service_type, [
            'standby_duty',
            'pumping_work',
            'fire_report',
            'rescue_report',
            'relief_report'
        ])) {

            $service = ServiceBill::findOrFail($reference_id);
            $title = 'Service Bill Payment';
            $processing_fee = $service->processing_fee ?? 0;
            $cgst_amount = $service->cgst_amount;
            $sgst_amount = $service->sgst_amount;
            $total_amount = $service->total_amount;
            if ($service->payment_status == 'paid') {
                return redirect()
                    ->route('service-bills.show', $service->id)
                    ->with('success', 'Bill already paid.');
            }
        }

        $payment = Payment::where('service_type', $service_type)
            ->where('service_id', $reference_id)->latest()->first();

        return view('payments.index', compact(
            'service',
            'payment',
            'service_type',
            'reference_id',
            'title',
            'covered_area',
            'per_meter_rate',
            'noc_charges',
            'processing_fee',
            'cgst_percent',
            'sgst_percent',
            'cgst_amount',
            'sgst_amount',
            'total_amount'
        ));
    }

    public function createOrder(Request $request)
    {
        $key = env('RAZORPAY_KEY');
        $secret = env('RAZORPAY_SECRET');
        if(in_array($request->service_type,['standby_duty','pumping_work','fire_report','rescue_report','relief_report'])){
            $bill=ServiceBill::findOrFail($request->reference_id);
            if($bill->payment_status=='paid'){
                return response()->json(['status'=>false,'message'=>'Bill already paid.']);
            }
        }

        $api = new Api($key, $secret);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'service_type' => $request->service_type,
            'service_id' => $request->reference_id,
            'amount' => $request->amount,
            'status' => 'pending',
            'payment_gateway' => 'razorpay'
        ]);

        $amount = (int) round($request->amount * 100);

        $order = $api->order->create([
            'receipt' => 'PAY_' . $payment->id,
            'amount' => $amount,
            'currency' => 'INR'
        ]);

        $payment->update(['order_id' => $order['id']]);

        return response()->json([
            'status' => true,
            'key' => $key,
            'amount' => $amount,
            'order_id' => $order['id'],
            'payment_id' => $payment->id
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $payment=Payment::where('order_id', $request->razorpay_order_id)->first();
        if(!$payment){
            return response()->json([
                'status'=>false
            ]);
        }

        $payment->update([
            'transaction_id'=>$request->razorpay_payment_id,
            'status'=>'success',
            'paid_at'=>now(),
            'response'=>json_encode($request->all())
        ]);

        if(in_array($payment->service_type,[
            'pre-establishment',
            'pre-operational',
            'periodic-renewal'
        ])){
            Application::where(
                    'application_no',
                    $payment->service_id
                )
                ->update([
                    'payment_status'=>'paid',
                    'payment_amount'=>$payment->amount,
                    'payment_date'=>now(),
                    'transaction_id'=>$request->razorpay_payment_id
                ]);

            $application = Application::where(
                'application_no',
                $payment->service_id
            )->first();

            if ($application) {
                $smsService = app(SmsService::class);
                $smsService->send(
                    'PAYMENT_SUCCESS',
                    $application->mobile_no,
                    [
                        'AMOUNT' => number_format($payment->amount, 2),
                        'UIID'   => $application->application_no
                    ]
                );
            }

        }
        else{

            $bill=ServiceBill::find(
                $payment->service_id
            );

            if($bill){

                $bill->update([
                    'payment_status'=>'paid',
                    'payment_id'=>$payment->id,
                    'payment_method'=>'razorpay',
                    'transaction_id'=>$request->razorpay_payment_id,
                    'paid_at'=>now()
                ]);

                $smsService = app(SmsService::class);

                if($bill->service_type=='standby_duty'){
                    Standby::where(
                        'application_id',
                        $bill->service_request_id
                    )
                    ->update([
                        'payment_status'=>'paid',
                        'paid_at'=>now()
                    ]);

                    $standby = Standby::find($bill->service_request_id);

                    if ($standby && !empty($standby->mobile_no)) {
                        $smsService->send(
                            'PAYMENT_SUCCESS',
                            $standby->mobile_no,
                            [
                                'AMOUNT' => number_format($payment->amount, 2),
                                'UIID'   => $standby->application_id
                            ]
                        );
                    }
                }

                if($bill->service_type=='fire_report'){

                    DB::table('fs_fire_report')
                        ->where(
                            'id',
                            $bill->service_request_id
                        )
                        ->update([
                            'payment_status'=>'paid'
                        ]);

                    $report = DB::table('fs_fire_report')
                        ->where('id', $bill->service_request_id)
                        ->first();

                    if ($report && !empty($report->informer_contact_no)) {
                        $smsService->send(
                            'PAYMENT_SUCCESS',
                            $report->informer_contact_no,
                            [
                                'AMOUNT' => number_format($payment->amount, 2),
                                'UIID'   => $report->fire_report_no
                            ]
                        );
                    }

                }elseif($bill->service_type=='rescue_report'){

                    DB::table('fs_rescue_report')
                        ->where(
                            'id',
                            $bill->service_request_id
                        )
                        ->update([
                            'payment_status'=>'paid'
                        ]);

                    $report = DB::table('fs_rescue_report')
                        ->where('id', $bill->service_request_id)
                        ->first();

                    if ($report && !empty($report->informer_contact_no)) {

                        $smsService = app(\App\Services\SmsService::class);

                        $smsService->send(
                            'PAYMENT_SUCCESS',
                            $report->informer_contact_no,
                            [
                                'AMOUNT' => number_format($payment->amount, 2),
                                'UIID'   => $report->rescue_report_no
                            ]
                        );
                    }

                }elseif($bill->service_type=='relief_report'){
                    DB::table('fs_relief_work_report')
                        ->where(
                            'id',
                            $bill->service_request_id
                        )
                        ->update([
                            'payment_status'=>'paid'
                        ]);
                    
                    $report = DB::table('fs_relief_work_report')
                        ->where('id', $bill->service_request_id)
                        ->first();

                    if ($report && !empty($report->informer_contact_no)) {

                        $smsService = app(\App\Services\SmsService::class);

                        $smsService->send(
                            'PAYMENT_SUCCESS',
                            $report->informer_contact_no,
                            [
                                'AMOUNT' => number_format($payment->amount, 2),
                                'UIID'   => $report->relief_report_no
                            ]
                        );
                    }

                }elseif($bill->service_type=='pumping_work'){

                    DB::table('fs_fire_report')
                        ->where(
                            'id',
                            $bill->service_request_id
                        )
                        ->update([
                            'payment_status'=>'paid'
                        ]);

                    $report = DB::table('fs_fire_report')
                        ->where('id', $bill->service_request_id)
                        ->first();

                    if ($report && !empty($report->informer_contact_no)) {
                        $smsService->send(
                            'PAYMENT_SUCCESS',
                            $report->informer_contact_no,
                            [
                                'AMOUNT' => number_format($payment->amount, 2),
                                'UIID'   => $report->fire_report_no
                            ]
                        );
                    }

                }

            }

        }

        return response()->json([
            'status'=>true
        ]);
    }

    public function paymentSuccess($application_no)
    {
        $application=Application::where(
            'application_no',
            $application_no
        )->firstOrFail();

        $payment=Payment::where(
                'service_id',
                $application_no
            )
            ->where(
                'status',
                'success'
            )
            ->latest()
            ->first();

        return view('payments.success',compact(
            'application',
            'payment'
        ));
    }

    public function downloadInvoice($application_no)
    {
        $application=Application::where(
            'application_no',
            $application_no
        )->firstOrFail();

        $payment=Payment::where(
                'service_id',
                $application_no
            )
            ->where(
                'status',
                'success'
            )
            ->latest()
            ->firstOrFail();

        $serviceMaster=Service::where(
            'code',
            $payment->service_type
        )->first();

        $coveredAreaData=json_decode(
            $application->total_covered_area,
            true
        );

        $covered_area=(float)(
            $coveredAreaData['total_covered_area'] ?? 0
        );

        $pricingRule=PricingRule::where(
                'service_id',
                $serviceMaster->id
            )
            ->first();

        $per_meter_rate=(float)(
            $pricingRule->rate ?? 0
        );

        $processing_fee=(float)(
            $pricingRule->processing_fee ?? 0
        );

        $noc_charges=(
            $covered_area *
            $per_meter_rate
        );

        $taxable_amount=(
            $noc_charges +
            $processing_fee
        );

        $cgst_amount=(
            $taxable_amount * 9
        ) / 100;

        $sgst_amount=(
            $taxable_amount * 9
        ) / 100;

        $total_amount=(
            $taxable_amount +
            $cgst_amount +
            $sgst_amount
        );

        $pdf=Pdf::loadView(
            'payments.invoice',
            compact(
                'application',
                'payment',
                'covered_area',
                'per_meter_rate',
                'noc_charges',
                'processing_fee',
                'cgst_amount',
                'sgst_amount',
                'total_amount'
            )
        );

        $pdf->setPaper(
            'A4',
            'portrait'
        );

        $pdf->setOptions([
            'isHtml5ParserEnabled'=>true,
            'isPhpEnabled'=>true,
            'isRemoteEnabled'=>true,
            'defaultFont'=>'NotoSansDevanagari'
        ]);

        return $pdf->download(
            'Invoice_'.$application->application_no.'.pdf'
        );
    }

    public function invoice($application_no)
    {
        $application=Application::where(
            'application_no',
            $application_no
        )->firstOrFail();

        $payment=Payment::where(
                'service_id',
                $application_no
            )
            ->where(
                'status',
                'success'
            )
            ->latest()
            ->firstOrFail();

        $serviceMaster=Service::where(
            'code',
            strtoupper($payment->service_type)
        )->first();

        $coveredAreaData=json_decode(
            $application->total_covered_area,
            true
        );

        $covered_area=(float)(
            $coveredAreaData['total_covered_area'] ?? 0
        );

        $pricingRule=PricingRule::where(
                'service_id',
                $serviceMaster->id
            )
            ->first();

        $per_meter_rate=(float)(
            $pricingRule->rate ?? 0
        );

        $processing_fee=(float)(
            $pricingRule->processing_fee ?? 0
        );

        $noc_charges=(
            $covered_area *
            $per_meter_rate
        );

        $taxable_amount=(
            $noc_charges +
            $processing_fee
        );

        $cgst_amount=(
            $taxable_amount * 9
        ) / 100;

        $sgst_amount=(
            $taxable_amount * 9
        ) / 100;

        $total_amount=(
            $taxable_amount +
            $cgst_amount +
            $sgst_amount
        );

        return view(
            'payments.invoice',
            compact(
                'application',
                'payment',
                'covered_area',
                'per_meter_rate',
                'noc_charges',
                'processing_fee',
                'cgst_amount',
                'sgst_amount',
                'total_amount'
            )
        );
    }
}