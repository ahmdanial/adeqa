@extends("layouts.admin")

@section('title')
    Assign Test Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">ASSIGN TEST SETUP EDIT</h4>

                <form action="{{ url('assign-tests-update/'.$assignTest->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Program:</label>
                        <select name="prog_id" class="form-control" id="prog_id">
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ $program->id == $assignTest->prog_id ? 'selected' : '' }}>
                                {{ $program->programname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach($labs as $lab) {{-- Assuming $labs is the collection of labs --}}
                            <option value="{{ $lab->id }}" {{ $lab->id == $assignTest->lab_id ? 'selected' : '' }}>
                                {{ $lab->labname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach($instruments as $instrument)
                            <option value="{{ $instrument->id }}" {{ $instrument->id == $assignTest->instrument_id ? 'selected' : '' }}>
                                {{ $instrument->instrumentname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="testcode" class="col-sm-3 col-form-label">Test:</label>
                        <div class="col-sm-9">
                            <div class="row">
                                @foreach($tests as $test)
                                    <div class="col-sm-3">
                                        <div class="form-check1">
                                            <input type="checkbox" class="form-check-input1" name="testcodes[]" value="{{ $test->testcode }}" id="test_{{ $test->testcode }}" {{ in_array($test->testcode, old('testcodes', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="test_{{ $test->testcode }}">{{ $test->testname }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ url('assign-tests') }}" class="btn btn-primary">BACK</a>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
