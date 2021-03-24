<?php
namespace Entap\Admin\Application\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }

    public function __invoke()
    {
        return view('admin::home');
    }
}
