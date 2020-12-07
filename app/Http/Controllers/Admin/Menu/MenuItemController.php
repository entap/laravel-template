<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = MenuItem::all();

        return view('admin.menu.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.items.create');
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
            'uri' => ['nullable', 'url'],
        ]);

        MenuItem::create($request->all());

        return redirect()->route('admin.menu.items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show edit form.
     */
    public function edit(MenuItem $item)
    {
        return view('admin.menu.items.edit', compact('item'));
    }

    public function update(Request $request, MenuItem $item)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $item->update($request->all());

        return redirect()->route('admin.menu.items.index');
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

        return redirect()->route('admin.menu.items.index');
    }
}
