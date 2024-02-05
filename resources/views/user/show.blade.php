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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="w-10p">Test Code</th>
                                <th class="w-10p">Method</th>
                                <th class="w-10p">Result</th>
                                <th class="w-10p">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subAssignTests->where('reagent_id', $reagentId) as $subAssignTest)
                                <?php $assignTest = $subAssignTest->assignTest; ?>
                                <tr>
                                    <td>{{ $subAssignTest->testcode }}</td>
                                    @if (isset($methodDetails[$subAssignTest->testcode]))
                                        <td>{{ $methodDetails[$subAssignTest->testcode]->methodname }}</td>
                                    @endif
                                    <td>
                                        <input type="text" name="results[{{ $subAssignTest->testcode }}]" class="form-control">
                                    </td>
                                    <td>{{ $methodDetails[$subAssignTest->testcode] ? $methodDetails[$subAssignTest->testcode]->unit->unit : '' }}</td>
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

        console.log('AssignTestID', assignTestId)

    </script>
@endsection
