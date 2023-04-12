<div class="tab-pane bg-transparent fade" id="authors" role="tabpanel" aria-labelledby="authors-tab">
    <h4 class="mb-4">Authors</h4>
    <div class="d-flex flex-column gap-1">
        @forelse($authorsInstitutions as $authorInstitution)
            <div class="d-flex align-items-center gap-4">
                <div class="author-pic">
                    <i class="fa fa-user-circle fa-5x text-muted" aria-hidden="true"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <a href="http://orcid.org/{{ $authorInstitution->author->orcid }}" class="rounded-5 bg-success text-decoration-none px-1 text-center" target="_blank">
                            iD
                        </a>
                        {{ $authorInstitution->author->first_name }}
                        {{ $authorInstitution->author->last_name ? ','.$authorInstitution->author->last_name : '' }}
                    </div>
                    <div class="author-institutions">
                        <div>
                            <div class="fst-italic">
                                {{ $authorInstitution->institution->title }}
                                {{ $authorInstitution->institution->city }},
                                {{ $authorInstitution->institution->country->name }}
                            </div>
                            <a href="{{ $authorInstitution->institution->website }}" target="_blank" class="text-decoration-none link-primary">
                                {{ $authorInstitution->institution->website }}
                            </a>
                        </div>
                    </div>
                    <div>
                        Articles by this author in:
                        <a target="_blank"
                           href="http://search.labs.crossref.org/?q={{ $authorInstitution->author->first_name.'+'.$authorInstitution->author->last_name }}"
                           class="text-decoration-none link-primary">
                            CrossRef
                        </a>
                        &nbsp;|&nbsp;
                        <a target="_blank"
                           href="https://scholar.google.com/scholar?q={{ $authorInstitution->author->first_name.'+'.$authorInstitution->author->last_name }}"
                           class="text-decoration-none link-primary">
                            Google Scholar
                        </a>
                    </div>
                </div>
            </div>
            <hr>
        @empty
            <span class="text-muted">No authors</span>
        @endforelse
    </div>
</div>
