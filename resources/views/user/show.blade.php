@extends("layouts.user")

@section('title')
    Entry Results | ADEQA
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA ENTRY</h4>
                <br>
                <?php
                $conn = new mysqli("localhost", "root", "","adeqa");

                $labid = $_GET['lab_id'];
                $progid = $_GET['prog_id'];
                $instrument = $_GET['instrument_id'];
                $reagent = $_GET['reagent_id'];

                $sql = "SELECT id FROM assign_test WHERE lab_id = '$labid' AND prog_id = '$progid' AND instrument_id = '$instrument'
                AND reagent_id = '$reagent'";
                $result = $conn->query($sql);
                $row = $result->fetch_object();
                $assignTestID = $row->id;

                echo $assignTestID;

                $sql2 = "SELECT testcode FROM subassigntest WHERE assign_test_id = '$assignTestID'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2 -> fetch_object()){
                    $testcode1 = $row2->testcode;
                    echo $testcode1;
                }
                ?>

                <form action="{{ route('entry-results.store', ['assignTestId' => $assignTestId]) }}" method="POST">
                    @csrf

                    <style>
                        .label-style {
                            font-weight: bold;
                            display: inline-block;
                            width: 120px;
                        }

                        .value-style {
                            display: inline-block;
                            margin-right: 50px;
                        }

                        .input-smaller {
                            width: 15%;
                        }

                        .align-right {
                            margin-left: -26px;
                        }
                    </style>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="label-style" for="lab_id">LAB :</span>
                                <span class="value-style" id="selectedLab"></span>
                            </div>

                            <div class="mb-3">
                                <span class="label-style" for="instrument_id">INSTRUMENT :</span>
                                <span class="value-style" id="selectedInstrument"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="label-style" for="prog_id">PROGRAM :</span>
                                <span class="value-style" id="selectedProg"></span>
                            </div>

                            <div class="mb-3">
                                <span class="label-style" for="reagent_id">REAGENT :</span>
                                <span class="value-style" id="selectedReagent"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Listing table for results -->
                    <style>
                        .w-10p
                        {
                            width: 10% !important;
                        }
                    </style>
                    <table class="table table-bordered" id="getTestCode">
                        <thead>
                            <tr>
                                <th class="w-10p">Test Code</th>
                                <th class="w-10p">Method</th>
                                <th class="w-10p">Result</th>
                                <th class="w-10p">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testCodes as $testcode)
                                <?php $subAssignTest = $subAssignTests->where('testcode', $testcode)->first(); ?>
                                <tr>
                                    <td>{{ $subAssignTest->testcode }}</td>
                                    @if (isset($methodDetails[$subAssignTest->testcode]->method))
                                        <td>{{ $methodDetails[$subAssignTest->testcode]->methodname }}</td>
                                    @endif
                                    <td>
                                        <input type="text" name="results[{{ $subAssignTest->testcode }}]" class="form-control">
                                    </td>
                                    @if (isset($methodDetails[$subAssignTest->testcode]->method))
                                        <td>{{ $methodDetails[$subAssignTest->testcode]->unit }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ENTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Get values from URL parameters
    const labId = getUrlParameter('lab_id');
    const progId = getUrlParameter('prog_id');
    const instrumentId = getUrlParameter('instrument_id');
    const reagentId = getUrlParameter('reagent_id');
    const assignTestId = getUrlParameter('assignTestId');

    // Display the selected values
    document.getElementById('selectedLab').innerText = labId || 'N/A';
    document.getElementById('selectedInstrument').innerText = instrumentId || 'N/A';
    document.getElementById('selectedProg').innerText = progId || 'N/A';
    document.getElementById('selectedReagent').innerText = reagentId || 'N/A';

    console.log('AssignTestID', assignTestId);
    console.log('labId:', labId);
    console.log('progId:', progId);
    console.log('instrumentId:', instrumentId);
    console.log('reagentId:', reagentId);

    // Filter the table based on dynamic parameters
    const tableRows = document.querySelectorAll('#getTestCode tbody tr');

    tableRows.forEach(row => {
        const rowLabId = row.getAttribute('data-lab-id');
        const rowProgId = row.getAttribute('data-prog-id');
        const rowInstrumentId = row.getAttribute('data-instrument-id');
        const rowReagentId = row.getAttribute('data-reagent-id');
        const testcode = row.cells[0].innerText;

        // You might need to adjust the conditions based on your data structure
        if ((labId === 'N/A' || rowLabId === labId) &&
            (progId === 'N/A' || rowProgId === progId) &&
            (instrumentId === 'N/A' || rowInstrumentId === instrumentId) &&
            (reagentId === 'N/A' || rowReagentId === reagentId) &&
            (assignTestId === 'N/A' || testcode === assignTestId)) {
            // Show the row
            row.style.display = '';
        } else {
            // Hide the row
            row.style.display = 'none';
        }
    });
</script>
@endsection
