@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Keywords </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <a href="#" class="text-decoration-none">Keyword</a>
                    </th>
                    <th>
                        <a href="#" class="asc text-decoration-none">Articles</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keywords as $keyword)
                    <tr>
                        <td>{{ $keyword->keyword }}</td>
                        <td><a href="{{ route('jssiKeyword', $keyword->id) }}" class="text-decoration-none">
                                {{ $articleCounts[$keyword->id] }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (count($keywords) > 0)
            <div class="row text-center mt-3">
                <div class="col-lg-12">
                    Page {{ $keywords->currentPage() }} of {{ $keywords->lastPage() }}, showing {{ count($keywords) }}
                    records
                    out of {{ $keywords->total() }} total
                    <div class="d-flex justify-content-center mt-4">
                        {{ $keywords->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
