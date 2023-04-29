@extends('layouts.admin')

@section('title', 'Authors')

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>ORCID</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($authors as $author)


                    <tr>
                      <td>{{ $author->id}}</td>
                      <td>{{ $author->first_name }}</td>
                      <td>{{ $author->middle_name }}</td>
                      <td>{{ $author->last_name }} </td>
                      <td>{{ $author->email }}</td>
                      <td>{{ $author->orcid }}</td>
                      <td><button type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-outline-danger btn-block"><i class="fa fa-x"></i></button></td>
                    </tr>

                     @endforeach
                  </tbody>

                </table>
                <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                   <div class="col-lg-12">
                Page {{ $authors->currentPage() }} of {{ $authors->lastPage() }}, showing {{ count($authors) }} records out of {{ $authors->total() }} total
                <div class="d-flex justify-content-center mt-4">
                    {{ $authors->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
              </div>

              {{-- {{ $authors->links()}} --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        {{-- @foreach ($authors as $author)
            <p>{{ $author }}</p>
        @endforeach --}}

@endsection
