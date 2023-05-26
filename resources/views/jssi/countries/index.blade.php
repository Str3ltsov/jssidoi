@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Countries</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>
                    <a href="javascript:void(0)" class="text-decoration-none" onclick="sortTableByAttribute('name')">Countries</a>
                </th>
                <th>
                    <a href="javascript:void(0)" class="asc text-decoration-none">Articles</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($countries as $country)
                <tr>
                    <td>
                        <img src="{{ asset("images/flags/".strtolower($country->code).'.png') }}" alt="md" class="img-fluid" style="width: 20px; height: 15px">
                    </td>
                    <td>{{ $country->name }}</td>
                    <td>
                        <a href="{{ route('jssiCountry', $country->id) }}" class="text-decoration-none">{{ rand(1, 194) }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted" colspan="3">No countries</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if (count($countries) > 0)
            <div class="row text-center mt-3">
                <div class="col-lg-12">
                    Page {{ $countries->currentPage() }} of {{ $countries->lastPage() }}, showing {{ count($countries) }} records out of {{ $countries->total() }} total
                    <div class="d-flex justify-content-center mt-4">
                        {{ $countries->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <form action="{{ route('jssiCountries') }}" method="GET" id="mainForm" class="d-none">
        <input type="text" name="sort" value="" id="mainFormInput">
    </form>
@endsection
