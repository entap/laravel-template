<?php

namespace Tests\Feature\Auth\Line;

use App\Events\Auth\Line\Login;
use Tests\TestCase;
use App\Models\User;
use App\Services\Auth\Line\VerifiedToken;
use App\Services\Auth\Line\VerifyService;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Events\AccessTokenCreated;
use Tests\Support\WithPassport;

class UserLoginTest extends TestCase
{
    use WithPassport;

    public function test_アクセストークンを発行する()
    {
        $this->mock(VerifyService::class, function ($mock) {
            $mock->shouldReceive('verify')->andReturn(new VerifiedToken('1'));
        });

        $response = $this->postJson('/api/auth/line/token', [
            'access_token' => 'xxx',
        ]);
        $response->assertOk();
        $response->assertJsonStructure(['access_token']);

        // ユーザーがいなければ登録する
        $user = User::withProvider('line', '1');
        $this->assertNotNull($user);

        Event::assertDispatched(AccessTokenCreated::class);
        Event::assertDispatched(Login::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
        $this->createPersonalAccessClient();
    }
}
