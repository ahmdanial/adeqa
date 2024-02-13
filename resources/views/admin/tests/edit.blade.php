@extends("layouts.master")

@section('title')
    Test Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">TEST SETUP EDIT</h4>

                <form action="{{ url('tests-update/'.$test->testcode) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Test Code:</label>
                        <input type="text" name="testcode" class="form-control" value="{{ $test->testcode }}">
                      </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Test Name:</label>
                      <input type="text" name="testname" class="form-control" value="{{ $test->testname }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reagent:</label>
                        <select name="reagent_id" class="form-control" id="reagent_id">
                            @foreach($reagents as $reag)
                                <option value="{{ $reag->id }}" {{ $reag->id == $test->reagent_id ? 'selected' : '' }}>
                                    {{ $reag->reagent }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Method:</label>
                        <select name="method_id" class="form-control" id="method_id">
                            @foreach($methods as $method)
                                <option value="{{ $method->id }}" {{ $method->id == $test->method_id ? 'selected' : '' }}>
                                    {{ $method->methodname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Unit:</label>
                        <select name="unit_id" class="form-control" id="unit_id">
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $test->unit_id ? 'selected' : '' }}>
                                    {{ $unit->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Expected Result:</label>
                        <select type="text" name="expected_result" class="form-control" value="{{ $test->expected_result }}">
                            <option value="POSITIVE">POSITIVE</option>
                            <option value="NEGATIVE">NEGATIVE</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Low Range:</label>
                        <input type="text" name="low_range" class="form-control" value="{{ $test->low_range }}">
                      </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">High Range:</label>
                        <input type="text" name="high_range" class="form-control" value="{{ $test->high_range }}">
                      </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('tests') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
