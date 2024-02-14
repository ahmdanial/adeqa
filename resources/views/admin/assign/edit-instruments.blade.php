@extends("layouts.master")

@section('title')
    Assign Instrument Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">EDIT - USER</h4>

                <form action="{{ url('assign-instruments-update/'.$assignInstrument->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Institution:</label>
                        <select name="institution_id" class="form-control" id="institution_id">
                            @foreach($institutions as $institution)
                            <option value="{{ $institution->id }}" {{ $institution->id == $assignInstrument->institution_id ? 'selected' : '' }}>
                                {{ $institution->institution }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Instrument:</label>
                        <select name="instrument_id" class="form-control" id="instrument_id">
                            @foreach($instruments as $instrument) {{-- Assuming $instruments is the collection of instruments --}}
                            <option value="{{ $instrument->id }}" {{ $instrument->id == $assignInstrument->instrument_id ? 'selected' : '' }}>
                                {{ $instrument->instrumentname }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                  <a href="{{ url('assign-instrument') }}" class="btn btn-primary">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
