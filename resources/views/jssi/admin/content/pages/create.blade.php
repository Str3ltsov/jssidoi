@extends('layouts.admin')
@section('title')
    Create new page.
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
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
                    <label for="website">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter...">
                </div>
                <div class="form-group">
                    <label for="website">Slug</label>
                    <div id="editor"></div>
                </div>

                {{-- <div class="form-group">
                    <label for="website">City</label>
                    <input type="text" class="form-control" id="сщтеуте" name="city" placeholder="Enter...">
                </div> --}}
                {{-- <div class="form-group">
                    <label for="website">Country name</label>
                    <select name="country" id="" class="custom-select">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
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

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
