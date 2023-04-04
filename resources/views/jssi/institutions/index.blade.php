@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Institutions</h2>
        <fieldset class="search">
            Institution begin at:&nbsp;
            <a href="#">A</a>&nbsp;
            <a href="#">B</a>&nbsp;
            <a href="#">C</a>&nbsp;
            <a href="#">D</a>&nbsp;
            <a href="#">E</a>&nbsp;
            <a href="#">F</a>&nbsp;
            <a href="#">G</a>&nbsp;
            <a href="#">H</a>&nbsp;
            <a href="#">I</a>&nbsp;
            <a href="#">J</a>&nbsp;
            <a href="#">K</a>&nbsp;
            <a href="#">L</a>&nbsp;
            <a href="#">M</a>&nbsp;
            <a href="#">N</a>&nbsp;
            <a href="#">O</a>&nbsp;
            <a href="#">P</a>&nbsp;
            <a href="#">Q</a>&nbsp;
            <a href="#">R</a>&nbsp;
            <a href="#">S</a>&nbsp;
            <a href="#">T</a>&nbsp;
            <a href="#">U</a>&nbsp;
            <a href="#">V</a>&nbsp;
            <a href="#">W</a>&nbsp;
            <a href="#">X</a>&nbsp;
            <a href="#">Y</a>&nbsp;
            <a href="#">Z</a>&nbsp;
        </fieldset>
        <br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>
                    <a href="#" class="text-decoration-none">Title</a>
                </th>
                <th>
                    <a href="#" class="asc text-decoration-none">Papers</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 25; $i++)
                <tr>
                    <td>
                        <img src="{{ asset('images/flags/md.png') }}" alt="md" class="img-fluid" style="width: 25px; height: 15px">
                    </td>
                    <td>Academy of Economic Studies of Moldova</td>
                    <td>
                        <a href="{{ route('jssiInstitution', $i) }}" class="text-decoration-none">{{ rand(1, 59) }}</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page 1 of 25, showing 25 records out of 485 total
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
