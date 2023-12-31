@extends("layouts.master")

@section('title')
    Reagent Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">REAGENT SETUP EDIT</h4>

                <form action="{{ url('reagents-update/'.$reagent->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Reagent Name:</label>
                      <input type="text" name="reagent" class="form-control" value="{{ $reagent->reagent }}">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach($instrument as $inst)
                                <option value="{{ $inst->id }}" {{ $inst->id == $reagent->instrument_id ? 'selected' : '' }}>
                                    {{ $inst->instrumentname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                  <a href="{{ url('reagents') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
