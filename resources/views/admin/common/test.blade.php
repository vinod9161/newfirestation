<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css"/>
    <style>
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        header {
            display: block;
            margin-top: 10px; /* Add appropriate margin if needed */
            margin-bottom: 10px; /* Add space below the header */
        }

        header table {
            border: none !important;
        }

        header table th,
        header table td {
            border: none !important;
        }

        .box {
            margin: 0 !important; /* Reset margins for print */
        }

        .col-md-2.box img {
            display: block;
            margin: 0 auto; /* Center align the logo */
            width: 100px; /* Adjust size for print */
        }

        .col-md-8.box {
            margin-top: 0 !important; /* Reset margin for print */
        }

        .col-md-2.box:last-child {
            margin-top: 0 !important; /* Reset margin for the right column */
        }

        .alert,
        .alert-primary {
            background-color: #ccc !important;
            border-color: #ccc !important;
            border-radius: 0;
        }

        .alert,
        .alert-primary h5 {
            color: #000 !important;
        }

        table {
            border: 1px solid black !important;
        }

        table th,
        table td {
            border: 1px solid black !important;
        }
    }
</style>


</head>
<body>
    <div class="container-fluid">
        <div class="container" style="margin-bottom:5%">
            <header style="margin-top:15%">
                <div class="row">
                    <table width="100%" border="0" align="center">
                        <tr>
                            <th>
                                <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="" style="width:120px;margin-top:-84px;">
                            </th>
                            <th>
                                <h3 style="text-align: center">
                                    <strong>उत्तराखण्ड अग्निशमन एवं आपात सेवा<br>
                                    Uttarakhand fire and Emergency Service</strong>
                                </h3>

                                <h5 style="text-align: center; margin-top:40px; margin-bottom:25px;"><strong>फायर रिपोर्ट का प्रारूप</strong></h5>
                            </th>
                            <th>
                                <p style="margin-top:50%"><strong>DDN/DD/52/2024/FR</strong></p>
                            </th>
                        </tr>
                    </table>
                    
                </div>
            </header>
            <div class="row" style="border:1px solid black">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">General Details सामान्य विवरण</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <table class="table table-bordered">
                        <tr>
                            <th>Simple सामान्य</th>
                            <th>NA</th>
                            <th>Special विशेष</th>
                            <th>NA</th>
                            <th>Serious सीरियस</th>
                            <th>NA</th>
                        </tr>


                        <tr>
                            <th colspan="2">Fire Report Number फायर रिपोर्ट संख्या</th>
                            <th>NA</th>
                            <th colspan="2">Monthly Number मासिक संख्या</th>
                            <th>NA</th>
                        </tr>

                        <tr>
                            <th colspan="2">Date of Fire Incident घटना का दिनांक</th>
                            <th>NA</th>
                            <th colspan="2">Time of Fire Incident घटना का समय</th>
                            <th>NA</th>
                        </tr>

                        <tr>
                            <th colspan="2">Name of District जनपद का नाम</th>
                            <th>NA</th>
                            <th colspan="2">Fire Station फायर स्टेशन </th>
                            <th>NA</th>
                        </tr>
                    </table>
                </div>    
            </div>


            <div class="row" style="border:1px solid black; border-top:none; margin-top:-17px">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">Information Details सूचना विवरण</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                Name of Informer 
                                सूचना देने वाला का नाम
                            </th>
                            <th>NA</th>
                            <th>Contact Number of Informer 
                                सूचना देने वाल का फोन नंबर</th>
                            <th>NA</th>
                        </tr>


                        <tr>
                            <th colspan="2">Medium of Information सूचना प्राप्ति का माध्यम</th>
                            <th>NA</th>
                            <th>NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Address of incident place घटनास्थल का पता</th>
                            <th colspan="2">NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Time of Information सूचना प्राप्ति का समय</th>
                            <th>NA</th>
                            <th>NA</th>
                        </tr>
                        <tr>
                            <th colspan="3">Time of departure to Fire incident place घटनास्थल को प्रस्थान का समय</th>
                            <th>NA</th>
                        </tr>
                    </table>
                </div>    
            </div>


            <div class="row" style="border:1px solid black; border-top:none; margin-top:-17px">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">Action Details कार्यवाही</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <table class="table table-bordered">
                        <tr>
                            <th>Departure Time from Fire Station   फायर स्टेशन से प्रस्थान का समय</th>
                            <th>NA</th>
                            <th>Arrival Time on incident Place  घटनास्थल पर पहुँचने का समय</th>
                            <th>NA</th>
                        </tr>


                        <tr>
                            <th colspan="2">Arrival Time on Fire Station फायर स्टेशन पर वापसी का समय</th>
                            <th>NA</th>
                            <th>NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Details of Fire Service Personals on incident place घटनास्थल पर गये कार्मिकों का विवरण</th>
                            <th colspan="2">NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Details of Fire fighting used Machine प्रयोग में लायी गयी मशीनों का विवरण</th>
                            <th colspan="2">NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Distance of incident place from fire station फायर स्टेशन से घटना स्थल की दूरी</th>
                            <th colspan="2">NA</th>
                        </tr>
                    </table>
                </div>    
            </div>


            <div class="row" style="border:1px solid black; border-top:none; margin-top:-17px">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">Details of Fire  आग का विवरण</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name and address of the owner/Occupier of property which is affected by a fire inciden</th>
                            <th>NA</th>
                        </tr>
                        <tr>
                            <th>Class of Fire अग्निकाण्ड की श्रेणी</th>
                            <th style="padding:0">
                                <table width="100%">
                                    <tr>
                                        <td>A ए <input type="checkbox" name="a" id="a"></td>
                                        <td>B बी <input type="checkbox" name="b" id="b"></td>
                                        <td>C ची <input type="checkbox" name="c" id="c"></td>
                                        <td>D डी <input type="checkbox" name="d" id="d"></td>
                                        <td>E एस <input type="checkbox" name="e" id="e"></td>
                                    </tr>
                                </table>
                            </th>
                        </tr>

                        <tr>
                            <th>Area of Fire अग्निकाण्ड का क्षेत्र</th>
                            <th style="padding:0">
                                <table width="100%">
                                    <tr>
                                        <td>Rural ग्रामीण <input type="checkbox" name="a" id="a"></td>
                                        <td>City शहर <input type="checkbox" name="b" id="b"></td>
                                    </tr>
                                </table>
                            </th>
                        </tr>

                        <tr>
                            <th>Cause of Fire अग्निकाण्ड का कारण</th>
                            <th style="padding:0">
                                <table width="100%">
                                    <tr>
                                        <td>Commercial व्यवसायिक <input type="checkbox" name="a" id="a"></td>
                                        <td>Residential आवासीय <input type="checkbox" name="b" id="b"></td>
                                        <td>High rise बहुमंजली <input type="checkbox" name="a" id="a"></td>
                                        <td>Forest जंगल <input type="checkbox" name="b" id="b"></td>
                                        <td>Farm खेत/खलियान <input type="checkbox" name="a" id="a"></td>
                                        <td>Industry उद्योग <input type="checkbox" name="b" id="b"></td>
                                        <td>Official कार्यालय <input type="checkbox" name="a" id="a"></td>
                                        <td>Other अन्य <input type="checkbox" name="b" id="b"></td>
                                    </tr>
                                </table>
                            </th>
                        </tr>

                        <tr>
                            <th>Insured: Yes or No बीमित है अथवा नहीं?</th>
                            <th>NA</th>
                        </tr>

                        <tr>
                            <th>Reason of Fire आग लगने का कारण</th>
                            <th>NA</th>
                        </tr>

                        <tr>
                            <th>Was it arson based?</th>
                            <th>NA</th>
                        </tr>
                    </table>
                </div>    
            </div>


            <div class="row" style="border:1px solid black; border-top:none; margin-top:-17px">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">Loss Details क्षति विवरण</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">Property Lost क्षति सम्पत्ति</th>
                            <th colspan="3">NA</th>
                        </tr>
                        <tr>
                            <th colspan="2">Property Saved बचायी गई सम्पत्ति</th>
                            <th colspan="3">NA</th>
                        </tr>



                        <tr>
                            <th>Life Lost जीव नरे</th>
                            <th>Human मनुष्य</th>
                            <th>NA</th>
                            <th>Animal पशु</th>
                            <th></th>
                        </tr>

                        <tr>
                            <th>Life Saved जीव बचाये</th>
                            <th>Human मनुष्य</th>
                            <th>NA</th>
                            <th>Animal पशु</th>
                            <th></th>
                        </tr>
                    </table>
                </div>    
            </div>


            <div class="row" style="border:1px solid black; border-top:none; margin-top:-17px">
                <div class="col-md-12" style="padding:0">
                    <div class="alert alert-primary" style="background-color:#ccc;border-color:#ccc;border-radius:0;padding-bottom:0">
                        <h5 class="text-center" style="color: #000">Short Description सूक्ष्म विवरण</h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:-16px; padding:0px">
                    <p style="padding:10px">NA</p>
                </div>    
            </div>

        </div>
    </div>  
</body>
</html>