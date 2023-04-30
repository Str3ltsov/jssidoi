@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

<x-admin.paginated_table :paginated="$articles">
    <x-slot:thead_content>
        <th>Id</th>
        <th>Issue</th>
        <th>Title</th>
        <th style="width: 15%">Authors</th>
        <th>Visible</th>
        <th>Views</th>
        <th>Downloads</th>
        <th>Actions</th>
    </x-slot:thead_content>

    <x-slot:tbody_content>
        @foreach ($articles as $article)
        <tr>
            <td> {{ $article->id }}</td>
            <td> {{ $article->issue->volume . '.' . $article->issue->number }}</td>
            <td> {{ $article->title }}</td>
            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px; white-space:normal;">
               @foreach ($article->articlesAuthorsInstitutions as $articleAuthorInstitution)
                    {{ implode(' ', [
                        $articleAuthorInstitution->authorsInstitution->author->first_name,
                        $articleAuthorInstitution->authorsInstitution->author->middle_name,
                        $articleAuthorInstitution->authorsInstitution->author->last_name
                    ]) }}
                    @if (!$loop->last)
                    ,
                    @endif
                @endforeach
            </td>
            <td> {{ $article->visible }}</td>
            <td> {{ $article->views }}</td>
            <td> {{ $article->downloads }}</td>
            <td><button type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
				<button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
			</td>
        </tr>
        @endforeach

    </x-slot:tbody_content>
</x-admin.paginated_table>

@endsection
