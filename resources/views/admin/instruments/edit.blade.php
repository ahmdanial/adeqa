@extends("layouts.master")

@section('title')
    Edit Instrument | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - INSTRUMENTS</h4>

                <form action="{{ url('instruments-update/'.$instrument->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Instrument Name:</label>
                      <input type="text" name="instrumentname" class="form-control" value="{{ $instrument->instrumentname }}">
                    </div>
                </div>
                <div class="modal-footer">
                  <a href="{{ url('instruments') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
