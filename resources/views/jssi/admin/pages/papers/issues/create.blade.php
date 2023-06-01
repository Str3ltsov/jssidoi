@extends('layouts.admin')

@section('title')
    Create new issue
@endsection



@section('content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.issues.store') }}" enctype="multipart/form-data">
            @csrf @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="issueVolume">Volume</label>
                            <input type="text" class="form-control" placeholder="1" id="issueVolume"
                                name="issueVolume" />
                        </div>
                        <div class="col">
                            <label for="issueNum">Number</label>
                            <input type="text" class="form-control" placeholder="1" id="issueNum" name="issueNum" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="issueDateMonth">Date</label><br />
                    <select name="issueDateMonth">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }} </option>
                        @endfor
                    </select>
                    -
                    <select name="issueDateYear">
                        @for ($i = date('Y'); $i >= 2010; $i--)
                            <option value="{{ $i }}">
                                {{ $i }} </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="issueOnlineFile">Print version</label>
                    <div class="input-group" id="printGroup">
                        <div class="custom-file">
                            <input class="form-control" type="file" id="issuePrintFile" name="issuePrintFile" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issueOnlineFile">Online version</label>
                        <div class="input-group" id="onlineGroup">
                            <div class="custom-file">
                                <input class="form-control" type="file" id="issueOnlineFile" name="issueOnlineFile" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check form-switch custom-switch">
                        <input class="form-check-input" type="checkbox" id="issueVisibleSwitch" name="issueVisibleSwitch"
                            checked="checked">
                        <label class="form-check-label" for="issueVisibleSwitch">Visible</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ route('jssi.admin.issues') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>

        <script></script>
    </div>
@endsection
