<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use RefreshDatabase;

    public function test_signup_creates_an_account_and_logs_the_user_in(): void
    {
        $response = $this->post('/signup', [
            'name' => 'Liza Ramos',
            'email' => 'liza@example.com',
            'password' => 'correct-horse-battery',
            'password_confirmation' => 'correct-horse-battery',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertAuthenticated();

        $user = User::where('email', 'liza@example.com')->firstOrFail();
        $this->assertSame('Liza Ramos', $user->name);
    }

    public function test_signup_rejects_missing_fields(): void
    {
        $this->post('/signup', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ])->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertGuest();
    }
}
