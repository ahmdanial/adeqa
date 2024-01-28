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

                <form action="{{ route('entry-results.showEntryResults', ['assignTestId' => $assignTestId]) }}" method="POST">
                    @method('PUT')
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
                    </style>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="label-style" for="lab_id">LAB :</span>
                                <span class="value-style">
                                    @foreach ($assignTests as $assignTest)
                                        @if ($assignTest->lab)
                                            {{ $assignTest->lab->labname }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="label-style" for="instrument_id">INSTRUMENT :</span>
                                <span class="value-style">
                                    @foreach ($assignTests as $assignTest)
                                        @if ($assignTest->instrument)
                                            {{ $assignTest->instrument->instrumentname }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="label-style" for="prog_id">PROGRAM :</span>
                                <span class="value-style">
                                    @foreach ($assignTests as $assignTest)
                                        @if ($assignTest->program)
                                            {{ $assignTest->program->programname }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="label-style" for="reagent_id">REAGENT :</span>
                                <span class="value-style">
                                    @foreach ($assignTests as $assignTest)
                                        @if ($assignTest->reagent)
                                            {{ $assignTest->reagent->reagent }}
                                        @endif
                                    @endforeach
                                </span>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="w-10p">Test Code</th>
                                <th class="w-10p">Method</th>
                                <th class="w-10p">Result</th>
                                <th class="w-10p">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subAssignTests as $subAssignTest)
                            <?php $assignTest = $subAssignTest->assignTest; ?>
                            <tr>
                                <td>{{ $subAssignTest->testcode }}</td>
                                <td>{{ $assignTest->method->methodname }}</td>
                                <td>
                                    <input type="text" name="results[{{ $subAssignTest->testcode }}]" class="form-control">
                                </td>
                                <td>{{ $assignTest->unit->unit }}</td>
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

@endsection
