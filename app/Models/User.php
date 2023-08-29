<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use withFaker;
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function createUser($name, $email, $password): User
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        /**
         * default workspace/category
         */
        $category = factory(Category::class)->create([
            'user_id' => $user->id,
            'name' => "Work",
        ]);
        $user->categories()->sync([$category->id], false);
        return $user;
    }

    public function getUserByEmail($email): User
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }


}
