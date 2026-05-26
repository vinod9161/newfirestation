<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Payment Invoice</title>

    <style>
        @font-face {
            font-family: 'NotoSansDevanagari';
            src:url('{{ asset('/storage/fonts/NotoSansDevanagari-Regular.ttf') }}') format('truetype');
        }

        body {
            font-family: 'NotoSansDevanagari', sans-serif;
            font-size: 12px;
            color: #000;
        }

        .main-wrapper {
            width: 95%;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #bdbdbd;
        }

        th,
        td {
            padding: 7px 10px;
            vertical-align: middle;
        }

        .section-heading {
            text-align: center;
            font-size: 30px;
            line-height: 24px;
            padding-top: 8px;
            /* margin-top: 10px; */
        }

        .sub-heading {
            text-align: center;
            font-size: 14px;
            /* font-weight:bold; */
            margin-top: 5px;
        }

        .text-center {
            text-align: center;
        }

        .border-none {
            border: none !important;
        }

        .gray-bg {
            background: #efefef;
            /* font-weight: bold; */
        }
    </style>

</head>

<body>

    <div class="main-wrapper">

        <table style="border:none;margin-top:0;">

            <tr>

                <td class="border-none" style="width:20%;text-align:left;">

                    <img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width:110px;">

                </td>

                <td class="border-none text-center" style="width:70%;">

                    <div class="section-heading">
                        उत्तराखंड अग्निशमन एवं आपात सेवा
                    </div>

                    <div class="section-heading">
                        Uttarakhand Fire & Emergency Service
                    </div>

                    <div style="margin-top:10px;line-height:20px;">
                        मुख्यालय - चतुर्थ तल, सरदार पटेल भवन <br>
                        कोर्ट रोड, देहरादून, उत्तराखंड - 248001 <br>
                        Headquarter - IV Floor, Sardar Patel Bhavan <br>
                        Court Road, Dehradun, Uttarakhand - 248001
                    </div>

                    <div class="sub-heading">
                        भुगतान चालान / PAYMENT INVOICE
                    </div>

                </td>


            </tr>

        </table>

        <table>

            <tr class="gray-bg">
                <th colspan="4" class="text-center">
                    Application Details
                </th>
            </tr>

            <tr>

                <th width="25%">
                    Application No
                </th>

                <td width="25%">
                    {{ $application->application_no }}
                </td>

                <th width="25%">
                    Payment Status
                </th>

                <td width="25%">
                    SUCCESS
                </td>

            </tr>

            <tr>

                <th>
                    Applicant Name
                </th>

                <td>
                    {{ $application->building_name }}
                </td>

                <th>
                    Payment Date
                </th>

                <td>
                    {{ date('d-m-Y h:i A',strtotime($payment->paid_at)) }}
                </td>

            </tr>

            <tr>

                <th>
                    Transaction ID
                </th>

                <td>
                    {{ $payment->transaction_id }}
                </td>

                <th>
                    Order ID
                </th>

                <td>
                    {{ $payment->order_id }}
                </td>

            </tr>

        </table>

        <table>

            <tr class="gray-bg">

                <th colspan="2" class="text-center">
                    Payment Calculation Details
                </th>

            </tr>

            <tr>

                <th width="70%">
                    Total Covered Area
                </th>

                <td width="30%">
                    {{ number_format($covered_area,2) }} Sq. Meter
                </td>

            </tr>

            <tr>

                <th>
                    Per Sq. Meter Rate
                </th>

                <td>
                    ₹ {{ number_format($per_meter_rate,2) }}
                </td>

            </tr>

            <tr>

                <th>
                    NOC Charges
                </th>

                <td>
                    ₹ {{ number_format($noc_charges,2) }}
                </td>

            </tr>

            <tr>

                <th>
                    Processing Fee
                </th>

                <td>
                    ₹ {{ number_format($processing_fee,2) }}
                </td>

            </tr>

            <tr>

                <th>
                    CGST (9%)
                </th>

                <td>
                    ₹ {{ number_format($cgst_amount,2) }}
                </td>

            </tr>

            <tr>

                <th>
                    SGST (9%)
                </th>

                <td>
                    ₹ {{ number_format($sgst_amount,2) }}
                </td>

            </tr>

            <tr class="gray-bg">

                <th>
                    Total Paid Amount
                </th>

                <th>
                    ₹ {{ number_format($total_amount,2) }}
                </th>

            </tr>

        </table>

        <div style="margin-top:30px;font-size:11px;">
            This is a computer generated invoice.
        </div>

    </div>

</body>

</html>