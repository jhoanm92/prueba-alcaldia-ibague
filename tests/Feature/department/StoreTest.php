<?php

namespace Tests\Feature\department;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_fails_if_user_is_not_authenticated()
    {
        $response = $this->post(route('store-department'), []);

        $response->assertRedirect(route('login'));
    }

    public function test_it_fails_if_name_is_not_provided()
    {
        $user = User::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->post(route('store-department'), ['status' => 1]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('departments', 0);
    }

    public function test_it_fails_if_status_is_not_provided()
    {
        $user = User::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->post(route('store-department'), ['name' => $this->faker->name]);

        $response->assertSessionHasErrors('status');
        $this->assertDatabaseCount('departments', 0);
    }

    public function test_it_fails_if_status_is_not_valid()
    {
        $user = User::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->post(route('store-department'), ['name' => $this->faker->name, 'status' => 3]);

        $response->assertSessionHasErrors('status');
        $this->assertDatabaseCount('departments', 0);
    }

    public function test_it_stores_department()
    {
        $user = User::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->post(route('store-department'), ['name' => $this->faker->name, 'status' => 1]);

        $response->assertRedirect(route('departments'));
        $response->assertSessionHas('success');
        $this->assertDatabaseCount('departments', 1);
    }
}
