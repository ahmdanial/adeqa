@extends("layouts.master")

@section('title')
    Instrument Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">Instrument SETUP EDIT</h4>

                <form action="{{ url('instruments-update/'.$instrument->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Instrument Name:</label>
                      <input type="text" name="instrumentname" class="form-control" value="{{ $instrument->instrumentname }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Department:</label>
                        <select name="department_id" class="form-control" id="department_id">
                            @foreach($departments as $dep)
                                <option value="{{ $dep->id }}" {{ $dep->id == $instrument->department_id ? 'selected' : '' }}>
                                    {{ $dep->department }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('instruments') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
