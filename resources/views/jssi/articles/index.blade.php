@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Articles</h2>
        @forelse($articles as $article)
            <p class="m-0 p-0">
                <a href="{{ route('jssiArticle', $article->id) }}" class="text-decoration-none">
                    {{ $article->title }}
                </a>
            </p>
            <p>
                <b>Reference</b>
                to this paper should be made as follows:
                <br>
                Kavan, �.; Kazanský, R.; Nečas, P. 2020. Identifying risks in selected social facilities when emergencies arise,
                <i>Journal of Security and Sustainability Issues</i>
                10(2): 379-388.
                <a href="https://doi.org/{{ $article->doi }}" target="_blank" class="text-decoration-none">
                    https://doi.org/{{ $article->doi }}
                </a>
            </p>
            <div class="row">
                <div id="share-buttons" class="col-lg-5 d-flex align-items-center gap-2 mb-3 mb-lg-0">
                    Share:
                    <div class="d-flex align-items-center gap-1">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-square-facebook fs-4"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-linkedin fs-4"></i>
                        </a>
                        <a href="https://twitter.com/home?status=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-square-twitter fs-4"></i>
                        </a>
                        <a href="http://www.mendeley.com/import/?url=http://jssidoi.org/jssi/papers/papers/view/625/Kavan_Identifying_risks_in_selected_social_facilities_when_emergencies_arise.pdf" target="_blank">
                            <i class="fa-brands fa-mendeley fs-4"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 d-flex gap-4 gap-lg-0">
                    <div class="col-lg-6 d-flex align-items-center gap-1">
                        <a href="{{ route('jssiArticle', $article->id) }}" class="btn btn-primary">HTML</a>
                        <a href="#" class="btn btn-primary" target="_blank">PDF</a>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center gap-1">
                        <i class="fa fa-eye" title="Views"></i>
                        {{ $article->views }}&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-download" title="Downloads"></i>
                        {{ $article->downloads }}
                    </div>
                </div>
            </div>
            <hr>
        @empty
            <span class="text-muted">No articles</span>
        @endforelse
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page {{ $articles->currentPage() }} of {{ $articles->lastPage() }}, showing {{ count($articles) }} records out of {{ $articles->total() }} total
                <div class="d-flex justify-content-center mt-4">
                    {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
