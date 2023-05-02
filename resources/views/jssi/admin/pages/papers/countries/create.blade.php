@extends('layouts.admin')
@section('title', 'Create new country')
@section('content')
<div class="card card-primary">
	<!-- form start -->
	<form method="post" action="{{ route('jssi.admin.countries.store') }}">
		@csrf
        @method('POST')
		<div class="card-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Country name</label>
				<input type="text" class="form-control" id="countryName" name="countryName" placeholder="Lithuania" value="">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Country name</label>
				<input type="text" class="form-control" id="countryCode" name="countryCode" placeholder="LT" value="" maxlength="2">
			</div>
		</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-success">Create</button>
    <a href="{{ route('jssi.admin.countries') }}" class="btn btn-danger">Cancel</a>
</div>
    </form>
</div>
@endsection
