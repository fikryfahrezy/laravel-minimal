<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_responds_successfully(): void
    {
        $this->get('/health')->assertNoContent();
    }

    public function test_homepage_displays_people_from_the_database(): void
    {
        $person = Person::factory()->create();

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Minimal Laravel')
            ->assertSee('Saved people')
            ->assertSee($person->name)
            ->assertSee($person->email);
    }

    public function test_person_can_be_created_from_the_homepage_form(): void
    {
        $account = Account::factory()->create([
            'password' => 'password',
        ]);

        $this->post('/login', [
            'email' => $account->email,
            'password' => 'password',
        ])->assertRedirect('/');

        $response = $this->post('/people', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response
            ->assertRedirect('/');

        $this->assertDatabaseHas('people', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);
    }

    public function test_guest_is_redirected_when_creating_a_person(): void
    {
        $response = $this->post('/people', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_account_can_login_and_logout(): void
    {
        $account = Account::factory()->create([
            'password' => 'password',
        ]);

        $this->post('/login', [
            'email' => $account->email,
            'password' => 'password',
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs($account);

        $this->post('/logout')->assertRedirect('/');

        $this->assertGuest();
    }
}
