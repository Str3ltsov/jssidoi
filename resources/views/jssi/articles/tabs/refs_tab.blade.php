<div class="tab-pane bg-transparent fade" id="refs" role="tabpanel" aria-labelledby="refs-tab">
    <h4>References</h4>
    <hr>

    @foreach ($references as $reference)
        <p>
            {{ $reference->reference }}
            <br>
            <a href="{{ $reference->link }}" class="text-decoration-none link-primary">{{ $reference->link }}</a>
        </p>
        <a href="https://refindit.org/?search=simple&text={{ $reference->reference }}"
            class="text-decoration-none link-primary">Search via ReFindit</a>
        @if (!$loop->last)
            <hr>
        @endif
    @endforeach
</div>
