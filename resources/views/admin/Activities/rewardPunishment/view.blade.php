@extends('layouts.admin.template')
@section('title')
<title>View Fire Report Details | Uttrakhand Fireservice</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
   .custom-flex {
      display: flex;
      justify-content: space-between;
      width: 100%;
   }

   .report-details {
      margin-left: auto;
      /* Ensures it stays pushed to the right */
   }

   .heading_info {
      background: #42425d;
      color: white;
      padding: 4px;
      font-size: 1.2rem;
      width: 98%;
      margin: 10px 10px;
   }
</style>
@endsection
@section('content')
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">View Reward/ Punishment</h5>
   </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="<?php echo route('admin.rewardPanishment');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Reward / Punishment List
            </a>
        </div>
    </div>
</div>
<!-- End Row -->
<!-- Start::row-2 -->
<div class="row">
   <div class="col-xl-12">
      <div class="card custom-card">

         <div class="card-body">
            <div class="container-fluid">
               <div class="row">
                  <h5 class="text-center heading_info">Reward/ Punishment</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">District</td>
                                 <td>{{ $district }}</td>
                              </tr>
                              <tr>
                                 <td>Station</td>
                                 <td>{{ $station }}</td>
                              </tr>
                              <tr>
                                 <td>Activity</td>
                                 <td>{{ $activity }}</td>
                              </tr>
                              <tr>
                                 <td>Type Of Reward</td>
                                 <td>{{ $reward_type }}</td>
                              </tr>
                              <tr>
                                 <td>Awarded by (Rank of Officer)</td>
                                 <td>{{ $awarded_by }}</td>
                              </tr>
                              <tr>
                                 <td>Name of Recipient (Rank and Name)</td>
                                 <td>{{ $recipient }}</td>
                              </tr>
                              <tr>
                                 <td>Date of Reward / Punishment</td>
                                 <td>{{ $date }}</td>
                              </tr>
                              <tr>
                                 <td>Other Comments</td>
                                 <td>{{ $comment }}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@section('scripts')

@stop