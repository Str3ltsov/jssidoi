<?php

namespace App\Services;

use App\Models\JssiReview;

class JssiReviewsService extends HelperService
{

    final public function getPaginatedReviews($n = 20)
    {
        return JssiReview::paginate($n);
    }

}
