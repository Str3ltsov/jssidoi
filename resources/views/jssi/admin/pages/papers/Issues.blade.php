@extends('layouts.admin')
@section('title', 'Issues')
@section('content')

<x-admin.paginated_table :paginated="$issues">
    <x-slot:thead_content>
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
    </x-slot:thead_content>
    <x-slot:tbody_content>
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
                <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </x-slot:tbody_content>
</x-admin.paginated_table>

@endsection
