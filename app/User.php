<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // collection to get a users with 'custom field' and sort by ID desc
    public function allUsersWithCustomField()
    {
        $users = User::all();
        $users = $users->map(function($user) {
            $user['custom_field'] = '1';
        });

        return $users->orderBy('id', 'DESC');
    }

    //Accessor
    public function getUserStatus($status)
    {
        return $status ? 'Active': 'InActive';
    }

    //Question 16
    public function getCountOfActiveUserOfAgeGreaterThan25()
    {
        return User::all()->where('status', '=', 1)->where('age', '>', 25)->count();
    }

    // Question 17
    public function limitedField()
    {
        return User::all(['id', 'name', 'username']);
    }

    // Question 18
    public function UsersAgeGreaterThan30AndIdLessThan10()
    {
        return User::where('id', '<', 10)->orWhere('age', '>', 30)->get();
    }

    // Question 19
    public function activeUserBetweenAge20and30AfterSkipping15Users()
    {
        return User::all()->where('status', '=', 1)->whereBetween('age', [10,20])->skip(15)->take(10);
    }

    // question 15
    public function storeFile($file)
    {
        Storage::disk('shubham')->put('',$file);
    }

    public function getFilesFromStorage()
    {
        return Storage::disk('shubham')->get('');
    }
}
