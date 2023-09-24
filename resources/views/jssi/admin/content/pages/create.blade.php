@extends('layouts.admin')
@section('title')
    Create new page.
@endsection

@push('scripts')
    <script src="/ckeditor5/build/ckeditor.js"></script>
@endpush
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('admin.pages.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter...">
                    <small id="keywordsHelp" class="form-text text-muted">Slug is generated automatically.</small>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" rows='5' id='content-textarea'></textarea>
                </div>

                <div class="input-group col-12">
                    <div class="form-group mb-0">
                        <label for="form-check">Visible</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visible" value="1">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visible" value="0" checked>
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-danger">Cancel</a>
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
        $('#title').change(function(e) {
            $.get('{{ route('admin.tools.slugify') }}', {
                    'title': $(this).val()
                },
                function(data) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>
@endsection
