@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Authors</h2>
        <fieldset class="search">
            First name begin at:&nbsp;&nbsp;
            <br>
            <div class="d-flex">
                @foreach (range('A', 'Z') as $letter)
                    <form action="{{ route('jssiAuthors') }}" method="GET">
                        <input type="hidden" name="filter[first_name like]" value="{{ $letter }}">
                        <button class="btn bg-transparent link-primary p-0 m-0
                            @if (isset($filter['first_name like']) && $filter['first_name like'] == $letter) fw-bold @endif" type="submit">
                            {{ $letter }}
                        </button>&nbsp;
                    </form>
                @endforeach
            </div>
            <br>Last name begin at:&nbsp;&nbsp;
            <br>
            <div class="d-flex">
                @foreach (range('A', 'Z') as $letter)
                    <form action="{{ route('jssiAuthors') }}" method="GET">
                        <input type="hidden" name="filter[last_name like]" value="{{ $letter }}">
                        <button class="btn bg-transparent link-primary p-0 m-0
                            @if (isset($filter['last_name like']) && $filter['last_name like'] == $letter) fw-bold @endif" type="submit">
                            {{ $letter }}
                        </button>&nbsp;
                    </form>
                @endforeach
            </div>
        </fieldset>
        <br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    <a href="javascript:void(0)" class="text-decoration-none" onclick="sortTableByAttribute('first_name')">First Name</a>
                </th>
                <th>
                    <a href="javascript:void(0)" class="asc text-decoration-none" onclick="sortTableByAttribute('last_name')">Last Name</a>
                </th>
                <th>Institutions</th>
                <th>
                    <a href="javascript:void(0)" class="text-decoration-none">Articles</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($authors as $author)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            <a href="http://orcid.org/{{ $author->orcid }}" class="rounded-5 bg-success text-decoration-none px-1 text-center text-white" target="_blank">
                                iD
                            </a>
                            {{ $author->first_name }}
                        </div>
                    </td>
                    <td>{{ $author->last_name ?? '' }}</td>
                    <td>
                        @forelse($author->authorsInstitutions as $authorsInstitution)
                            {{ $authorsInstitution->institution->title }}@if (!$loop->last),@endif
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('jssiAuthor', $author->id) }}" class="text-decoration-none">{{ $articleCounts[$author->id] }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted" colspan="4">No authors</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if (count($authors) > 0)
            <div class="row text-center mt-3">
                <div class="col-lg-12">
                    Page {{ $authors->currentPage() }} of {{ $authors->lastPage() }}, showing {{ count($authors) }} records out of {{ $authors->total() }} total
                    <div class="d-flex justify-content-center mt-4">
                        {{ $authors->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <form action="{{ route('jssiAuthors') }}" method="GET" id="mainForm" class="d-none">
        <input type="text" name="sort" value="" id="mainFormInput">
    </form>
@endsection
