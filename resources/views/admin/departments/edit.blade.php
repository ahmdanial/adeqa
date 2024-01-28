@extends("layouts.master")

@section('title')
    Department Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">DEPARTMENT SETUP EDIT</h4>

                <form action="{{ url('departments-update/'.$department->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Department Name</label>
                        <input type="text" name="department" class="form-control" value="{{ $department->department }}">
                      </div>

                <div class="modal-footer">
                  <a href="{{ url('departments') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
