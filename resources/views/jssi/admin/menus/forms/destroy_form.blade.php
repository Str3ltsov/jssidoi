<form method="post" action="{{ route('menus.destroy', $menu->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger px-2 py-1" 
        onclick="return confirm('{{ __('Are you sure you want to delete this menu?') }}')">
        <i class="far fa-trash-alt"></i>
    </button>
</form>