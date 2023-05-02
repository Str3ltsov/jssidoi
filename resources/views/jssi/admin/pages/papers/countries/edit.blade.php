@extends('layouts.admin')
@section('title')
Edit {{ $country->name}}
@endsection
@section('content')
<div class="card card-primary">
	<!-- form start -->
	<form method="post" action="{{ route('jssi.admin.countries.update', $country->id)}}">
		@csrf
        @method('PUT')
		<div class="card-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Country name</label>
				<input type="text" class="form-control" id="countryName" name="countryName" placeholder="" value="{{ $country->name}}">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Country name</label>
				<input type="text" class="form-control" id="countryCode" name="countryCode" placeholder="" value="{{ $country->code}}">
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
