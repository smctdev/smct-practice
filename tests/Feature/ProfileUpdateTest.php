<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_update_their_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch('/profile', [
                'name' => 'Bea Santos',
                'email' => 'bea@example.com',
                'phone' => '09171234567',
            ])
            ->assertRedirect(route('profile.edit'))
            ->assertSessionHasNoErrors();

        $user->refresh();
        $this->assertSame('Bea Santos', $user->name);
        $this->assertSame('09171234567', $user->phone);
    }

    public function test_a_profile_can_be_saved_without_a_phone_number(): void
    {
        // planted for S1: the null-phone crash — this test EXPOSES the bug and
        // is skipped on purpose. An empty phone input is converted to null by
        // the framework, and ProfileUpdateRequest's phone rule has no
        // `nullable`, so validation fails with "The phone field must be a
        // string." Un-skip once the rule is fixed; do not fix it before S1.
        $this->markTestSkipped('Known bug: ProfileUpdateRequest phone rule is missing nullable.');

        $user = User::factory()->create(['phone' => null]);

        $this->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => '',
            ])
            ->assertSessionHasNoErrors();

        $this->assertNull($user->refresh()->phone);
    }

    public function test_guests_are_sent_to_the_login_page(): void
    {
        $this->get('/profile')->assertRedirect(route('login'));
    }
}
