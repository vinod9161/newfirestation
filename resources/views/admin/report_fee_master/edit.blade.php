@extends('layouts.admin.template')

@section('content')

<div class="card custom-card">

    <div class="card-header">

        <div class="card-title">
            Edit Report Fee
        </div>

    </div>

    <div class="card-body">

        <form method="POST"
            action="{{ route('report-fee-master.update',$report->id) }}">

            @csrf

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            Report Type
                        </label>

                        <input type="text"
                            class="form-control"
                            value="{{ ucwords(str_replace('_',' ',$report->report_type)) }}"
                            readonly>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            Processing Fee
                        </label>

                        <input type="number"
                            step="0.01"
                            name="processing_fee"
                            class="form-control"
                            value="{{ $report->processing_fee }}"
                            required>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            CGST %
                        </label>

                        <input type="number"
                            step="0.01"
                            name="cgst_percent"
                            class="form-control"
                            value="{{ $report->cgst_percent }}"
                            required>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-3">

                        <label>
                            SGST %
                        </label>

                        <input type="number"
                            step="0.01"
                            name="sgst_percent"
                            class="form-control"
                            value="{{ $report->sgst_percent }}"
                            required>

                    </div>

                </div>

            </div>

            <button type="submit"
                class="btn btn-success">

                Update

            </button>

        </form>

    </div>

</div>

@endsection