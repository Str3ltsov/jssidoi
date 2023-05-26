<div class="tab-pane bg-transparent fade" id="issue" role="tabpanel" aria-labelledby="issue-tab">
    <h4>Journal title</h4>
    <h>Entrepreneurship and Sustainability Issues</h>
    <hr>
    <h4>Volume</h4>
    <p>{{ $article->issue->volume }}</p>
    <hr>
    <h4>Number</h4>
    <p>{{ $article->issue->number }}</p>
    <hr>
    <h4>Issue date</h4>
    <p>{{ $article->issue->date->format('F Y') }}</p>
    <hr>
    <h4>Issue DOI</h4>
    <p>
    </p>
    @if ($article->issue->doi)
        <div class="d-flex align-items-center text-white">
            <span class="bg-warning px-2 py-1" id="doi">DOI </span>
            <a href="https://doi.org/{{ $article->issue->doi }}" target="_blank" class="bg-secondary py-1 px-2 text-decoration-none">
                {{ $article->issue->doi }}
            </a>
        </div>
    @endif
    <p></p>
    <hr>
    @if ($article->issue->online)
        <h4>ISSN</h4>
        <p>{{ $article->issue->online }}</p>
        <hr>
    @endif
    <h4>Publisher</h4>
    <p>VšĮ Entrepreneurship and Sustainability Center, Vilnius, Lithuania</p>
</div>
