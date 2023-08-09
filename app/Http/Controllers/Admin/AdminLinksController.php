<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJssiLinkRequest;
use App\Http\Requests\UpdateJssiLinkRequest;
use App\Services\JssiLinkService;
use App\Services\JssiMenuService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;
use Exception;

class AdminLinksController extends Controller
{
    public function __construct(public JssiLinkService $lService, public JssiMenuService $mService)
    {
    }

    public function create(int $menuId): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.links.create')
            ->with('menu', $this->mService->getJssiMenuById($menuId));
    }

    public function store(CreateJssiLinkRequest $request, int $menuId): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->lService->createJssiLink(
                $validated,
                $this->lService->getLatestJssiLinkQueueByMenuId($menuId) + 1
            );

            return redirect(route('menus.show', $menuId))
                ->with('success', __('Successfully created link'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }

    public function edit(int $menuId, int $linkId): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.links.edit')
            ->with([
                'menu' => $this->mService->getJssiMenuById($menuId),
                'link' => $this->lService->getJssiLinkById($linkId)
            ]);
    }

    public function update(UpdateJssiLinkRequest $request, int $menuId, int $linkId): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $jssiLink = $this->lService->getJssiLinkById($linkId);

            $this->lService->updateJssiLink($validated, $jssiLink);

            return redirect(route('menus.show', $menuId))
                ->with('success', __('Successfully updated link'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }

    public function updateQueue(Request $request, int $menuId, int $linkId): RedirectResponse
    {
        try {
            $newQueue = $request->queue;
            $jssiLink = $this->lService->getJssiLinkById($linkId);

            $this->lService->updateJssiLinkQueueAboveOrBellow($newQueue, $jssiLink->queue > $newQueue);
            $this->lService->updateJssiLinkQueue($newQueue, $jssiLink);

            return redirect(route('menus.show', $menuId))
                ->with('success', __('Successfully updated link queue'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }

    public function destroy(int $menuId, int $linkId): RedirectResponse
    {
        try {
            $jssiLink = $this->lService->getJssiLinkById($linkId);
            $jssiLink->delete();

            $this->lService->updateAllJssiLinkQueues(
                $jssiLink,
                count($this->lService->getJssiLinksByMenuId($menuId))
            );

            return redirect(route('menus.show', $menuId))
                ->with('success', __('Successfully deleted link'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }
}
