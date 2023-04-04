@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <div class="row">
            <div id="share-buttons" class="col d-flex align-items-center gap-2 mb-3 mb-lg-0">
                Share:
                <div class="d-flex align-items-center gap-1">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                        <i class="fa-brands fa-square-facebook fs-5"></i>
                    </a>
                    <a href="https://plus.google.com/share?url=http%3A/jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                        <i class="fa-brands fa-square-google-plus fs-5"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                        <i class="fa-brands fa-linkedin fs-5"></i>
                    </a>
                    <a href="https://twitter.com/home?status=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                        <i class="fa-brands fa-square-twitter fs-5"></i>
                    </a>
                    <a href="http://www.mendeley.com/import/?url=http://jssidoi.org/jssi/papers/papers/view/625/Kavan_Identifying_risks_in_selected_social_facilities_when_emergencies_arise.pdf" target="_blank">
                        <i class="fa-brands fa-mendeley fs-5"></i>
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-center gap-1">
                Open:&nbsp;
                <a href="{{ route('jssiPapers', $id) }}" class="btn btn-primary btn-xs">HTML</a>
                <a href="#" class="btn btn-primary btn-xs" target="_blank">PDF</a>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4" id="paper-tab" data-bs-toggle="tab" data-bs-target="#paper" type="button" role="tab" aria-controls="paper" aria-selected="true">
                Paper
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="authors-tab" data-bs-toggle="tab" data-bs-target="#authors" type="button" role="tab" aria-controls="authors" aria-selected="false">
                Authors
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="issue-tab" data-bs-toggle="tab" data-bs-target="#issue" type="button" role="tab" aria-controls="issue" aria-selected="false">
                Issue
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="cited-tab" data-bs-toggle="tab" data-bs-target="#cited" type="button" role="tab" aria-controls="cited" aria-selected="false">
                Cited
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="updates-tab" data-bs-toggle="tab" data-bs-target="#updates" type="button" role="tab" aria-controls="updates" aria-selected="false">
                Updates
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4" id="statistics-tab" data-bs-toggle="tab" data-bs-target="#statistics" type="button" role="tab" aria-controls="statistics" aria-selected="false">
                Statistics
            </button>
        </li>
    </ul>
    <div class="tab-content bg-white p-4" id="myTabContent">
        @include('jssi.papers.tabs.paper_tab')
        @include('jssi.papers.tabs.authors_tab')
        @include('jssi.papers.tabs.issue_tab')
        @include('jssi.papers.tabs.cited_tab')
        @include('jssi.papers.tabs.updates_tab')
        @include('jssi.papers.tabs.statistics_tab')
    </div>
@endsection
