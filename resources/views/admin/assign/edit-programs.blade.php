@extends("layouts.master")

@section('title')
    Assign Program Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">ASSIGN USER SETUP EDIT</h4>

                <form action="{{ url('assign-programs-update/'.$assignProgram->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Program:</label>
                        <select name="prog_id" class="form-control" id="prog_id">
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ $program->id == $assignProgram->prog_id ? 'selected' : '' }}>
                                {{ $program->programname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach($labs as $lab) {{-- Assuming $labs is the collection of labs --}}
                            <option value="{{ $lab->id }}" {{ $lab->id == $assignProgram->lab_id ? 'selected' : '' }}>
                                {{ $lab->labname }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                  <a href="{{ url('assign-program') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
