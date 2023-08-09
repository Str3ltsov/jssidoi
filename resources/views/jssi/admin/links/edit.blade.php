@extends('layouts.admin')
@section('title', "Edit $menu->title Link")
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Menu</h3>
                </div>
                @include('jssi.admin.links.forms.update_form')
            </div>
        </div>
    </div>
</div>
@endsection