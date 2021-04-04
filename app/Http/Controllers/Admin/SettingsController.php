<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => app('settings'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'welcome_message' => 'required|string|max:255',
        ]);
        app('settings')->update($request->all());
        return redirect()
            ->route('admin.settings.edit')
            ->with('success', __('Settings are updated.'));
    }
}
