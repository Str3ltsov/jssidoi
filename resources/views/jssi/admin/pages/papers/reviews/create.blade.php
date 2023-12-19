@extends('layouts.admin')
@section('title', 'Create new review')
@push('scripts')
    <script src="/ckeditor5/build/ckeditor.js"></script>
@endpush

@section('content')

    @php
        $reviewFields = [
            [
                'name' => 'evaluation',
                'title' => 'Overall Evaluation',
                'options' => ['Accept', 'Accept with minor improvements', 'Requires revision', 'Reject'],
            ],
            [
                'name' => 'originality',
                'title' => 'Originality Assessment',
                'options' => ['Very High', 'High', 'Average', 'Low', 'Very Low'],
            ],
            [
                'name' => 'methodology',
                'title' => 'Methodology Evaluation',
                'options' => ['Clear and Convincing', 'Weak', 'Insufficiently Detailed', 'Insufficiently Justified', 'Unsatisfactory'],
            ],
            [
                'name' => 'structure',
                'title' => 'Structure and Formattion',
                'options' => ['Excellent', 'Good', 'Average', 'Low', 'Very Low'],
            ],
            [
                'name' => 'language',
                'title' => 'Language and Writing Style',
                'options' => ['Excellent', 'Good', 'Average', 'Low', 'Very Low'],
            ],
            [
                'name' => 'advice',
                'title' => 'Advice for Enhancement',
                'options' => ['Refinement of wording', 'Additional research', 'Use of additional sources', 'Expansion of the discussion of results'],
            ],
        ];
    @endphp
    <div class="card card-primary">
        <!-- form start -->
        <form method="post" action="{{ route('jssi.admin.reviews.store') }}">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Article ID</label>
                    <input type="text" class="form-control" id="article_id" name="article_id" placeholder="1" value=""
                        required>
                </div>

                @foreach ($reviewFields as $field)
                    <div class="form-group">
                        <label for="{{ $field['name'] }}">{{ $field['title'] }}</label><br>
                        @foreach ($field['options'] as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $field['name'] }}"
                                    value="{{ $option }}" id="{{ $field['name'] . str_replace(' ', '_', $option) }}"
                                    required>
                                <label class="form-check-label" for="{{ $field['name'] . str_replace(' ', '_', $option) }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                @endforeach
                <div class="form-group">
                    <label for="content">Overall comment</label>
                    <textarea class="form-control" name="generalComment" rows='5' id='content-textarea'></textarea>
                </div>
            </div>


    </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jssi.admin.reviews.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#content-textarea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
