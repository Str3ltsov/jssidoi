@extends('layouts.admin')
@section('title', 'Edit JEL Code Category')
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.jel.categories.update', $jelCategory->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" id="countryName" name="name" placeholder="A" maxlength="1"
                        value="{{ $jelCategory->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="countryCode" name="description" placeholder="Enter..."
                        value="{{ $jelCategory->description }}">
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jssi.admin.jel.categories.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
