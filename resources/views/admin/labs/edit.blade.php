@extends("layouts.master")

@section('title')
    Lab Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">LAB SETUP EDIT</h4>

                <form action="{{ url('labs-update/'.$lab->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Lab Name:</label>
                        <input type="text" name="labname" class="form-control" value="{{ $lab->labname }}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Department:</label>
                        <select name="department_id" class="form-control" id="department_id">
                            @foreach($departments as $dep)
                                <option value="{{ $dep->id }}" {{ $dep->id == $lab->department_id ? 'selected' : '' }}>
                                    {{ $dep->department }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <input type="text" name="address" class="form-control" value="{{ $lab->address }}">
                      </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" name="city" class="form-control" value="{{ $lab->city }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">State:</label>
                        <input type="text" name="state" class="form-control" value="{{ $lab->state }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Postal Code:</label>
                        <input type="text" name="postalcode" class="form-control" value="{{ $lab->postalcode }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Country:</label>
                        <input type="text" name="country" class="form-control" value="{{ $lab->country }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Contact No:</label>
                        <input type="text" name="contactno" class="form-control" value="{{ $lab->contactno }}">
                      </div>
                </div>
                <div class="modal-footer">
                  <a href="{{ url('labs') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
