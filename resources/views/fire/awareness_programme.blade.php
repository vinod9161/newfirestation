@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Awareness Programme</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Awareness Programme</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<div class="container">
    <div class="row">
        <div style="width:100%;padding:10px; margin-top: 30px;">
            <!-- <embed src="{{ asset('/public/fire/pdf/data_of_fire_service.pdf') }}#toolbar=0&navpanes=0" type="application/pdf" width="100%" height="850px" style="background:transparent !important;"/> -->
            
            <table class="table table-bordered table-striped text-center">
                <thead style="background-color:#D73502; color: white;">
                    <tr>
                        <th>क्रमसं</th>
                        <th>जनपद</th>
                        <th>मॉक ड्रिल</th>
                        <th>जन जागरूकता</th>
                        <th>प्रशिक्षण</th>
                        <th>कुल प्रतिभागियों/ लाभार्थियों की संख्या</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Initialize an array to hold the counts and crowd sizes by district
                    $programCounts = [];
                    $mockDrills = 0;
                    $awarenessProgram = 0;
                    $training = 0;
                    $totalCrowdSize = 0;

                    $sn=1;
                    // Output the counts and total crowd size by district
                    foreach ($getData as $key => $row) {
                    ?>
                        <tr>
                            <td><?= $sn ?></td>
                            <td><?= $row->district_name ?? '-' ?></td>
                            <td><?= $row->mock_drills_count ?? '0';?></td>
                            <td><?= $row->awareness_program_count ?? '-';?></td>
                            <td><?= $row->training_count ?? '0';?></td>
                            <td><?= $row->total_crowd_size ?? '0';?></td>
                        </tr>
                    <?php 
                        $mockDrills = $mockDrills + $row->mock_drills_count ?? '0';
                        $awarenessProgram = $awarenessProgram + $row->awareness_program_count ?? '0';
                        $training = $training + $row->training_count ?? '0';
                        $totalCrowdSize = $totalCrowdSize + $row->total_crowd_size ?? '0';
                        $sn++;
                    }
                    ?>
                </tbody>
                <tfoot class="font-weight-bold">
                    <tr>
                        <td colspan="2">Total</td>
                        <td><?= $mockDrills ?></td>
                        <td><?= $awarenessProgram ?></td>
                        <td><?= $training ?></td>
                        <td><?= $totalCrowdSize ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@stop