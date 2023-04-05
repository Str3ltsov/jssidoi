<aside class="col-lg-3 col-md-6 col-12 order-lg-2 order-md-2 order-2">
    <div class="input-group mt-4">
        <div class="form-outline col-10">
            <input type="search" id="form1" class="form-control bg-white" placeholder="Search in papers"/>
        </div>
        <button type="button" class="btn btn-primary col-2">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="block-nav mt-4">
        <h3 class="pb-2">Browse</h3>
        <div>
            <ul class="list-unstyled fw-bold">
                <li class="right-aside-li @if (url()->current() === route('jssiIssues')) active @endif">
                    <a href="{{ route('jssiIssues') }}" class="text-decoration-none">
                        Issues
                    </a>
                </li>
                <li class="right-aside-li @if (url()->current() === route('jssiArticles')) active @endif">
                    <a href="{{ route('jssiArticles') }}" class="text-decoration-none">
                        Articles
                    </a>
                </li>
                <li class="right-aside-li @if (url()->current() === route('jssiAuthors')) active @endif">
                    <a href="{{ route('jssiAuthors') }}" class="text-decoration-none">
                        Authors
                    </a>
                </li>
                <li class="right-aside-li @if (url()->current() === route('jssiInstitutions')) active @endif">
                    <a href="{{ route('jssiInstitutions') }}" class="text-decoration-none">
                        Institutions
                    </a>
                </li>
                <li class="right-aside-li @if (url()->current() === route('jssiKeywords')) active @endif">
                    <a href="{{ route('jssiKeywords') }}" class="text-decoration-none">
                        Keywords
                    </a>
                </li>
                <li class="right-aside-li @if (url()->current() === route('jssiCountries')) active @endif">
                    <a href="{{ route('jssiCountries') }}" class="text-decoration-none">
                        Countries
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="block-nav mt-4">
        <span class="fs-5">RSS FEEDS</span>
        <div class="mt-1">
            <ul class="list-unstyled fw-bold">
                <li class="left-aside-li">
                    <a href="#" class="text-dark text-decoration-none">
                        <img src="{{ asset('images/Feed-icon.svg.png') }}" alt="Feed-icon" width="17" class="me-1">
                        RSS 1.0
                    </a>
                </li>
                <li class="left-aside-li">
                    <a href="#" class="text-dark text-decoration-none">
                        <img src="{{ asset('images/Feed-icon.svg.png') }}" alt="Feed-icon" width="17" class="me-1">
                        RSS 2.0
                    </a>
                </li>
                <li class="left-aside-li">
                    <a href="#" class="text-dark text-decoration-none">
                        <img src="{{ asset('images/Feed-icon.svg.png') }}" alt="Feed-icon" width="17" class="me-1">
                        Atom 1.0
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/download.png') }}" alt="qrcode" class="img-fluid">
    </div>
    <div id="cloud" style="width: 265px; height: 302px;" class="jqcloud mt-5">
        <span id="cloud_word_0" class="w10" style="position: absolute; left: 28.5px; top: 114px;">sustainable development</span>
        <span id="cloud_word_1" class="w7" style="position: absolute; left: 52.5532px; top: 86.1714px;">sustainability</span>
        <span id="cloud_word_2" class="w6" style="position: absolute; left: 66.9479px; top: 175.543px;">security</span>
        <span id="cloud_word_3" class="w4" style="position: absolute; left: 46.724px; top: 203.894px;">economic growth</span>
        <span id="cloud_word_4" class="w2" style="position: absolute; left: 63.8542px; top: 68.9629px;">national security</span>
        <span id="cloud_word_5" class="w2" style="position: absolute; left: 63.0969px; top: 53.4666px;">energy security</span>
        <span id="cloud_word_6" class="w2" style="position: absolute; left: 52.1642px; top: 225.341px;">economic security</span>
        <span id="cloud_word_7" class="w2" style="position: absolute; left: 88.1861px; top: 240.708px;">competitiveness</span>
        <span id="cloud_word_8" class="w2" style="position: absolute; left: 57.0197px; top: 30.7145px;">European Union (EU)</span>
        <span id="cloud_word_9" class="w2" style="position: absolute; left: 161.62px; top: 182.879px;">Asia</span>
        <span id="cloud_word_10" class="w1" style="position: absolute; left: 92.7823px; top: 255.66px;">Indonesia</span>
        <span id="cloud_word_11" class="w1" style="position: absolute; left: 65.7304px; top: 8.73014px;">management</span>
        <span id="cloud_word_13" class="w1" style="position: absolute; left: 34.162px; top: 247.133px;">ASEAN</span>
        <span id="cloud_word_14" class="w1" style="position: absolute; left: 22.1556px; top: 279.795px;">quality of education</span>
        <span id="cloud_word_16" class="w1" style="position: absolute; left: 203.724px; top: 176.633px;">terrorism</span>
        <span id="cloud_word_18" class="w1" style="position: absolute; left: 5.826px; top: 72.1198px;">Thailand</span>
        <span id="cloud_word_19" class="w1" style="position: absolute; left: 213.637px; top: 212.984px;">crime</span>
    </div>
</aside>

<style>
    .right-aside-li {
        background: none repeat scroll 0 0 #E9E8E2;
        border-bottom: 1px solid #D8D7D3;
        border-radius: 3px 3px 3px 3px;
        display: block;
        margin-bottom: 1px;
        position: relative;
        padding: 10px 25px
    }

    .right-aside-li:hover,
    .right-aside-li:focus {
        background: #fff;
    }

    .right-aside-li a {
        display: block;
        color: #222;
    }

    .active {
        background: none repeat scroll 0 0 #0d6efd;
    }

    .active:hover,
    .active:focus {
        background: none repeat scroll 0 0 #0d6efd;
    }

    .active a {
        color: #fff;
    }

    .jqcloud {
        overflow: hidden;
        position: relative;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        color: #09f;
        font-size: 12px;
    }

    .jqcloud span.w10 {
        color: #0cf;
        font-size: 300%;
        line-height: 30px;
    }

    .jqcloud span.w7 {
        color: #39d;
        font-size: 240%;
        line-height: 24px;
    }

    .jqcloud span.w6 {
        color: #90c5f0;
        font-size: 220%;
        line-height: 22px;
    }

    .jqcloud span.w4 {
        color: #90c5f0;
        font-size: 180%;
        line-height: 18px;
    }

    .jqcloud span.w2 {
        color: #99ccee;
        font-size: 140%;
        line-height: 14px;
    }

    .jqcloud span.w1 {
        color: #aab5f0;
        font-size: 120%;
        line-height: 14px;
    }

    .jqcloud span {
        padding: 0;
    }
</style>
