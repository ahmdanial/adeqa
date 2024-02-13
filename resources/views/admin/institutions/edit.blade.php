@extends("layouts.master")

@section('title')
    Institution Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - INSTITUTION </h4>

                <form action="{{ url('institutions-update/'.$institution->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Institution Name</label>
                        <input type="text" name="institution" class="form-control" value="{{ $institution->institution }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <input type="text" name="address" class="form-control" value="{{ $institution->address }}">
                      </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" name="city" class="form-control" value="{{ $institution->city }}">
                      </div>
                      <div class="mb-3">
                        <label for="state" class="col-form-label">State:</label>
                        <select name="state" class="form-control">
                            <option value="">Select a state</option>
                            <option value="Johor" {{ $institution->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                            <option value="Kedah" {{ $institution->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                            <option value="Kelantan" {{ $institution->state == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                            <option value="Melaka" {{ $institution->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                            <option value="Negeri Sembilan" {{ $institution->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                            <option value="Pahang" {{ $institution->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                            <option value="Perak" {{ $institution->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                            <option value="Perlis" {{ $institution->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                            <option value="Pulau Pinang" {{ $institution->state == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                            <option value="Sabah" {{ $institution->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                            <option value="Sarawak" {{ $institution->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                            <option value="Selangor" {{ $institution->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                            <option value="Terengganu" {{ $institution->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                            <option value="Kuala Lumpur" {{ $institution->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                            <option value="Labuan" {{ $institution->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                            <option value="Putrajaya" {{ $institution->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
                        </select>
                    </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Postal Code:</label>
                        <input type="text" name="postalcode" class="form-control" value="{{ $institution->postalcode }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Country:</label>
                        <input type="text" name="country" class="form-control" value="{{ $institution->country }}">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Contact No:</label>
                        <input type="text" name="contactno" class="form-control" value="{{ $institution->contactno }}">
                      </div>
                </div>
                <div class="modal-footer">
                  <a href="{{ url('institutions') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
