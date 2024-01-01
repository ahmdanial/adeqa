@extends("layouts.user")

@section('title')
    Entry Results Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">DATA ENTRY EDIT</h4>

                <form action="{{ url('entry-results-update/'.$entryresult->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Sample Date:</label>
                        <input type="date" name="sampledate" class="form-control" value="{{ $entryresult->sampledate }}">
                      </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Program:</label>
                        <select name="prog_id" class="form-control" id="prog_id">
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ $program->id == $entryresult->prog_id ? 'selected' : '' }}>
                                {{ $program->programname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach($labs as $lab) {{-- Assuming $labs is the collection of labs --}}
                            <option value="{{ $lab->id }}" {{ $lab->id == $entryresult->lab_id ? 'selected' : '' }}>
                                {{ $lab->labname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach($instruments as $instrument)
                            <option value="{{ $instrument->id }}" {{ $instrument->id == $entryresult->instrument_id ? 'selected' : '' }}>
                                {{ $instrument->instrumentname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reagent:</label>
                        <select name="reagent_id" class="form-control" id="reagent_id">
                            @foreach($reagents as $reagent)
                            <option value="{{ $reagent->id }}" {{ $reagent->id == $entryresult->reagent_id ? 'selected' : '' }}>
                                {{ $reagent->reagent }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Test:</label>
                        <select name="testcode" class="form-control" id="testcode">
                            @foreach($tests as $test)
                            <option value="{{ $test->testcode }}" {{ $test->testcode == $entryresult->testcode ? 'selected' : '' }}>
                                {{ $test->testname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Method:</label>
                        <select name="method_id" class="form-control" id="method_id">
                            @foreach($methods as $method)
                            <option value="{{ $method->id }}" {{ $method->id == $entryresult->method_id ? 'selected' : '' }}>
                                {{ $method->methodname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Unit:</label>
                        <select name="unit_id" class="form-control" id="unit_id">
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ $unit->id == $entryresult->unit_id ? 'selected' : '' }}>
                                {{ $unit->unit }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Result:</label>
                        <input type="text" name="result" class="form-control" value="{{ $entryresult->result }}">
                      </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('assign-test') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
