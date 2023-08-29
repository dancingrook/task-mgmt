<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function seedTask($category, $user)
    {
        factory(Task::class, 20)->create([
            'category_id' => $category->id,
            'created_by' => $category->user_id,
            'priority' => ['medium', 'high'][rand(0, 1)],
            'status' => ['backlog', 'doing', 'testing', 'done'][rand(0, 3)]
        ]);
    }

    public function run()
    {
        factory(User::class, 1)
            ->create()
            ->each(function ($user) {
                factory(Category::class)->create([
                    'user_id' => $user->id,
                    'name' => 'Software Development'
                ])->each(function ($category) use ($user) {
                    $this->seedTask($category, $user);
                });
            });

        factory(User::class, 1)
            ->create([
                'email' => 'user@specifi.com'
            ])
            ->each(function ($user) {
                factory(Category::class)->create([
                    'user_id' => $user->id,
                    'name' => 'Personal'
                ])->each(function ($category) use ($user) {
                    $this->seedTask($category, $user);
                });

                factory(Category::class)->create([
                    'user_id' => $user->id,
                    'name' => 'Work'
                ])->each(function ($category) use ($user) {
                    $this->seedTask($category, $user);
                });
            });

        \DB::table('category_user')->insert(['user_id' => 1, 'category_id' => 1, 'type' => 'owner']);
        \DB::table('category_user')->insert(['user_id' => 2, 'category_id' => 2, 'type' => 'owner']);
        \DB::table('category_user')->insert(['user_id' => 2, 'category_id' => 3, 'type' => 'owner']);

    }
}
