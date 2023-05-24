@extends('layouts.admin')
@section('title', 'Edit JEL Code ')
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.jel.codes.update', $jelCode->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Code name</label>
                    <input type="text" class="form-control" id="countryName" name="name" placeholder="A" maxlength="3"
                        value="{{ $jelCode->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="countryCode" name="description" placeholder="Enter..."
                        value="{{ $jelCode->description }}">
                </div>
                <div class="form-group">
                    <label for="jel_subcategory_id">Subcategory</label>
                    @if ($subcategories->isEmpty())
                        <p>No Sub-Categories available. <a href="{{ route('jssi.admin.jel.subcategories.create') }}">Create
                                one first.</a>
                        </p>
                    @else
                        <select name="jel_subcategory_id" class="custom-select" id="">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    {{ $jelCode->jel_subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                    {{ sprintf('%s | %s', $subcategory->name, $subcategory->description) }}</option>
                            @endforeach
                        </select>
                    @endif
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
