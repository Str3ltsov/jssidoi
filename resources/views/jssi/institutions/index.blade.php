@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Institutions</h2>
        <fieldset class="search">
            Institution begin at:&nbsp;
            <div class="d-flex">
                @foreach (range('A', 'Z') as $letter)
                    <form action="{{ route('jssiInstitutions') }}" method="GET">
                        <input type="hidden" name="filter[title like]" value="{{ $letter }}">
                        <button class="btn bg-transparent link-primary p-0 m-0
                            @if (isset($filter['title like']) && $filter['title like'] == $letter) fw-bold @endif" type="submit">
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
                <th></th>
                <th>
                    <a href="javascript:void(0)" class="text-decoration-none" onclick="sortTableByAttribute('title')">Title</a>
                </th>
                <th>
                    <a href="javascript:void(0)" class="asc text-decoration-none">Articles</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($institutions as $institution)
                <tr>
                    <td>
                        <img src="{{ asset("images/flags/".strtolower($institution->country->code).'.png') }}" alt="md" class="img-fluid" style="width: 20px; height: 15px">
                    </td>
                    <td>
                        <a href="{{ $institution->website }}" class="link-primary text-decoration-none">
                            {{ $institution->title }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('jssiInstitution', $institution->id) }}" class="text-decoration-none">
                            {{ $articleCounts[$institution->id] }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted" colspan="3">No institutions</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page {{ $institutions->currentPage() }} of {{ $institutions->lastPage() }}, showing {{ count($institutions) }} records out of {{ $institutions->total() }} total
                <div class="d-flex justify-content-center mt-4">
                    {{ $institutions->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('jssiInstitutions') }}" method="GET" id="mainForm" class="d-none">
        <input type="text" name="sort" value="" id="mainFormInput">
    </form>
@endsection
