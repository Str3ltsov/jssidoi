<form method="post" action="{{ route('links.updateQueue', [$link->menu_id, $link->id]) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="queue" value="{{ $link->queue - 1 }}">
    <button type="submit" class="btn btn-primary px-2 py-1" @if ($link->queue == 1) disabled @endif>
        <i class="fa-solid fa-chevron-up"></i>
    </button>
</form>
<form method="post" action="{{ route('links.updateQueue', [$link->menu_id, $link->id]) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="queue" value="{{ $link->queue + 1 }}">
    <button type="submit" class="btn btn-primary px-2 py-1" @if ($link->queue == $latestQueue) disabled @endif>
        <i class="fa-solid fa-chevron-down"></i>
    </button>
</form>