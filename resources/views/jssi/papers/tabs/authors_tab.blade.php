<div class="tab-pane bg-transparent fade" id="authors" role="tabpanel" aria-labelledby="authors-tab">
    <h4>Authors</h4>
    <div class="authors-list">
        @for ($i = 1; $i <= rand(1, 3); $i++)
            <div>
                <div>
                    <div class="author-name">
                        <i class="fa fa-user-circle fs-5" aria-hidden="true"></i>
                        Tancho, Nartraphee
                    </div>
                    <div class="author-institutions">
                        <div>Rajamangala University of Technology Thanyaburi</div>
                    </div>
                    <div>Articles by this author in:
                        <a target="_blank" href="http://search.labs.crossref.org/?q=Tancho+Nartraphee" class="link-primary">
                            CrossRef
                        </a>&nbsp;|&nbsp;
                        <a target="_blank" href="https://scholar.google.com/scholar?q=Tancho+Nartraphee" class="link-primary">
                            Google Scholar
                        </a>
                    </div>
                </div>
            </div>
            <hr>
        @endfor
    </div>
</div>
