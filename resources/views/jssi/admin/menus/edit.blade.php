@extends('layouts.admin')
@section('title', 'Edit Menu')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Menu</h3>
                    </div>
                    @include('jssi.admin.menus.forms.update_form')
                </div>
            </div>
        </div>
    </div>
@endsection