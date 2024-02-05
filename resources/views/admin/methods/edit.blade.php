@extends("layouts.master")

@section('title')
    Method Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">METHOD SETUP EDIT</h4>

                <form action="{{ url('methods-update/'.$method->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Method Name:</label>
                      <input type="text" name="methodname" class="form-control" value="{{ $method->methodname }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Test Code:</label>
                        <select name="testcode" class="form-control" id="testcode">
                            @foreach($tests as $test)
                                <option value="{{ $test->testcode }}" {{ $test->testcode == $method->testcode ? 'selected' : '' }}>
                                    {{ $test->testcode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reagent:</label>
                        <select name="reagent_id" class="form-control" id="reagent_id">
                            @foreach($reagent as $reag)
                                <option value="{{ $reag->id }}" {{ $reag->id == $method->reagent_id ? 'selected' : '' }}>
                                    {{ $reag->reagent }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reagent:</label>
                        <select name="unit_id" class="form-control" id="unit_id">
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $method->unit_id ? 'selected' : '' }}>
                                    {{ $unit->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('methods') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
