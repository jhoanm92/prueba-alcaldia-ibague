<?php

namespace Tests\Feature\department;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_fails_if_user_is_not_authenticated()
    {
        $response = $this->put(route('update-department', ['id' => 1 ]), []);

        $response->assertRedirect(route('login'));
    }

    public function test_it_fails_if_name_is_not_provided()
    {
        $user = User::factory(1)->create();

        $department = Department::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->put(route('update-department', ['id' => $department->first()->id]), ['status' => 1]);

        $response->assertSessionHasErrors('name');
    }

    public function test_it_fails_if_status_is_not_provided()
    {
        $user = User::factory(1)->create();

        $department = Department::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->put(route('update-department', ['id' => $department->first()->id]), ['name' => $this->faker->name]);

        $response->assertSessionHasErrors('status');
    }

    public function test_it_fails_if_status_is_not_valid()
    {
        $user = User::factory(1)->create();

        $department = Department::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->put(route('update-department', ['id' => $department->first()->id]), ['name' => $this->faker->name, 'status' => 3]);

        $response->assertSessionHasErrors('status');
    }

    public function test_it_updates_department()
    {
        $user = User::factory(1)->create();

        $department = Department::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->put(route('update-department', ['id' => $department->first()->id]), ['name' => $this->faker->name, 'status' => 1]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_it_fails_if_department_does_not_exist()
    {
        $user = User::factory(1)->create();
        $response = $this->actingAs($user->first())
            ->put(route('update-department', ['id' => 1]), ['name' => $this->faker->name, 'status' => 1]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }
}
