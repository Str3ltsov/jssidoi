@extends('layouts.admin')
@section('title')
    Edit {{ $institution->title }}
@endsection
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.institutions.update', $institution->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Institution title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder=""
                        value="{{ $institution->title }}">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder=""
                        value="{{ $institution->website }}">
                </div>
                <div class="form-group">
                    <label for="website">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder=""
                        value="{{ $institution->city }}">
                </div>
                <div class="form-group">
                    <label for="website">Country name</label>
                    <select name="country" id="" class="custom-select">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $country->id == $institution->country_id ? 'selected' : '' }}>{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jssi.admin.institutions') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
