@extends('layouts.admin')
@section('title', 'Edit review')
@push('scripts')
    <script src="/ckeditor5/build/ckeditor.js"></script>
@endpush

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.reviews.update', $review->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group"><!-- very bad solution. Needs to be changed to smth better-->
                    <label for="exampleInputEmail1">Article ID</label>
                    <input type="text" class="form-control" id="articleId" name="articleId" placeholder="1"
                        value="{{ $review->article->id }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Review title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $review->title }}">
                </div>
                <div class="form-group">
                    <label for="content">Review text</label>
                    <textarea class="form-control" name="content" rows='5' id='content-textarea'>{{ $review->content }}</textarea>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jssi.admin.reviews.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#content-textarea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
