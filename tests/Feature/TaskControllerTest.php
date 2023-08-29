<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTasksApi()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user, 'sanctum')
            ->get('/api/tasks');
        $response->assertStatus(200);
    }


    /**
     * @return void
     */
    public function testShouldThrowErrorIfUnauthenticated()
    {
        $response = $this
            ->get('/api/tasks');
        $response->assertStatus(401);
    }

    public function testShouldReturn422ForInsufficientInput()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user, 'sanctum')
            ->post('/api/task', [
                'description' => $this->faker->sentence(4),
                'status' => 'backlog'
            ]);
        $response->assertStatus(422);

    }

    public function testShouldCreateTask()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id' => $user->id]);
        \DB::table('category_user')->insert(['user_id' => $user->id, 'category_id' => $category->id, 'type' => 'owner']);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->post('/api/task', [
                'category_id' => $category->id,
                'title' => $this->faker->text(10),
                'description' => $this->faker->sentence(4),
                'status' => 'backlog'
            ]);
        $response->assertStatus(201);
    }

    public function testShouldReturn404ForUserNotAssociatedWithCategory()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->post('/api/task', [
                'category_id' => $category->id,
                'title' => $this->faker->text(10),
                'description' => $this->faker->sentence(4),
                'status' => 'backlog'
            ]);
        $response->assertStatus(404);
    }
}
