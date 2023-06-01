@extends('layouts.admin')
@section('title')
    Create new keyword
@endsection
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.keywords.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Science">
                    <small id="keywordsHelp" class="form-text text-muted">Keywords should be seperated by comma (,).</small>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.keywords.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
