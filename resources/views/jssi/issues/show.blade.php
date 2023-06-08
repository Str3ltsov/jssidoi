@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">
            <span>Volume {{ $issue->volume }}&nbsp;</span>
            <span>Number {{ $issue->number }}&nbsp;</span>
            <span>{{ $issue->date->format('F Y') }}&nbsp;</span>
        </h2>
        <div class="d-flex flex-column">
            <div>
                Issue DOI:
                <a href="#" class="link-primary text-decoration-none">{{ $issue->doi ?? '' }}</a>
            </div>
            <a href="{{ asset("documents/issues/$issue->id/$issue->print") }}" target="_blank"
                class="text-decoration-none mt-2"
                @if (!$issue->print) style="pointer-events: none; cursor: default; color: gray;" @endif>
                Print version
            </a>
        </div>
        <hr>
        <p><b>ARTICLES:</b></p>
        @forelse($issue->articles->sortByDesc('article_type_id') as $article)
            <h5>{{ $loop->index + 1 }}.
                <a href="{{ route('jssiArticle', $article->id) }}" class="text-decoration-none">{{ $article->title }}</a>
            </h5>
            @if ($article->article_type_id == \App\Enums\ArticleTypesEnum::PAPER->value)
                <p>
                    <b>Reference</b>
                    to this paper should be made as follows:
                    <br>
                    {{ $article->getAuthorList() }} {{ date('Y', strtotime($issue->date)) }}. {{ $article->title }}
                    arise,
                    <i>Journal of Security and Sustainability Issues</i>
                    {{ $issue->volume }}({{ $issue->number }}): {{ $article->start_page }}-{{ $article->end_page }}.
                    <a href="https://doi.org/10.9770/{{ $article->doi }}" target="_blank" class="text-decoration-none">
                        https://doi.org/{{ $article->doi }}
                    </a>
                </p>
            @endif
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center gap-1 mb-3">
                    <i class="fa fa-eye" title="Views"></i>
                    {{ $article->views }}&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-download" title="Downloads"></i>
                    {{ $article->downloads }}
                </div>
                <div class="col-lg-3 d-flex align-items-center gap-1 mb-2 mb-lg-0">
                    <a href="{{ route('jssiArticle', $article->id) }}" class="btn btn-primary">HTML</a>
                    <a href="{{ asset("documents/issues/$issue->id/articles/$article->file") }}" class="btn btn-primary"
                        target="_blank">PDF</a>
                </div>
                @if ($article->doi)
                    <div class="col-lg-5 d-flex align-items-center mb-2 mb-lg-0">
                        <div class="d-flex align-items-center text-white">
                            <span class="bg-warning px-2 py-1" id="doi">DOI </span>
                            <a href="https://doi.org/{{ $article->doi }}" target="_blank"
                                class="bg-secondary px-2 py-1 text-decoration-none link-light">
                                {{ $article->doi }}
                            </a>
                        </div>
                    </div>
                @endif
                @if ($article->hal)
                    <div class="col-lg-4 d-flex align-items-center">
                        <div class="d-flex align-items-center text-white">
                            <span class="bg-danger px-2 py-1 opacity-50" id="doi">HAL </span>
                            <a href="https://hal.science/{{ $article->hal }}" target="_blank"
                                class="bg-secondary px-2 py-1 text-decoration-none link-light">
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
