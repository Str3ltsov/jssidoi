@extends('layouts.admin')

@section('title', 'Issues')

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
                      <th>Vol.</th>
                      <th>No.</th>
                      <th>Date</th>
                      <th>Print</th>
                      <th>Online</th>
                      <th>Visible</th>
                      <th>Views</th>
                      <th>Downloads</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($issues as $issue)


                    <tr>
                      <td>{{ $issue->id}}</td>
                      <td>{{ $issue->volume }}</td>
                      <td>{{ $issue->number }}</td>
                      <td>{{ date('F Y', strtotime($issue->date)) }} </td>
                      <td>{{ $issue->print }}</td>
                      <td>{{ $issue->online }}</td>
                      <td>{{ $issue->visible }}</td>
                      <td>{{$issue->views}}</td>
                      <td>{{$issue->downloads}}</td>
                      <td>
              <button type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td>
                    </tr>

                     @endforeach
                  </tbody>

                </table>
                <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                   <div class="col-lg-12">
                Page {{ $issues->currentPage() }} of {{ $issues->lastPage() }}, showing {{ count($issues) }} records out of {{ $issues->total() }} total
                <div class="d-flex justify-content-center mt-4">
                    {{ $issues->onEachSide(1)->links('pagination::bootstrap-4') }}
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
