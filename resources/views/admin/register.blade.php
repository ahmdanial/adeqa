@extends("layouts.master")

@section('title')
    Registerd User | ADEQA
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> REGISTERED USER</h4>
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
                <th>Department</th>
                <th>Roles</th>
                <th>EDIT</th>
                <th>DELETE</th>
              </thead>

              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->designation }}</td>
                  <td>{{ $user->department }}</td>
                  <td>{{ $user->roles }}</td>
                  <td>
                    <a href="/user-edit/{{$user->id}}" class="btn btn-success">EDIT</a>
                    </td>
                  <td>
                    <form action="/user-delete/{{$user->id}}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger">DELETE</button>
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
