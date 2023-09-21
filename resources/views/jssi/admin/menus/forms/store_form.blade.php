<form method="post" action="{{ route('menus.store') }}">
    @csrf
    @method('POST')
    <div class="card-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="alias">Alias</label>
            <input type="text" class="form-control @error('alias') is-invalid @enderror" name="alias">
            @error('alias')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Visibility</label>
            <div class="input-group col-12">
                <div class="form-group mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="1">
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="0" checked>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('menus.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>