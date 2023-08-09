@extends('layouts.admin')
@section('title', "$menu->title")
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title d-flex align-items-center justify-content-between w-100">
                        <span>Links</span>
                        <a href='{{ route('links.create', $menu->id) }}' class="btn btn-success">New Link</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive">
                        @include('jssi.admin.links.table')
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-md-between justify-content-center">
                        <div class="col-md-6 col-12">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                Showing {{ count($links) }} out of {{ $links->total() }} entries
                            </div>
                        </div>
                        <div class="col-md-6 col-12 d-flex justify-content-end">
                            {{ $links->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection