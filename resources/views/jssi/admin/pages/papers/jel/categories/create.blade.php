@extends('layouts.admin')
@section('title', 'Create new JEL Code Category')
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.jel.categories.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" id="countryName" name="name" placeholder="A" maxlength="1"
                        value="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="countryCode" name="description" placeholder="Enter...">
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.jel.categories.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
