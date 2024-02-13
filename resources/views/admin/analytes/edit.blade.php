@extends("layouts.master")

@section('title')
    Analyte Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">ANALYTE SETUP EDIT</h4>

                <form action="{{ url('analytes-update/'.$analyte->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Analyte Name:</label>
                      <input type="text" name="analytename" class="form-control" value="{{ $analyte->analytename }}">
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('analytes') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
