<?php

namespace App\Services;

use App\Models\JssiLink;
use Error;

class JssiLinkService extends HelperService
{
    public final function getJssiLinks(): object
    {
        return JssiLink::all();
    }

    public final function getJssiLinkById(int $id): object
    {
        $link = JssiLink::find($id);

        if (!$link) {
            throw new Error('Failed to find link by id');
        }

        return $link;
    }

    public final function getJssiLinksByMenuId(int $menuId): object
    {
        $links = JssiLink::where('menu_id', $menuId)->get();

        if (!$links) {
            throw new Error('Failed to find links by menu id');
        }

        return $links;
    }

    public final function createJssiLink(array $validated, int $queue): void
    {
        JssiLink::create([
            'parent_id' => null,
            'menu_id' => $validated['menu_id'],
            'title' => $validated['title'],
            'class' => implode('-', explode(' ', strtolower($validated['title']))),
            'link' => $validated['link'],
            'visible' => $validated['visible'],
            'queue' => $queue
        ]);
    }

    public final function updateJssiLinkQueue(int $newQueue, object $jssiLink): void
    {
        $jssiLink->queue = $newQueue;
        $jssiLink->save();
    }

    public final function updateJssiLink(array $validated, object $jssiLink): void
    {
        $jssiLink->menu_id = $validated['menu_id'];
        $jssiLink->title = $validated['title'];
        $jssiLink->class = implode('-', explode(' ', strtolower($validated['title'])));
        $jssiLink->link = $validated['link'];
        $jssiLink->visible = $validated['visible'];
        $jssiLink->save();
    }

    public final function updateJssiLinkQueueAboveOrBellow(int $newQueue, bool $directionUp): void
    {
        $jssiLink = JssiLink::where('queue', $newQueue)->first();
        $jssiLink->queue = $directionUp ? $newQueue + 1 : $newQueue - 1;
        $jssiLink->save();
    }

    public final function updateAllJssiLinkQueues(object $updateJssiLink, int $menuLinkCount): void
    {
        $jssiLinks = $this->getJssiLinksWithOffset($updateJssiLink, $menuLinkCount);

        if ($jssiLinks) {
            foreach ($jssiLinks as $jssiLink) {
                $jssiLink->queue -= 1;
                $jssiLink->save();
            }
        }
    }

    public final function getLatestJssiLinkQueueByMenuId(int $menuId, string $orderColumn = 'id'): int
    {
        return JssiLink::where('menu_id', $menuId)
            ->orderByDesc($orderColumn)
            ->first()
            ->queue;
    }

    private function getJssiLinksWithOffset(object $jssiLink, int $limit): object
    {
        return JssiLink::where('menu_id', $jssiLink->menu_id)
            ->orderBy('queue', 'asc')
            ->take($limit)
            ->skip($jssiLink->queue - 1)
            ->get();
    }
}
