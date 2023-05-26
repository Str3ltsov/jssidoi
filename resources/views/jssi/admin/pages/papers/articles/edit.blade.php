@extends('layouts.admin')
@section('title')
    Edit {{ $article->title }}
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
        <form method="post" action="{{ route('jssi.admin.articles.update', $article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="issue_id">Issue</label>
                    <select class="custom-select" name="issue_id">
                        @foreach ($issues as $issue)
                            <option value="{{ $issue->id }}" {{ $article->issue_id == $issue->id ? 'selected' : '' }}>
                                Vol. {{ $issue->volume }} Num. {{ $issue->number }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="article_type_id">Article type</label>
                    <select class="custom-select" name="article_type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $article->article_type_id == $type->id ? 'selected' : '' }}> {{ $type->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="articleTitle" name="title" placeholder=""
                        value="{{ $article->title }}">

                </div>
                <div class="form-group">
                    <label for="abstract">Abstract</label>
                    <textarea class="form-control" rows="3" name="abstract" placeholder="Enter..." style="height: 62px;">{{ $article->abstract }}</textarea>
                </div>
                <div class="form-group">
                    <label for="abstract">References</label>
                    <textarea class="form-control" rows="3" name="references" placeholder="Enter..." style="height: 62px;"></textarea>
                    <small id="keywordsHelp" class="form-text text-muted">Keywords should be seperated by semicolon
                        (;)</small>
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
                            name='accepted' />
                        <div class="input-group-append" data-target="#acceptedDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="start_page">Pages</label>
                    <div class="form-group col-1">
                        <input class="form-control" type="number" name="startPage" min='0' placeholder="0"
                            value="{{ $article->start_page }}">
                    </div>
                    -
                    <div class="form-group col-1">
                        <input class="form-control" type="number" name="end_page" min='0' placeholder="0"
                            value="{{ $article->end_page }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="abstract">DOI</label>
                    <input type="text" class="form-control" name="doi" id="" value="{{ $article->doi }}">
                </div>
                <div class="form-group">
                    <label for="abstract">HAL</label>
                    <input type="text" class="form-control" name="hal" id="" value="{{ $article->hal }}">
                </div>
                <div class="form-group">
                    <label for="abstract">Keywords</label>
                    <textarea class="form-control" rows="3" name="keywords" placeholder="Enter..." style="height: 62px;">{{ $keywords }}</textarea>
                    <small id="keywordsHelp" class="form-text text-muted">Keywords should be seperated by comma
                        (,)</small>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Authors</label>
                            <select class="duallistbox" multiple="multiple" name="authorInstitutions[]">
                                @foreach ($authorsInstitutions as $authorInstitution)
                                    <option value="{{ $authorInstitution->id }}"
                                        {{ in_array($authorInstitution->id, $selectedAuthorInstitutionIds) ? 'selected="selected"' : '' }}>
                                        {{ $authorInstitution->author->fullname() . sprintf(' (%s)', $authorInstitution->institution->title) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>JEL Codes</label>
                            <select class="duallistbox" multiple="multiple" name="jelCodes[]">
                                @foreach ($jelCodes as $jelCode)
                                    <option value="{{ $jelCode->id }}"
                                        {{ in_array($jelCode->id, $selectedJelCodes) ? 'selected="selected"' : '' }}>
                                        {{ sprintf('%s | %s', $jelCode->name, $jelCode->description) }}
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
                        @if (isset($article->file))
                            <div id="fileLink" style="display: flex">
                                <a href="{{ Storage::url('articles/' . $article->file) }}">{{ $article->file }}</a>
                                <div id="editArticleFile">
                                    <i class="fa-regular fa-pen-to-square ml-2 mt-1 cursor-pointer"></i>
                                </div>
                            </div>
                        @else
                            <div class="custom-file">
                                <input class="form-control" type="file" id="articleFile" name="articleFile" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch custom-switch">
                        <input class="form-check-input" type="checkbox" id="articleVisibleSwitch"
                            name="articleVisibleSwitch" {{ $article->visible ? 'checked' : '' }}>
                        <label class="form-check-label" for="articleVisibleSwitch">Visible</label>
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
        $(document).ready(function() {
            $('#receivedDate').datetimepicker({
                format: 'L',
                {!! isset($article->received) ? 'defaultDate:' . sprintf("\"%s\"", $article->received) : '' !!}
            });
            $('#acceptedDate').datetimepicker({
                format: 'L',
                {!! isset($article->accepted) ? 'defaultDate:' . sprintf("\"%s\"", $article->accepted) : '' !!}
            });
            $('.duallistbox').bootstrapDualListbox()

            $('#editArticleFile').on('click', function() {
                $('#fileGroup').append('<div class=\"custom-file\">' +
                    '<input class=\"form-control\" type=\"file\" id=\"articleFile\" name=\"articleFile\">' +
                    '</div>'
                );
                $('#fileLink').remove();
            });
        })
    </script>
@endsection
