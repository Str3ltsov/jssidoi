<?php

namespace App\Services;

use App\Models\JssiMenu;
use Error;

class JssiMenuService extends HelperService
{
    public final function getJssiMenus(): object
    {
        return JssiMenu::all();
    }

    public final function getJssiMenuById(int $id): object
    {
        $menu = JssiMenu::find($id);

        if (!$menu) {
            throw new Error('Failed to find menu by id');
        }

        return $menu;
    }

    public final function createJssiMenu(array $validated): void
    {
        JssiMenu::create([
            'title' => $validated['title'],
            'alias' => $validated['alias'],
            'class' => '',
            'visible' => $validated['visible'],
            'weight' => null,
            'link_count' => 0
        ]);
    }

    public final function updateJssiMenu(array $validated, object $jssiMenu): void
    {
        $jssiMenu->title = $validated['title'];
        $jssiMenu->alias = $validated['alias'];
        $jssiMenu->visible = $validated['visible'];
        $jssiMenu->save();
    }

    public function paginateCollection(
        object $collection,
        int $paginateNum,
        string $orderVar = 'id',
        string $orderDir = 'asc'
    ): object {
        return $collection->toQuery()->orderBy($orderVar, $orderDir)->paginate($paginateNum);
    }
}
