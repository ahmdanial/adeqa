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
                        <label for="state" class="col-form-label">State:</label>
                        <select name="state" class="form-control">
                            <option value="">Select a state</option>
                            <option value="Johor" {{ $lab->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                            <option value="Kedah" {{ $lab->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                            <option value="Kelantan" {{ $lab->state == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                            <option value="Melaka" {{ $lab->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                            <option value="Negeri Sembilan" {{ $lab->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                            <option value="Pahang" {{ $lab->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                            <option value="Perak" {{ $lab->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                            <option value="Perlis" {{ $lab->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                            <option value="Pulau Pinang" {{ $lab->state == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                            <option value="Sabah" {{ $lab->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                            <option value="Sarawak" {{ $lab->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                            <option value="Selangor" {{ $lab->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                            <option value="Terengganu" {{ $lab->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                            <option value="Kuala Lumpur" {{ $lab->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                            <option value="Labuan" {{ $lab->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                            <option value="Putrajaya" {{ $lab->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
                        </select>
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
                  <a href="{{ url('labs') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
