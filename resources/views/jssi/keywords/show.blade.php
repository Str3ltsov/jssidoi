@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 border-1 shadow-sm mt-4 rounded-1">
        <h2 class="mb-3">Papers</h2>
        @for ($i = 1; $i <= rand(1, 10); $i++)
            <p>{{ $i }}.
                <a href="{{ route('jssiPaper', $i) }}" class="text-decoration-none">
                    <b>Štěpán Kavan</b>,
                    <b>Rastislav Kazanský</b>,
                    <b>Pavel Nečas</b>.
                    IDENTIFYING RISKS IN SELECTED SOCIAL FACILITIES WHEN EMERGENCIES ARISE
                </a>
            </p>
            <p>
                <b>Reference</b>
                to this paper should be made as follows:
                <br>
                Kavan, �.; Kazanský, R.; Nečas, P. 2020. Identifying risks in selected social facilities when emergencies arise,
                <i>Journal of Security and Sustainability Issues</i>
                10(2): 379-388.
                <a href="https://doi.org/10.9770/jssi.2020.10.2(1)" target="_blank" class="text-decoration-none">
                    https://doi.org/10.9770/jssi.2020.10.2(1)
                </a>
            </p>
            <div class="row">
                <div id="share-buttons" class="col-lg-6 d-flex align-items-center gap-2 mb-3 mb-lg-0">
                    Share:
                    <div class="d-flex align-items-center gap-1">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-square-facebook fs-5"></i>
                        </a>
                        <a href="https://plus.google.com/share?url=http%3A/jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-square-google-plus fs-5"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-linkedin fs-5"></i>
                        </a>
                        <a href="https://twitter.com/home?status=http%3A//jssidoi.org/jssi/papers/papers/view/625" target="_blank">
                            <i class="fa-brands fa-square-twitter fs-5"></i>
                        </a>
                        <a href="http://www.mendeley.com/import/?url=http://jssidoi.org/jssi/papers/papers/view/625/Kavan_Identifying_risks_in_selected_social_facilities_when_emergencies_arise.pdf" target="_blank">
                            <i class="fa-brands fa-mendeley fs-5"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-flex gap-4 gap-lg-0">
                    <div class="col-lg-6 d-flex align-items-center gap-1">
                        <a href="#" class="btn btn-primary">HTML</a>
                        <a href="#" class="btn btn-primary" target="_blank">PDF</a>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center gap-1">
                        <i class="fa fa-eye" title="Views"></i>
                        {{ rand(100, 1000) }}&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-download" title="Downloads"></i>
                        {{ rand(1, 200) }}
                    </div>
                </div>
            </div>
            <hr>
        @endfor
    </div>
@endsection
