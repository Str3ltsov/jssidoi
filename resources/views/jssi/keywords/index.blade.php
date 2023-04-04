@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Keywords</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    <a href="#" class="text-decoration-none">Keyword</a>
                </th>
                <th>
                    <a href="#" class="asc text-decoration-none">Papers</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 20; $i++)
                <tr>
                    <td>3D modelling</td>
                    <td>
                        <a href="{{ route('jssiKeyword', $i) }}" class="text-decoration-none">{{ rand(1, 66) }}</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page 1 of 116, showing 20 records out of 2319 total
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                            <li class="page-item"><a class="page-link" href="#">9</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
