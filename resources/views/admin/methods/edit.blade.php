@extends("layouts.master")

@section('title')
    Edit - Method | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - METHOD</h4>

                <form action="{{ url('methods-update/'.$method->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Method Name:</label>
                      <input type="text" name="methodname" class="form-control" value="{{ $method->methodname }}">
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
