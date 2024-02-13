@extends("layouts.master")

@section('title')
    Edit - Program | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - PROGRAM</h4>

                <form action="{{ url('programs-update/'.$program->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Program Name:</label>
                      <input type="text" name="programname" id="programname" class="form-control" value="{{ $program->programname }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Open Date:</label>
                        <input type="date" name="opendate" id="opendate" class="form-control" value="{{ $program->opendate }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Close Date:</label>
                        <input type="date" name="closedate" id="closedate" class="form-control" value="{{ $program->closedate }}">
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('programs') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
