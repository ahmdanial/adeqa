@extends("layouts.master")

@section('title')
    Edit - Unit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - UNIT</h4>

              <form action="{{ url('units-update/'.$unit->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Unit Name:</label>
                    <input type="text" name="unit" class="form-control" value="{{ $unit->unit }}">
                </div>

                <div class="modal-footer">
                    <a href="{{ url('units') }}" class="btn btn-primary">BACK</a>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </form>

              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
