@extends('layouts.admin')

@section('title')
    Create new Author
@endsection
@push('scripts')
    <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.authors.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" placeholder="John" name="firstName" />
                        </div>
                        <div class="col">
                            <label for="midName">Middle name</label>
                            <input type="text" class="form-control" name="midName" />
                        </div>
                        <div class="col">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" placeholder="Doe" name="lastName" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="firstName">Email</label>
                            <input type="email" class="form-control" placeholder="hello@world.com" name="email" />
                        </div>
                        <div class="col">
                            <label for="midName">ORCID</label>
                            <input type="text" class="form-control" placeholder="0000-0000-0000-0000" name="orcid"
                                data-inputmask='"mask": "9999-9999-9999-9999"' data-mask>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Institutions</label>
                    <select class="duallistbox" multiple="multiple" name="institutions[]">
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">
                                {{ $institution->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.authors') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('[data-mask]').inputmask();
            $('.duallistbox').bootstrapDualListbox();
        })
    </script>
@endsection
