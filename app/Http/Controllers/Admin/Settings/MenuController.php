<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Events\Admin\MenuUpdated;
use Illuminate\Http\Request;
use App\Models\Admin\MenuItem;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = MenuItem::withDepth()->get();

        return view('admin.menu.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentOptions = MenuItem::whereIsRoot()->get();

        return view('admin.menu.items.create', compact('parentOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'uri' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', Rule::exists('admin_menu_items', 'id')],
        ]);

        MenuItem::create($request->all());

        event(new MenuUpdated(request()->user()));

        return redirect()->route('admin.settings.menu.items.index');
    }

    /**
     * Show edit form.
     */
    public function edit(MenuItem $item)
    {
        $parentOptions = MenuItem::whereIsRoot()->get();

        return view('admin.menu.items.edit', compact('item', 'parentOptions'));
    }

    public function update(Request $request, MenuItem $item)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'uri' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', Rule::exists('admin_menu_items', 'id')],
        ]);

        $item->update($request->all());

        event(new MenuUpdated(request()->user()));

        return redirect()->route('admin.settings.menu.items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $item)
    {
        $item->delete();

        event(new MenuUpdated(request()->user()));

        return redirect()->route('admin.settings.menu.items.index');
    }
}
