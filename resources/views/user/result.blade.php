@extends("layouts.user")

@section('title')
    Entry Results Details | ADEQA
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA ENTRY DETAILS</h4>
                <br>

                <form action="#" method="POST">
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
                                    @if ($methodDetails->reagent)
                                    {{ optional($methodDetails)->reagent->reagent }}
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>

                    <!-- Add sample date input field -->
                    <div class="mb-3">
                        <div class="row">
                          <div class="col-auto">
                            <span class="label-style" for="sampledate">SAMPLE DATE:</span>
                          </div>
                          <div class="col align-right">
                            {{ $entryResult->sample_date }}
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
                            @foreach($subAssignTests as $subAssignTest)
                            <?php $assignTest = $subAssignTest->assignTest; ?>
                            <tr>
                                <td>{{ $subAssignTest->testcode }}</td>
                                <td>{{ $methodDetails ? $methodDetails->methodname : '' }}</td>
                                <td>{{ $entryResult->result }}</td>
                                <td>{{ $methodDetails ? $methodDetails->unit->unit : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <a href="{{ route('entry-results.index') }}" class="btn btn-primary">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
