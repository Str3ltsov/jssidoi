@extends('layouts.admin')
@section('title', 'Create new JEL Code Sub-Category')
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.jel.subcategories.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sub-Category name</label>
                    <input type="text" class="form-control" name="name" placeholder="A1" maxlength="2" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    @if ($jelCategories->isEmpty())
                        <p>No categories available. <a href="{{ route('jssi.admin.jel.categories.create') }}"> Create one
                                first.</a></p>
                    @else
                        <select name="jel_category_id" id="" class="custom-select">
                            @foreach ($jelCategories as $jelCategory)
                                <option value="{{ $jelCategory->id }}">
                                    {{ sprintf('%s | %s', $jelCategory->name, $jelCategory->description) }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.jel.subcategories.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
