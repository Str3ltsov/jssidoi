@extends('layouts.admin')
@section('title', 'Authors')
@section('content')
<x-admin.paginated_table :paginated="$authors">
	<x-slot:thead_content>
		<th>ID</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>ORCID</th>
		<th>Actions</th>
	</x-slot:thead_content>
	<x-slot:tbody_content>
		@foreach ($authors as $author)
		<tr>
			<td>{{ $author->id}}</td>
			<td>{{ $author->first_name }}</td>
			<td>{{ $author->middle_name }}</td>
			<td>{{ $author->last_name }} </td>
			<td>{{ $author->email }}</td>
			<td>{{ $author->orcid }}</td>
			<td><button type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
				<button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
			</td>
		</tr>
		@endforeach
	</x-slot:tbody_content>
</x-admin.paginated_table>
@endsection
