<?php
namespace Entap\Admin\Application\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs;

  // public function __construct()
  // {
  //   $this->setUp();

  //   $this->registerMiddleware();
  // }

  // protected function setUp(): void
  // {
  // }

  // protected function registerMiddleware()
  // {
  //   $this->middleware(['admin']);
  // }
}
