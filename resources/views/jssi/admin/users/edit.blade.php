@extends('layouts.admin')
@section('title')
    Edit {{ $user->email }}
@endsection
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder=""
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <select class="custom-select" name="role[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jssi.admin.countries') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
