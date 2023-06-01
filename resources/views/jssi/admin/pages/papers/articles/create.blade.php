@extends('layouts.admin')
@section('title')
    Create new article
@endsection
@push('scripts')
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush
@section('content')
    <div class="card
        card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.articles.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="issue">Issue</label>
                    <select class="custom-select" name="issue_id">
                        @foreach ($issues as $issue)
                            <option value="{{ $issue->id }}">
                                Vol. {{ $issue->volume }} Num. {{ $issue->number }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="article_type_id">Article type</label>
                    <select class="custom-select" name="article_type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"> {{ $type->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="articleTitle" name="title" placeholder="Enter...">

                </div>
                <div class="form-group">
                    <label for="abstract">Abstract</label>
                    <textarea class="form-control" rows="3" name="abstract" placeholder="Enter..." style="height: 62px;"></textarea>
                </div>
                <div class="form-group">
                    <label for="abstract">References</label>
                    <textarea class="form-control" rows="3" name="references" placeholder="Enter..." style="height: 62px;"></textarea>

                    </textarea>
                </div>
                <div class="form-group">
                    <label>Recieved:</label>
                    <div class="input-group date" id="receivedDate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#receivedDate"
                            name="received" />
                        <div class="input-group-append" data-target="#receivedDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Accepted:</label>
                    <div class="input-group date" id="acceptedDate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#accepteddDate"
                            name="accepted" />
                        <div class="input-group-append" data-target="#acceptedDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="start_page">Pages</label>
                    <div class="form-group col-1">
                        <input class="form-control" type="number" name="start_page" min='0' placeholder="0">
                    </div>
                    -
                    <div class="form-group col-1">
                        <input class="form-control" type="number" name="end_page" min='0' placeholder="50">
                    </div>
                </div>
                <div class="form-group">
                    <label for="abstract">DOI</label>
                    <input type="text" class="form-control" name="doi" id=""
                        placeholder="10.9770/jssi.2022.2.2(1)">
                </div>
                <div class="form-group">
                    <label for="abstract">HAL</label>
                    <input type="text" class="form-control" name="hal" id="" placeholder="hal-00000000">
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Authors</label>
                            <select class="duallistbox" multiple="multiple" name="authorInstitutions[]">
                                @foreach ($authorsInstitutions as $authorInstitution)
                                    <option value="{{ $authorInstitution->id }}">
                                        {{ sprintf('%s (%s)', $authorInstitution->author->fullname(), $authorInstitution->institution->title) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="form-group">
                    <label for="articleFile">Print version</label>
                    <div class="input-group" id="fileGroup">
                        <div class="custom-file">
                            <input class="form-control" type="file" id="articleFile" name="articleFile" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="abstract">Keywords</label>
                    <textarea class="form-control" rows="3" name="keywords" placeholder="Enter..." style="height: 62px;"></textarea>
                </div>
                <small id="keywordsHelp" class="form-text text-muted">Keywords should be seperated by comma (,).</small>
                <div class="form-group">
                    <div class="form-check form-switch custom-switch">
                        <input class="form-check-input" type="checkbox" id="articleVisibleSwitch"
                            name="articleVisibleSwitch" checked>
                        <label class="form-check-label" for="articleVisibleSwitch">Visible</label>
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

@section('script')
    <script>
        $(function() {
            $('#receivedDate').datetimepicker({
                format: 'L'
            });
            $('#acceptedDate').datetimepicker({
                format: 'L'
            });
            $('.duallistbox').bootstrapDualListbox();
        })
    </script>
@endsection
