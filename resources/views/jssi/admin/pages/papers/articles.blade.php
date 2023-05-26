@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

    <x-admin.paginated_table :paginated="$articles">
        <x-slot:header_right>
            <a href='{{ route('jssi.admin.articles.create') }}' class="btn btn-success">Add new</a>
        </x-slot:header_right>
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
                                $articleAuthorInstitution->authorsInstitution->author->last_name,
                            ]) }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td> {{ $article->visible }}</td>
                    <td> {{ $article->views }}</td>
                    <td> {{ $article->downloads }}</td>
                    <td><a href="{{ route('jssi.admin.articles.edit', $article->id) }}" class="btn btn-outline-success"><i
                                class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $article->id }}
                            data-name="{{ $article->title }}" data-toggle="modal" data-target="#deleteArticle"><i
                                class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach

        </x-slot:tbody_content>
    </x-admin.paginated_table>

    <div class="modal fade" id="deleteArticle" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible!</h5>
                    <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete article <span id="modal-article_name"></span>?
                    <input type="hidden" id="category" name="issue_id">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('jssi.admin.articles.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                        <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).on('click', '.deleteBtn', function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            $('#id').val(id);
            $('#deleteArticle').modal('show');
            $('#modal-article_name').text(name);
            $('#deleteArticle').on('click', '.modalClose', () => {
                $('#deleteArticle').modal('hide');
            });
        });
    </script>
@endsection
