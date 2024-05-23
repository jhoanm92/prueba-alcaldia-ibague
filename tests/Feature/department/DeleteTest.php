<?php

namespace Tests\Feature\department;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_fails_if_department_does_not_exist()
    {
        $user = User::factory(1)->create();
        $response = $this->actingAs($user->first())
            ->delete(route('delete-department'), ['id' => 1]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_it_deletes_department()
    {
        $user = User::factory(1)->create();

        $department = Department::factory(1)->create();

        $response = $this->actingAs($user->first())
            ->delete(route('delete-department'), ['id' => $department->first()->id]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('departments', ['id' => $department->first()->id]);
    }

    public function test_it_fails_if_user_is_not_authenticated()
    {
        $response = $this->delete(route('delete-department'), ['id' => 1]);

        $response->assertRedirect(route('login'));
    }
}
