@extends('layouts.admin.template')

@section('content')

<div class="card custom-card">

    <div class="card-header">

        <div class="card-title">

            Generate Report Bill

        </div>

    </div>

    <div class="card-body">

        <form method="POST"
            action="{{ route('service-bills.report.store') }}">

            @csrf

            <input type="hidden"
                name="service_type"
                value="{{ $service_type }}">

            <input type="hidden"
                name="request_id"
                value="{{ $request_id }}">

            <input type="hidden"
                name="processing_fee"
                id="processingFee"
                value="{{ $reportFee->processing_fee }}">

            <input type="hidden"
                name="cgst_percent"
                id="cgstPercent"
                value="{{ $reportFee->cgst_percent }}">

            <input type="hidden"
                name="sgst_percent"
                id="sgstPercent"
                value="{{ $reportFee->sgst_percent }}">

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            Service Type
                        </label>

                        <input type="text"
                            class="form-control"
                            value="{{ ucwords(str_replace('_',' ',$service_type)) }}"
                            readonly>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            Request ID
                        </label>

                        <input type="text"
                            class="form-control"
                            value="{{ $request_id }}"
                            readonly>

                    </div>

                </div>

            </div>

            <div class="card mt-3">

                <div class="card-header bg-primary text-white">

                    Billing Summary

                </div>

                <div class="card-body p-0">

                    <table class="table table-bordered mb-0">

                        <tr>

                            <th width="70%">
                                Processing Fee
                            </th>

                            <td width="30%">

                                ₹ {{ number_format($reportFee->processing_fee,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>
                                CGST @ {{ $reportFee->cgst_percent }}%
                            </th>

                            <td>

                                ₹ {{ number_format(($reportFee->processing_fee * $reportFee->cgst_percent)/100,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>
                                SGST @ {{ $reportFee->sgst_percent }}%
                            </th>

                            <td>

                                ₹ {{ number_format(($reportFee->processing_fee * $reportFee->sgst_percent)/100,2) }}

                            </td>

                        </tr>

                        <tr class="table-primary">

                            <th>
                                Total Amount
                            </th>

                            <th>

                                ₹

                                {{ number_format(
$reportFee->processing_fee +
(($reportFee->processing_fee * $reportFee->cgst_percent)/100) +
(($reportFee->processing_fee * $reportFee->sgst_percent)/100)
,2) }}

                            </th>

                        </tr>

                    </table>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                    class="btn btn-success">

                    Generate Bill

                </button>

            </div>

        </form>

    </div>

</div>

@endsection