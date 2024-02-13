@extends("layouts.master")

@section('title')
    Registerd User | ADEQA
@endsection


@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="exampleModalLabel">ASSIGN USER</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/save-user-register" method="POST">
            {{ csrf_field() }}

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Username:</label>
                    <input type="text" name="username" class="form-control" id="recipient-name">
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Fullname:</label>
                    <input type="text" name="fullname" class="form-control" id="recipient-name">
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email:</label>
                    <input type="text" name="email" class="form-control" id="recipient-name">
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Designation:</label>
                    <input type="text" name="designation" class="form-control" id="recipient-name">
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Institution:</label>
                    <input type="text" name="institution" class="form-control" id="recipient-name">
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Roles:</label>
                <select name="roles" class="form-control">
                    <option value="admin"{{ old('roles') == 'admin' ? ' selected' : '' }}>admin</option>
                    <option value="user"{{ old('roles') == 'user' ? ' selected' : '' }}>user</option>
                </select>
            </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-success">SAVE</button>
        </div>
        </form>
      </div>
    </div>
  </div>

{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">DELETE</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form id="delete_modal_Form" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="modal-body">
                    <input type="hidden" id="delete_assignuser_id">
                    <h5>Are you sure you want to delete this Assign User ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete It.</button>
                </div>
            </form>
      </div>
    </div>
  </div>
{{-- End Delete Modal --}}

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">REGISTERED USER
                <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                 <i class="now-ui-icons ui-1_simple-add"></i>
                </button>
              </h4>
          @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            @endif
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Institution</th>
                <th>Roles</th>
                <th style="text-align: center;">ACTIONS</th>
              </thead>



              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->designation }}</td>
                  <?php
                    $conn = new mysqli("localhost", "root", "","adeqa");

                    $sql = "SELECT A.id, B.institution
                            FROM users A, institutions B
                            WHERE A.institution_id = B.id AND B.id = '".$user->institution_id."' AND a.id = '".$user->id."'";
                    $result = $conn->query($sql);

                    while($row = $result -> fetch_object()){
                        $institutionname = $row->institution;
                    ?>
                  <td>{{ $institutionname }}</td>
                  <?php
                    }
                    ?>

                  <td>&nbsp;{{ $user->roles }}</td>
                    <td style="display: flex; justify-content: center;">
                        <a href="/user-edit/{{$user->id}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                        &nbsp;&nbsp;
                        <form action="/user-delete/{{$user->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                          </form>
                    </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@endsection


@section('scripts')

@endsection
