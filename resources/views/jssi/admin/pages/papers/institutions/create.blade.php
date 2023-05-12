@extends('layouts.admin')
@section('title')
    Create new institution.
@endsection
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.institutions.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Institution title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="website">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="website">Country name</label>
                    <select name="country" id="" class="custom-select">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.institutions') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
