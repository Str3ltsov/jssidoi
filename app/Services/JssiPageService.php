<?php

namespace App\Services;

use App\Models\JssiPage;
use Illuminate\Support\Str;

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

    public function setPageFields($page, $request, $userId)
    {

        $slug = $request->input('slug');

        empty($slug) ? $slug = Str::slug($request->input('title')) : '';

        $page->slug = $slug;
        $page->author = $userId;
        $page->fill($request->only(['title', 'content']));

        $page->save();

        return $page;

    }
}
