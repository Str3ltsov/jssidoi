@extends('layouts.admin')
@section('title', 'Create Menu')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Menu</h3>
                    </div>
                    @include('jssi.admin.menus.forms.store_form')
                </div>
            </div>
        </div>
    </div>
@endsection