@php
    $date = new DateTime($issue->date);
@endphp

@extends('layouts.admin')

@section('title')
    Edit issue #{{ sprintf('%s.%s', $issue->volume, $issue->number) }}
@endsection

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.issues.update', $issue->id) }}" enctype="multipart/form-data">
            {{--
        <form method="post" action="">
            --}} @csrf @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="issueVolume">Volume</label>
                            <input type="text" class="form-control" value="{{ $issue->volume }}" id="issueVolume"
                                name="issueVolume" />
                        </div>
                        <div class="col">
                            <label for="issueNum">Number</label>
                            <input type="text" class="form-control" value="{{ $issue->number }}" id="issueNum"
                                name="issueNum" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="issueDateMonth">Date</label><br />
                    <select name="issueDateMonth">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $date->format('m') == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }} </option>
                        @endfor
                    </select>
                    -
                    <select name="issueDateYear">
                        @for ($i = date('Y'); $i >= 2010; $i--)
                            <option value="{{ $i }}" {{ $date->format('Y') == $i ? 'selected' : '' }}>
                                {{ $i }} </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="issueOnlineFile">Print version</label>
                    <div class="input-group" id="printGroup">
                        @if (isset($issue->print))
                            <div id="printLink" style="display: flex">
                                <a href="{{ Storage::url('issues/' . $issue->print) }}">{{ $issue->print }}</a>
                                <div id="editPrintFile">
                                    <i class="fa-regular fa-pen-to-square ml-2 mt-1 cursor-pointer"></i>
                                </div>
                            </div>
                        @else
                            <div class="custom-file">
                                <input class="form-control" type="file" id="issuePrintFile" name="issuePrintFile" />
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="issueOnlineFile">Online version</label>
                        <div class="input-group" id="onlineGroup">
                            @if (isset($issue->online))
                                <div id="onlineLink" style="display: flex">
                                    <a href="{{ Storage::url('issues/' . $issue->online) }}">{{ $issue->online }}</a>
                                    <div id="editOnlineFile">
                                        <i class="fa-regular fa-pen-to-square ml-2 mt-1 cursor-pointer"></i>
                                    </div>
                                </div>
                            @else
                                <div class="custom-file">
                                    <input class="form-control" type="file" id="issueOnlineFile"
                                        name="issueOnlineFile" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check form-switch custom-switch">
                        <input class="form-check-input" type="checkbox" id="issueVisibleSwitch" name="issueVisibleSwitch"
                            {{ $issue->visible ? 'checked' : '' }}>
                        <label class="form-check-label" for="issueVisibleSwitch">Visible</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('jssi.admin.issues') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>

        <script></script>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#editPrintFile').on('click', function() {
            $('#printGroup').append('<div class=\"custom-file\">' +
                '<input class=\"form-control\" type=\"file\" id=\"issuePrintFile\" name=\"issuePrintFile\">' +
                '</div>'
            );
            $('#printLink').remove();
            console.log('asd');
        });
        $('#editOnlineFile').on('click', function() {
            $('#onlineGroup').append('<div class=\"custom-file\">' +
                '<input class=\"form-control\" type=\"file\" id=\"issueOnlineFile\" name=\"issueOnlineFile\">' +
                '</div>'
            );
            $('#onlineLink').remove();
            console.log('asd');
        });
    </script>
@endsection
