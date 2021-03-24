<?php
namespace Entap\Admin\Application\Console\Commands;

use Entap\Admin\Database\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
  protected $signature = 'admin:users:create';
  protected $description = 'Create an administrator';

  public function handle()
  {
    $name = $this->ask('What is your name?');
    if (empty($name)) {
      $this->error('Name is required.');
      return 1;
    }

    $username = $this->ask('What is your login username?');
    if (empty($username)) {
      $this->error('Username is required.');
      return 2;
    }

    $password = $this->secret('What is your login password?');
    if (empty($password)) {
      $this->error('Password is required.');
      return 3;
    }

    User::create([
      'name' => $name,
      'username' => $username,
      'password' => Hash::make($password),
    ]);
  }
}
