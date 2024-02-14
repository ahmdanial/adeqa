@extends("layouts.master")

@section('title')
    Edit - Registered | ADEQA
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>EDIT - USER</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/user-register-update/{{ $users->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $users->username }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" name="username" value="{{ $users->designation }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Institution</label>
                                <input type="text" name="username" value="{{ $users->institution->institution }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Give Role</label>
                                <select name="roles" class="form-control">
                                    <option value="admin"{{ old('roles') == 'admin' ? ' selected' : '' }}>admin</option>
                                    <option value="user"{{ old('roles') == 'user' ? ' selected' : '' }}>user</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="/user-register" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
