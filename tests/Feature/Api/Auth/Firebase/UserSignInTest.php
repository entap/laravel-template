<?php

namespace Tests\Feature\Api\Auth\Firebase;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use App\UseCases\UserVerifyFirebaseIdToken;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSignInTest extends TestCase
{
    public function test_アクセストークンを発行する()
    {
        $response = $this->signIn();

        $response->assertOk()->assertJsonStructure(['access_token']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $this->client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            '/'
        );
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $this->client->id,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);

        $this->mock(UserVerifyFirebaseIdToken::class, function ($mock) {
            $mock->allows(['verify' => 'PRESENT_UID']);
        });
    }

    private function signIn()
    {
        return $this->json('post', '/api/auth/firebase/token', [
            'id_token' => 'NOT_PRESENT_UID',
        ]);
    }
}
