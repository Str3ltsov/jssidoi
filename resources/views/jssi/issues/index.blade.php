@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Issues</h2>
        <table class="table table-striped table-responsive">
            <tbody>
                @forelse($issues as $issue)
                    <tr>
                        <td>Vol. {{ $issue->volume }}&nbsp;</td>
                        <td>Num. {{ $issue->number }}&nbsp;</td>
                        <td>{{ $issue->date->format('F Y') }}&nbsp;</td>
                        <td>
                            <a href="{{ route('jssiIssue', $issue->id) }}" class="text-decoration-none">
                                Content ({{ rand(1, 50) }})
                            </a>
                        </td>
                        <td>
                            <a href="{{ asset("documents/issues/$issue->id/$issue->print") }}" target="_blank" class="text-decoration-none"
                               @if (!$issue->print) style="pointer-events: none; cursor: default; color: gray;" @endif>
                                Print version
                            </a>
                            <br>
                        </td>
                        <td>
                            <i class="fa fa-eye" title="Views"></i>
                            {{ $issue->views ?? '0' }}
                        </td>
                        <td>
                            <i class="fa fa-download" title="Downloads"></i>
                            {{ $issue->downloads ?? '0' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>{{ __('No issues') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page {{ $issues->currentPage() }} of {{ $issues->lastPage() }}, showing {{ $issues->perPage() }} records out of {{ $issues->total() }} total
                <div class="d-flex justify-content-center mt-4">
                    {{ $issues->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white px-4 pb-4 border-1 shadow-sm mt-4 rounded-1">
        <br>
        <a href="{{ asset('images/journal_img.png') }}" title="SCImago Journal &amp; Country Rank" target="_blank">
            <img border="0" src="https://www.scimagojr.com/journal_img.php?id=21100301405" alt="SCImago Journal &amp; Country Rank">
        </a>
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Year</th>
                    <th>Quartile</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Geography, Planning and Development</td>
                    <td>2018</td>
                    <td><span class="px-2 py-1 bg-warning text-white rounded-1">Q2</span></td>
                </tr>
                <tr>
                    <td>Renewable Energy, Sustainability and the Environment</td>
                    <td>2018</td>
                    <td><span  class="px-2 py-1 bg-danger text-white rounded-1 opacity-50">Q3</span></td>
                </tr>
                <tr>
                    <td>Safety Research</td>
                    <td>2018</td>
                    <td><span  class="px-2 py-1 bg-warning text-white rounded-1">Q2</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
