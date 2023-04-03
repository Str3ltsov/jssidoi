@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Authors</h2>
        <fieldset class="search">
            First name begin at:&nbsp;&nbsp;
            <br>
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
            <br>Last name begin at:&nbsp;&nbsp;
            <br>
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
                <th>
                    <a href="/jssi/papers/authors/index/sort:first_name/direction:asc" class="text-decoration-none">First Name</a>
                </th>
                <th>
                    <a href="/jssi/papers/authors/index/sort:last_name/direction:desc" class="asc text-decoration-none">Last Name</a>
                </th>
                <th>Institutions</th>
                <th>
                    <a href="/jssi/papers/authors/index/sort:papers_count/direction:asc" class="text-decoration-none">Papers</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 20; $i++)
                <tr>
                    <td>Windijarto</td>
                    <td>Abrhám</td>
                    <td>Airlangga University</td>
                    <td>
                        <a href="#" class="text-decoration-none">{{ rand(1, 24) }}</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row text-center mt-3">
            <div class="col-lg-12">
                Page 1 of 69, showing 20 records out of 1377 total
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
