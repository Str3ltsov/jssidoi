@extends('layouts.admin')
@section('title', 'Menus')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title d-flex align-items-center justify-content-between w-100">
                        <span>Menus</span>
                        <a href='{{ route('menus.create') }}' class="btn btn-success">New Menu</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive">
                        @include('jssi.admin.menus.table')
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-md-between justify-content-center">
                        <div class="col-md-6 col-12">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                Showing {{ count($menus) }} out of {{ $menus->total() }} entries
                            </div>
                        </div>
                        <div class="col-md-6 col-12 d-flex justify-content-end">
                            {{ $menus->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection