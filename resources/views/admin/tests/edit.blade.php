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
                        <label for="recipient-name" class="col-form-label">Department:</label>
                        <select name="department_id" class="form-control" id="department_id">
                            @foreach($departments as $dep)
                                <option value="{{ $dep->id }}" {{ $dep->id == $test->department_id ? 'selected' : '' }}>
                                    {{ $dep->department }}
                                </option>
                            @endforeach
                        </select>
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
