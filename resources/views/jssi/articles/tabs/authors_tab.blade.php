<div class="tab-pane bg-transparent fade" id="authors" role="tabpanel" aria-labelledby="authors-tab">
    <h4 class="mb-4">Authors</h4>
    <div class="d-flex flex-column gap-1">
        @for ($i = 1; $i <= 2; $i++)
            <div class="d-flex align-items-center gap-4">
                <div class="author-pic">
                    <i class="fa fa-user-circle fa-5x text-muted" aria-hidden="true"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <a href="http://orcid.org/0000-0001-9108-0525" class="rounded-5 bg-success text-decoration-none px-1 text-center" target="_blank">
                            iD
                        </a>
                        Išoraitė, Margarita
                    </div>
                    <div class="author-institutions">
                        <div>
                            Vilnius University of Applied Sciences, Vilnius, Lithuania&nbsp;
                            <a href="https://www.viko.lt" target="_blank" class="text-decoration-none link-primary">https://www.viko.lt</a>
                        </div>
                    </div>
                    <div>
                        Articles by this author in:
                        <a target="_blank" href="http://search.labs.crossref.org/?q=Išoraitė+Margarita" class="text-decoration-none link-primary">
                            CrossRef
                        </a>
                        &nbsp;|&nbsp;
                        <a target="_blank" href="https://scholar.google.com/scholar?q=Išoraitė+Margarita" class="text-decoration-none link-primary">
                            Google Scholar
                        </a>
                    </div>
                </div>
            </div>
            <hr>
        @endfor
    </div>
</div>
