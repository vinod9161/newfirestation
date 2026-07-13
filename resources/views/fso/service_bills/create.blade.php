@extends('layouts.admin.template')

@section('content')

<div class="card custom-card">
    <div class="card-header">
        <div class="card-title">Generate Service Bill</div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('service-bills.store') }}">
            @csrf

            <input type="hidden" name="service_type" value="{{ $service_type }}">
            <input type="hidden" name="request_id" value="{{ $request->application_id }}">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-body">
                            <label class="fw-bold">Request No</label>
                            <h6>{{ $request->application_id }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-body">
                            <label class="fw-bold">Organization</label>
                            <h6>{{ $request->name }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-body">
                            <label class="fw-bold">Service Type</label>
                            <h6>{{ ucwords(str_replace('_',' ',$service_type)) }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-body">
                            <label class="fw-bold">Fuel Rate (₹/litre)</label>
                            <input type="number" step="0.01" name="diesel_rate" id="fuelRate" class="form-control" value="95">
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Personnel Expense</h5>
                <button type="button" class="btn btn-primary btn-sm" id="addPersonnelRow">+</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="25%">Designation</th>
                            <th width="10%">No of Person</th>
                            <th width="10%">No of Days</th>
                            <th width="15%">Expense</th>
                            <th width="10%">DA %</th>
                            <th width="20%">Total</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>

                    <tbody id="personnelTable">
                        <tr>
                            <td>
                                <select name="designation_id[]" class="form-control designation_select">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                    <option value="{{ $designation->designation_id }}" data-expense="{{ $designation->monthly_basic_expense }}" data-da="{{ $designation->da_percent }}">
                                        {{ $designation->designation->designation_name ?? '' }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" name="no_of_person[]" class="form-control no_of_person" value="1" min="1">
                            </td>

                            <td>
                                <input type="number" name="days[]" class="form-control no_of_days" value="1" min="1">
                            </td>

                            <td>
                                <input type="text" name="expense[]" class="form-control expense" readonly>
                            </td>

                            <td>
                                <input type="text" name="da[]" class="form-control da" readonly>
                            </td>

                            <td>
                                <input type="text" name="person_total[]" class="form-control person_total" readonly>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm removePersonnelRow">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Vehicle Expense</h5>
                <button type="button" class="btn btn-primary btn-sm" id="addVehicleRow">+</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Mileage Type</th>
                            <th>Mileage</th>
                            <th>KM</th>
                            <th>Fuel Used</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="vehicleTable">
                        <tr>
                            <td>
                                <select name="vehicle_id[]" class="form-control vehicle_select">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" data-mileage="{{ $vehicle->mileage_value }}" data-type="{{ $vehicle->mileage_type }}">
                                        {{ $vehicle->type }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="text" name="vehicle_mileage_type[]" class="form-control mileage_type" readonly>
                            </td>

                            <td>
                                <input type="text" name="vehicle_mileage[]" class="form-control mileage_value" readonly>
                            </td>

                            <td>
                                <input type="number" step="0.01" name="vehicle_running[]" class="form-control running_value">
                            </td>

                            <td>
                                <input type="text" name="vehicle_fuel_used[]" class="form-control vehicle_fuel_used" readonly>
                            </td>

                            <td>
                                <input type="text" name="vehicle_total[]" class="form-control vehicle_total" readonly>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeVehicleRow">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Equipment Expense</h5>
                <button type="button" class="btn btn-primary btn-sm" id="addEquipmentRow">+</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Equipment</th>
                            <th>Mileage Type</th>
                            <th>Mileage</th>
                            <th>Hour</th>
                            <th>Fuel Used</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="equipmentTable">
                        <tr>
                            <td>
                                <select name="equipment_id[]" class="form-control equipment_select">
                                    <option value="">Select Equipment</option>
                                    @foreach($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" data-mileage="{{ $equipment->mileage_value }}" data-type="{{ $equipment->mileage_type }}">
                                        {{ $equipment->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="text" name="equipment_mileage_type[]" class="form-control equipment_mileage_type" readonly>
                            </td>

                            <td>
                                <input type="text" name="equipment_mileage[]" class="form-control equipment_mileage_value" readonly>
                            </td>

                            <td>
                                <input type="number" step="0.01" name="equipment_running[]" class="form-control equipment_running_value">
                            </td>

                            <td>
                                <input type="text" name="equipment_fuel_used[]" class="form-control equipment_fuel_used" readonly>
                            </td>

                            <td>
                                <input type="text" name="equipment_total[]" class="form-control equipment_total" readonly>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeEquipmentRow">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">Billing Summary</div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Billing</th>
                                    <th width="25%">Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Fuel expense for movement of Fire Vehicles & Equipments</td>
                                    <td>
                                        <input type="text" name="fuel_expense" id="fuelExpense" class="form-control" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Depreciation expenses of vehicle 25% of fuel expenses</td>
                                    <td>
                                        <input type="text" name="depreciation_expense" id="depreciationExpense" class="form-control" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Salary / Allowances for Personnel etc.</td>
                                    <td>
                                        <input type="text" name="personnel_expense" id="personnelExpense" class="form-control" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>CGST @9%</td>
                                    <td>
                                        <input type="text" name="cgst_amount" id="cgstAmount" class="form-control" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>SGST @9%</td>
                                    <td>
                                        <input type="text" name="sgst_amount" id="sgstAmount" class="form-control" readonly>
                                    </td>
                                </tr>

                                <tr class="table-primary">
                                    <th colspan="2">Total Amount</th>
                                    <th>
                                        <input type="text" name="total_amount" id="grandTotal" class="form-control fw-bold" readonly>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Generate Bill</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // Recalculate all totals including personnel, vehicles, equipment
    function calculateTotals() {

        // Personnel total (based on days)
        let personnelTotal = 0;
        $('.person_total').each(function() {
            personnelTotal += parseFloat($(this).val()) || 0;
        });

        // Vehicle total
        let vehicleTotal = 0;
        $('.vehicle_total').each(function() {
            vehicleTotal += parseFloat($(this).val()) || 0;
        });

        // Equipment total
        let equipmentTotal = 0;
        $('.equipment_total').each(function() {
            equipmentTotal += parseFloat($(this).val()) || 0;
        });

        let totalFuelExpense = vehicleTotal + equipmentTotal;
        let depreciation = totalFuelExpense * 0.25;

        $('#fuelExpense').val(totalFuelExpense.toFixed(2));
        $('#depreciationExpense').val(depreciation.toFixed(2));
        $('#personnelExpense').val(personnelTotal.toFixed(2));

        let subtotal = totalFuelExpense + depreciation + personnelTotal;
        let cgst = subtotal * 0.09;
        let sgst = subtotal * 0.09;
        let grand = subtotal + cgst + sgst;

        $('#cgstAmount').val(cgst.toFixed(2));
        $('#sgstAmount').val(sgst.toFixed(2));
        $('#grandTotal').val(grand.toFixed(2));
    }

    // --- Clamp minimum values ---
    $(document).on('blur', '.no_of_days, .no_of_person', function() {
        let val = parseInt($(this).val()) || 0;
        if (val < 1) {
            $(this).val(1);
            $(this).trigger('keyup');
        }
    });

    // Personnel: designation selection fills expense & DA
    $(document).on('change', '.designation_select', function() {
        let row = $(this).closest('tr');
        let expense = $(this).find(':selected').data('expense') || 0;
        let da = $(this).find(':selected').data('da') || 0;
        row.find('.expense').val(expense);
        row.find('.da').val(da);
    });

    // Personnel: recalculate when No. of Person or No. of Days changes
    $(document).on('keyup change', '.no_of_person, .no_of_days', function() {
        let row = $(this).closest('tr');
        let count = parseFloat(row.find('.no_of_person').val()) || 0;
        let days = parseFloat(row.find('.no_of_days').val()) || 1;
        let expense = parseFloat(row.find('.expense').val()) || 0;
        let da = parseFloat(row.find('.da').val()) || 0;

        // Monthly basic * count * days / 30 (daily rate)
        let total = (expense * count * days) / 30;
        total += (total * da / 100);

        row.find('.person_total').val(total.toFixed(2));
        calculateTotals();
    });

    // Vehicle: select fills mileage & type
    $(document).on('change', '.vehicle_select', function() {
        let row = $(this).closest('tr');
        let mileage = $(this).find(':selected').data('mileage') || 0;
        let type = $(this).find(':selected').data('type') || '';
        row.find('.mileage_value').val(mileage);
        row.find('.mileage_type').val(type);
    });

    // Vehicle: calculate fuel used & total
    $(document).on('keyup change', '.running_value', function() {
        let row = $(this).closest('tr');
        let running = parseFloat($(this).val()) || 0;
        let mileage = parseFloat(row.find('.mileage_value').val()) || 0;
        let fuelRate = parseFloat($('#fuelRate').val()) || 0;
        let mileageType = row.find('.mileage_type').val();

        let fuelUsed = 0;
        if (mileageType == 'per_km') {
            fuelUsed = running / mileage;
        } else {
            fuelUsed = running * mileage;
        }

        let total = fuelUsed * fuelRate;
        row.find('.vehicle_fuel_used').val(fuelUsed.toFixed(2));
        row.find('.vehicle_total').val(total.toFixed(2));
        calculateTotals();
    });

    // Equipment: select fills mileage & type
    $(document).on('change', '.equipment_select', function() {
        let row = $(this).closest('tr');
        let mileage = $(this).find(':selected').data('mileage') || 0;
        let type = $(this).find(':selected').data('type') || '';
        row.find('.equipment_mileage_value').val(mileage);
        row.find('.equipment_mileage_type').val(type);
    });

    // Equipment: calculate fuel used & total
    $(document).on('keyup change', '.equipment_running_value', function() {
        let row = $(this).closest('tr');
        let running = parseFloat($(this).val()) || 0;
        let mileage = parseFloat(row.find('.equipment_mileage_value').val()) || 0;
        let fuelRate = parseFloat($('#fuelRate').val()) || 0;
        let mileageType = row.find('.equipment_mileage_type').val();

        let fuelUsed = 0;
        if (mileageType == 'per_km') {
            fuelUsed = running / mileage;
        } else {
            fuelUsed = running * mileage;
        }

        let total = fuelUsed * fuelRate;
        row.find('.equipment_fuel_used').val(fuelUsed.toFixed(2));
        row.find('.equipment_total').val(total.toFixed(2));
        calculateTotals();
    });

    // Add/Remove Personnel rows
    $('#addPersonnelRow').click(function() {
        let lastRow = $('#personnelTable tr:last');
        
        let prevPerson = parseInt(lastRow.find('.no_of_person').val()) || 1;
        let prevDays = parseInt(lastRow.find('.no_of_days').val()) || 1;
        
        $('#personnelTable').append(`<tr>
            <td>
                <select name="designation_id[]" class="form-control designation_select">
                    <option value="">Select Designation</option>
                    @foreach($designations as $designation)
                    <option value="{{ $designation->designation_id }}" data-expense="{{ $designation->monthly_basic_expense }}" data-da="{{ $designation->da_percent }}">
                        {{ $designation->designation->designation_name ?? '' }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="no_of_person[]" class="form-control no_of_person" value="${prevPerson}" min="1"></td>
            <td><input type="number" name="days[]" class="form-control no_of_days" value="${prevDays}" min="1"></td>
            <td><input type="text" name="expense[]" class="form-control expense" readonly></td>
            <td><input type="text" name="da[]" class="form-control da" readonly></td>
            <td><input type="text" name="person_total[]" class="form-control person_total" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm removePersonnelRow">X</button></td>
        </tr>`);
    });

    $(document).on('click', '.removePersonnelRow', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    // Add/Remove Vehicle rows
    $('#addVehicleRow').click(function() {
        $('#vehicleTable').append(`<tr>
            <td>
                <select name="vehicle_id[]" class="form-control vehicle_select">
                    <option value="">Select Vehicle</option>
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" data-mileage="{{ $vehicle->mileage_value }}" data-type="{{ $vehicle->mileage_type }}">
                        {{ $vehicle->type }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="vehicle_mileage_type[]" class="form-control mileage_type" readonly></td>
            <td><input type="text" name="vehicle_mileage[]" class="form-control mileage_value" readonly></td>
            <td><input type="number" step="0.01" name="vehicle_running[]" class="form-control running_value"></td>
            <td><input type="text" name="vehicle_fuel_used[]" class="form-control vehicle_fuel_used" readonly></td>
            <td><input type="text" name="vehicle_total[]" class="form-control vehicle_total" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm removeVehicleRow">X</button></td>
        </tr>`);
    });

    $(document).on('click', '.removeVehicleRow', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    // Add/Remove Equipment rows
    $('#addEquipmentRow').click(function() {
        $('#equipmentTable').append(`<tr>
            <td>
                <select name="equipment_id[]" class="form-control equipment_select">
                    <option value="">Select Equipment</option>
                    @foreach($equipments as $equipment)
                    <option value="{{ $equipment->id }}" data-mileage="{{ $equipment->mileage_value }}" data-type="{{ $equipment->mileage_type }}">
                        {{ $equipment->name }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="equipment_mileage_type[]" class="form-control equipment_mileage_type" readonly></td>
            <td><input type="text" name="equipment_mileage[]" class="form-control equipment_mileage_value" readonly></td>
            <td><input type="number" step="0.01" name="equipment_running[]" class="form-control equipment_running_value"></td>
            <td><input type="text" name="equipment_fuel_used[]" class="form-control equipment_fuel_used" readonly></td>
            <td><input type="text" name="equipment_total[]" class="form-control equipment_total" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm removeEquipmentRow">X</button></td>
        </tr>`);
    });

    $(document).on('click', '.removeEquipmentRow', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });
</script>

@endsection