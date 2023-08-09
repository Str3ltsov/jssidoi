<form method="post" action="{{ route('links.update', [$menu->id, $link->id]) }}">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group">
            <label for="menu_id">Menu</label>
            <input type="text" class="form-control form-control @error('menu_id') is-invalid @enderror" 
                id="menu" name="menu" value="{{ $menu->title }}" readonly>
            <input type="hidden" id="menu_id" name="menu_id" value="{{ $menu->id }}">
            @error('menu_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $link->title }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <div class="input-group">
                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value={{ $link->link }}>
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-link"></i>
                    </button>
                </div>
                @error('link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Visibility</label>
            <div class="input-group col-12">
                <div class="form-group mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="1" @if ($link->visible) checked @endif>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="0" @if (!$link->visible) checked @endif>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-danger">Cancel</a>
    </div>
</form>