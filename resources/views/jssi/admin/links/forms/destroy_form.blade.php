<form method="post" action="{{ route('links.destroy', [$link->menu_id, $link->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger px-2 py-1" 
        onclick="return confirm('{{ __('Are you sure you want to delete this link?') }}')">
        <i class="far fa-trash-alt"></i>
    </button>
</form>