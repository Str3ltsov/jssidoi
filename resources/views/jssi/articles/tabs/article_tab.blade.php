<div class="tab-pane bg-transparent fade show active" id="article" role="tabpanel" aria-labelledby="article-tab">
    @if ($article->article_type_id == \App\Enums\ArticleTypesEnum::PAPER->value)
        Received: <i>{{ $article->received }}</i>&nbsp;&nbsp;|&nbsp;&nbsp;Accepted:
        <i>{{ $article->accepted }}</i>&nbsp;&nbsp;|&nbsp;&nbsp;Published: <i>{{ $article->published }}</i>
        <hr>
    @endif
    <h4>Title</h4>
    <p>{{ $article->title }}</p>
    <hr>
    @if ($article->article_type_id == \App\Enums\ArticleTypesEnum::PAPER->value)
        @if ($article->abstract)
            <h4>Abstract</h4>
            <p>{{ $article->abstract }}</p>
            <hr>
        @endif
        <h4>Keywords</h4>
        <p>
            crisis, creativity, businesses, pandemics, war
        </p>
        <hr>
    @endif
    @if (!$jelCodes->isEmpty())

        <h4>JEL classifications</h4>
        <p>

            @foreach ($jelCodes as $jelCode)
                <abbr title="{{ $jelCode->description }}">{{ $jelCode->name }}</abbr>
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        <hr>
    @endif
    <h4>URI</h4>
    <p>
        <a href="{{ route('jssiArticle', $article->id) }}" class="link-primary text-decoration-none">
            {{ route('jssiArticle', $article->id) }}
        </a>
    </p>
    <p></p>
    <hr>
    @if ($article->doi)
        <h4>DOI</h4>
        <p>
        </p>
        <div class="d-flex align-items-center text-white">
            <span class="bg-warning px-2 py-1" id="doi">DOI </span>
            <a href="https://doi.org/{{ $article->doi }}" target="_blank"
                class="bg-secondary px-2 py-1 text-decoration-none">
                {{ $article->doi }}
            </a>
        </div>
        <p></p>
        <hr>
    @endif
    @if ($article->hal)
        <h4>HAL</h4>
        <p>
        </p>
        <div class="d-flex align-items-center text-white">
            <span class="bg-danger px-2 py-1 opacity-50" id="doi">HAL </span>
            <a href="https://hal.science/{{ $article->hal }}" target="_blank"
                class="bg-secondary px-2 py-1 text-decoration-none link-light">
                {{ $article->hal }}
            </a>
        </div>
        <p></p>
        <hr>
    @endif
    <h4>Pages</h4>
    <p>{{ $article->start_page }}-{{ $article->end_page }}</p>
    <hr>
    <p>This is an open access issue and all published articles are licensed under a
        <br>
        <a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons Attribution 4.0
            International License</a>
    </p>
</div>
