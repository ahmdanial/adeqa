@extends("layouts.master")

@section('title')
    Assign User Setup Edit | ADEQA
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">ASSIGN USER SETUP EDIT</h4>

                <form action="{{ url('assign-users-update/'.$assignUser->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">User:</label>
                        <select name="user_id" class="form-control" id="user_id">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $assignUser->user_id ? 'selected' : '' }}>
                                {{ $user->username }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Lab:</label>
                        <select name="lab_id" class="form-control" id="lab_id">
                            @foreach($labs as $lab) {{-- Assuming $labs is the collection of labs --}}
                            <option value="{{ $lab->id }}" {{ $lab->id == $assignUser->lab_id ? 'selected' : '' }}>
                                {{ $lab->labname }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                  <a href="{{ url('assign-user') }}" class="btn btn-primary" data-bs-dismiss="modal">BACK</a>
                  <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
              </h4>
            </div>
        </div>
    </div>
</div>

@endsection
