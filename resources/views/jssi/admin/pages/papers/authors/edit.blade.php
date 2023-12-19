@extends('layouts.admin')
@section('title')
    Edit {{ $author->fullname() }}
@endsection

@push('scripts')
    <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <meta charset="utf-8">
@endpush

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.authors.update', $author->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" value="{{ $author->first_name }}" name="firstName" />
                        </div>
                        <div class="col">
                            <label for="midName">Middle name</label>
                            <input type="text" class="form-control" value="{{ $author->middle_name }}" name="midName" />
                        </div>
                        <div class="col">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" value="{{ $author->last_name }}" name="lastName" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="firstName">Email</label>
                            <input type="email" class="form-control" value="{{ $author->email }}" name="email" />
                        </div>
                        <div class="col">
                            <label for="midName">ORCID</label>
                            <input type="text" class="form-control" value="{{ $author->orcid }}" name="orcid"
                                data-inputmask='"mask": "9999-9999-9999-9999"' data-mask>
                        </div>
                        <div class="col">
                            <label for="midName">User ID</label>
                            <input type="number" class="form-control" value="{{ $author->user_id }}" name="userId">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="institutions[]">Institutions</label>
                    <select multiple class="form-control" name="institutions[]">
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}"
                                {{ $author->authorsInstitutions()->where('institution_id', $institution->id)->exists()? 'selected="selected"': '' }}>
                                {{ $institution->title }}</option>
                        @endforeach
                    </select>
                </div>
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

@section('script')
    <script>
        $(function() {
            $('[data-mask]').inputmask();
        })
    </script>
@endsection
