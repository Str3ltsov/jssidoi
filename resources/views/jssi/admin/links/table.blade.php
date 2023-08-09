<table id="example2" class="table table-bordered table-hover" aria-describedby="example2_info">
    <thead>
        <tr>
            <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="{{ __('ID') }}">{{ __('ID') }}</th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="{{ __('Title') }}">{{ __('Title') }}</th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="{{ __('Visibility') }}">{{ __('Visibility') }}</th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="{{ __('Actions') }}">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($links as $link)
            <tr class="@if ($loop->index % 2) even @else odd @endif">
                <td class="text-center">{{ $link->id }}</td>
                <td>{{ $link->title }}</td>
                <td>
                    @if ($link->visible)
                        <button type="button" class="btn btn-outline-success px-2 py-1" disabled>
                            <i class="fa-solid fa-check text-success fw-bold fs-5"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-danger px-2 py-1" disabled>
                            <i class="fa-solid fa-xmark text-danger fw-bold fs-5"></i>
                        </button>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        @include('jssi.admin.links.forms.update_queue_forms')
                        <a href="{{ route('links.edit', [$link->menu_id, $link->id]) }}" class="btn btn-primary px-2 py-1" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        @include('jssi.admin.links.forms.destroy_form')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-muted colspan="6">{{ __('No links found') }}</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th rowspan="1" colspan="1" class="text-center">{{ __('ID') }}</th>
            <th rowspan="1" colspan="1">{{ __('Title') }}</th>
            <th rowspan="1" colspan="1">{{ __('Visibility') }}</th>
            <th rowspan="1" colspan="1">{{ __('Actions') }}</th>
        </tr>
    </tfoot>
</table>