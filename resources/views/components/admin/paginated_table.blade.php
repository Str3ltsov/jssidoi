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
							{{ $thead_content }}
						</tr>
					</thead>
					<tbody>
						{{ $tbody_content }}
					</tbody>
				</table>
				<div class="card-footer clearfix">
					<ul class="pagination pagination-sm m-0 float-right">
					<div class="col-lg-12">
						Page {{ $paginated->currentPage() }} of {{ $paginated->lastPage() }}, showing {{ count($paginated) }} records out of {{ $paginated->total() }} total
						<div class="d-flex justify-content-center mt-4">
							{{ $paginated->onEachSide(1)->links('pagination::bootstrap-4') }}
						</div>
					</div>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
