<?php

namespace App\Services;

use App\Models\JssiPage;

class JssiPageService extends HelperService
{
    final public function getPageList(): object
    {
        return JssiPage::all();
    }

    final public function getPaginatedPages($n)
    {
        return JssiPage::paginate($n);
    }
}
