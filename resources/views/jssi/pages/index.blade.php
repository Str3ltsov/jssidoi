@extends('layouts.app')

@section('content')
    <div id="page-{{ $page->id }}" class="page custom-page mt-4">
        <h2 class="mt-4">{{ $page->title }}</h2>
        <div class="page-info">
        </div>
        <div class="node-body">
            {!! $page->content !!}
        </div>
        <div class="node-more-info">
        </div>
    </div>

    <div id="comments" class="node-comments">
    </div>
@endsection
