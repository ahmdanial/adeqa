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

                <form action="{{ url('programs-update/'.$program->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Program Name:</label>
                      <input type="text" name="programname" id="programname" class="form-control" value="{{ $program->programname }}">
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('programs') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
