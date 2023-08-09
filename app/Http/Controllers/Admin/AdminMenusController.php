<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJssiMenuRequest;
use App\Http\Requests\UpdateJssiMenuRequest;
use App\Services\JssiLinkService;
use App\Services\JssiMenuService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;
use Illuminate\Http\RedirectResponse;
use Exception;

class AdminMenusController extends Controller
{
    public function __construct(public JssiMenuService $mService, public JssiLinkService $lService)
    {
    }

    public function index(): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.index')
            ->with('menus', $this->mService->paginateCollection($this->mService->getJssiMenus(), 10));
    }

    public function show(int $id): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.links.index')
            ->with([
                'menu' => $this->mService->getJssiMenuById($id),
                'links' => $this->mService->paginateCollection(
                    $this->lService->getJssiLinksByMenuId($id),
                    10,
                    'queue',
                    'asc'
                ),
                'latestQueue' => $this->lService->getLatestJssiLinkQueueByMenuId($id, 'queue')
            ]);
    }

    public function create(): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.create');
    }

    public function store(CreateJssiMenuRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->mService->createJssiMenu($validated);

            return redirect(route('menus.index'))
                ->with('success', __('Successfully created menu'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }

    public function edit(int $id): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.edit')
            ->with('menu', $this->mService->getJssiMenuById($id));
    }

    public function update(UpdateJssiMenuRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $jssiMenu = $this->mService->getJssiMenuById($id);
            $this->mService->updateJssiMenu($validated, $jssiMenu);

            return redirect(route('menus.index'))
                ->with('success', __('Successfully updated menu'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $jssiMenu = $this->mService->getJssiMenuById($id);
            $jssiMenu->delete();

            return redirect(route('menus.index'))
                ->with('success', __('Successfully deleted menu'));
        } catch (Exception $exc) {
            return back()->withErrors($exc->getMessage());
        }
    }
}
