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

                <form action="{{ route('entry-results.showEntryResults', ['assignTestId' => $assignTestId ]) }}" method="GET">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="lab_id" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach ($assignTests as $assignTest)
                                <option value="{{ $assignTest->lab->id }}" {{ old('lab_id', $assignTests->first()->lab_id) == $assignTest->lab->id ? 'selected' : '' }}>
                                    {{ $assignTest->lab->labname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="prog_id" class="col-form-label">Program:</label>
                        <select name="prog_id" class="form-control" id="prog_id">
                            @foreach ($assignTests as $assignTest)
                                <option value="{{ $assignTest->program->id }}" {{ old('prog_id', $assignTests->first()->prog_id) == $assignTest->program->id ? 'selected' : '' }}>
                                    {{ $assignTest->program->programname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="instrument_id" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach ($assignTests as $assignTest)
                                <option value="{{ $assignTest->instrument->id }}" {{ old('instrument_id', $assignTests->first()->instrument_id) == $assignTest->instrument->id ? 'selected' : '' }}>
                                    {{ $assignTest->instrument->instrumentname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="reagent_id" class="col-form-label">Reagent:</label>
                        <select name="reagent_id" class="form-control" id="reagent_id">
                            @foreach ($assignTests as $assignTest)
                                <option value="{{ $assignTest->reagent->id }}" {{ old('reagent_id', $assignTests->first()->reagent_id) == $assignTest->reagent->id ? 'selected' : '' }}>
                                    {{ $assignTest->reagent->reagent->reagent }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="assignTestId" value="{{ $assignTestId }}">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ENTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function fetchAssignTestId() {
        const form = document.getElementById('entryResultsForm');
        form.submit();
    }
</script>

@endsection
