@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Issues</h2>
        <table class="table table-striped table-responsive">
            <tbody>
                @for ($i = 0; $i < 20; $i++)
                    <tr>
                        <td>Volume {{ $i + 1 }}&nbsp;</td>
                        <td>Number {{ strtoupper(Str::random(1)) }}&nbsp;</td>
                        <td>December 2020&nbsp;</td>
                        <td>
                            <a href="#">Content ({{ rand(1, 50) }})</a>
                        </td>
                        <td>
                            <a href="#" target="_blank">Print version</a>
                            <br>
                        </td>
                        <td>
                            <i class="fa fa-eye" title="Views"></i>
                            {{ rand(1, 1000) }}
                        </td>
                        <td>
                            <i class="fa fa-download" title="Downloads"></i>
                            {{ rand(1, 100) }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page 1 of 3, showing 20 records out of 41 total
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
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
