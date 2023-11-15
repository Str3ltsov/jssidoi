@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <div class="breadcrumb">
            <div class="row">
                <div class="col-md-4">
                    <script src="https://crossmark-cdn.crossref.org/widget/v2.0/widget.js"></script>
                    <a data-target="crossmark" style="cursor: pointer;">
                        <img src="https://crossmark-cdn.crossref.org/widget/v2.0/logos/CROSSMARK_Color_horizontal.svg"
                            alt="crossmark" width="150">
                    </a>
                </div>
                <div id="share-buttons" class="col-md-4 d-flex gap-1">
                    Share:
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//jssidoi.org/jssi/papers/papers/view/625"
                        target="_blank">
                        <i class="fa-brands fa-square-facebook fs-5"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//jssidoi.org/jssi/papers/papers/view/625"
                        target="_blank">
                        <i class="fa-brands fa-linkedin fs-5"></i>
                    </a>
                    <a href="https://twitter.com/home?status=http%3A//jssidoi.org/jssi/papers/papers/view/625"
                        target="_blank">
                        <i class="fa-brands fa-square-twitter fs-5"></i>
                    </a>
                    <a href="http://www.mendeley.com/import/?url=http://jssidoi.org/jssi/papers/papers/view/625/Kavan_Identifying_risks_in_selected_social_facilities_when_emergencies_arise.pdf"
                        target="_blank">
                        <i class="fa-brands fa-mendeley fs-5"></i>
                    </a>
                </div>
                <div class="col-2">
                    <div class="plum-liberty-theme">
                        <div class="PlumX-Popup">
                            <div class="ppp-container ppp-medium">
                                <a target="_blank" class="plx-wrapping-print-link"
                                    href="https://plu.mx/plum/a/?doi=10.9770/jesi.2023.10.3(26)&amp;theme=plum-liberty-theme"
                                    title="PlumX Metrics Detail Page">
                                    <div>
                                        <svg viewBox="0 0 100 100" width="100%" height="100%"
                                            aria-labelledby="widget-plumprint-1">
                                            <title id="widget-plumprint-1">Plum Print visual indicator of research metrics
                                            </title>
                                            <path fill="#6e1a62" stroke="#6e1a62" stroke-width="1"
                                                d="M 36.075524746876404,57.96956599135724 C 47.24224000477168,47.68596460512846 53.05297314616313,51.90770935123954 46.72339182284403,65.70569425459581 L 53.27660817715597,65.70569425459581 C 46.94702685383687,51.90770935123954 52.75775999522832,47.68596460512846 63.924475253123596,57.96956599135724 L 65.94953047442182,51.73708687489691 C 50.87091882415881,53.493064614593585 48.651416263702714,46.662138123559565 61.88240715909315,39.21976840364822 L 56.58074376063895,35.36788447550181 C 53.59123058093537,50.25112330547885 46.40876941906463,50.25112330547885 43.419256239361054,35.3678844755018 L 38.11759284090686,39.2197684036482 C 51.348583736297286,46.662138123559565 49.12908117584119,53.493064614593585 34.05046952557818,51.73708687489691 Z">
                                            </path>
                                            <circle fill="#6e1a62" stroke="#6e1a62" stroke-width="1" r="4"
                                                cx="32.880982706687234" cy="55.56230589874905"></circle>
                                            <circle fill="#6e1a62" stroke="#6e1a62" stroke-width="1" r="4" cx="50"
                                                cy="68"></circle>
                                            <circle fill="#6e1a62" stroke="#6e1a62" stroke-width="1" r="4"
                                                cx="67.11901729331277" cy="55.56230589874905"></circle>
                                            <circle fill="#6e1a62" stroke="#6e1a62" stroke-width="1" r="4"
                                                cx="60.58013454126452" cy="35.43769410125095"></circle>
                                            <circle fill="#6e1a62" stroke="#6e1a62" stroke-width="1" r="4"
                                                cx="39.41986545873549" cy="35.43769410125094"></circle>
                                        </svg>
                                    </div>
                                </a>
                                <div class="ppp-pop ppp-pop-right" style="display: none;">
                                    <div class="ppp-branding">
                                        <img alt="plumX logo" class="plx-logo"
                                            src="//cdn.plu.mx/aa49358c1c9f6a8c537942b2f77a5c36/plumx-inverse-logo.png">
                                    </div>
                                    <ul>
                                        <div class="ppp-empty">No metrics available.</div>
                                    </ul>
                                    <a target="_blank"
                                        href="https://plu.mx/plum/a/?doi=10.9770/jesi.2023.10.3(26)&amp;theme=plum-liberty-theme"
                                        title="PlumX Metrics Detail Page">see details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-3 d-flex align-items-center gap-1 mb-2 mb-lg-0">
                    <a href="{{ route('jssiArticle', $article->id) }}" class="btn btn-primary btn-xs">HTML</a>
                    <a href="#" class="btn btn-primary btn-xs" target="_blank">PDF</a>
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
            <div class="row">
                <div class="col-md-12">
                    <b>Reference</b>
                    to this article should be made as follows:
                    <br>
                    Išoraitė, M.; Alperytė, I. 2023. Creativity in times of war and pandemics,
                    <i>Entrepreneurship and Sustainability Issues</i>
                    10(3): 399-419.
                    <a href="https://doi.org/{{ $article->doi }}" target="_blank">{{ $article->doi }}</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4" id="article-tab" data-bs-toggle="tab" data-bs-target="#article"
                type="button" role="tab" aria-controls="paper" aria-selected="true">
                Article
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="authors-tab" data-bs-toggle="tab" data-bs-target="#authors"
                type="button" role="tab" aria-controls="authors" aria-selected="false">
                Authors
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                type="button" role="tab" aria-controls="metrics" aria-selected="false">
                Review
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="issue-tab" data-bs-toggle="tab" data-bs-target="#issue" type="button"
                role="tab" aria-controls="issue" aria-selected="false">
                Issue
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="refs-tab" data-bs-toggle="tab" data-bs-target="#refs" type="button"
                role="tab" aria-controls="refs" aria-selected="false">
                Refs
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="cited-tab" data-bs-toggle="tab" data-bs-target="#cited" type="button"
                role="tab" aria-controls="cited" aria-selected="false">
                Cited
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="netrics-tab" data-bs-toggle="tab" data-bs-target="#metrics"
                type="button" role="tab" aria-controls="metrics" aria-selected="false">
                Metrics
            </button>
        </li>
    </ul>
    <div class="tab-content bg-white p-4" id="myTabContent">
        @include('jssi.articles.tabs.article_tab')
        @include('jssi.articles.tabs.authors_tab')
        @include('jssi.articles.tabs.review_tab')
        @include('jssi.articles.tabs.issue_tab')
        @include('jssi.articles.tabs.refs_tab')
        @include('jssi.articles.tabs.cited_tab')
        @include('jssi.articles.tabs.metrics_tab')
    </div>
@endsection
