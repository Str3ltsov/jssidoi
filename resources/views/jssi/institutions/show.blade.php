@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Articles</h2>
        @forelse($articles as $article)
            <h5 class="mb-3">
                <a href="{{ route('jssiArticle', $article->id) }}" class="text-decoration-none">{{ $article->title }}</a>
            </h5>
            <div class="d-flex flex-wrap gap-2 mb-3" style="line-height: 16px">
                @forelse($authors[$article->id] as $author)
                    <div class="fw-bold d-flex gap-1">
                        <div>
                            <a href="http://orcid.org/0000-0001-9108-0525" class="rounded-5 bg-success text-decoration-none px-1 text-center text-white" target="_blank">
                                iD
                            </a>
                        </div>
                        <div>{{ $author->first_name }}</div>
                        <div>{{ $author->middle_name ?? '' }}</div>
                        <div>
                            {{ $author->last_name ?? '' }}@if (!$loop->last),@endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center gap-1 mb-3">
                    <i class="fa fa-eye" title="Views"></i>
                    {{ $article->views }}&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-download" title="Downloads"></i>
                    {{ $article->downloads }}
                </div>
                <div class="col-lg-3 d-flex align-items-center gap-1 mb-2 mb-lg-0">
                    <a href="{{ route('jssiArticle', $article->id) }}" class="btn btn-primary">HTML</a>
                    <a href="{{ asset("documents/issues/{$article->issue->id}/articles/$article->file")  }}" class="btn btn-primary" target="_blank">PDF</a>
                </div>
                @if ($article->doi)
                    <div class="col-lg-5 d-flex align-items-center mb-2 mb-lg-0">
                        <div class="d-flex align-items-center text-white">
                            <span class="bg-warning px-2 py-1" id="doi">DOI </span>
                            <a href="https://doi.org/{{ $article->doi }}" target="_blank" class="bg-secondary px-2 py-1 text-decoration-none link-light">
                                {{ $article->doi }}
                            </a>
                        </div>
                    </div>
                @endif
                @if ($article->hal)
                    <div class="col-lg-4 d-flex align-items-center">
                        <div class="d-flex align-items-center text-white">
                            <span class="bg-danger px-2 py-1 opacity-50" id="doi">HAL </span>
                            <a href="https://hal.science/{{ $article->hal }}" target="_blank" class="bg-secondary px-2 py-1 text-decoration-none link-light">
                                {{ $article->hal }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <hr>
        @empty
            <span class="text-muted">No articles</span>
        @endforelse
    </div>
@endsection
