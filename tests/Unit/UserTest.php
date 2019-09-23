<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_register_user()
    {

        $data = factory(User::class)->make();

        $data = [
            'name' => $data['name'],
            'username' => $data['username'],
            'age' => $data['age'],
            'email' => $data['email'],
        ];

        $this->post('/api/users', $data)->assertSeeText('success')->assertOk();

        $user = User::latest()->first();

        $this->assertEquals($data['name'], $user['name']);

    }

    public function test_update_user()
    {

        $data = factory(User::class)->make();

        $data = [
            'name' => $data['name'],
            'username' => $data['username'],
            'age' => $data['age'],
            'email' => $data['email'],
        ];

        $user = User::create($data);
        $this->actingAs($user);

        $updatedData = [
            'name' => 'shivam'
        ];

        $this->put('api/users/'.$user->id, $updatedData)->assertSeeText('success')->assertOk();

        $updatedUser = User::find($user->id);

        $this->assertEquals($updatedUser->name, 'shivam');
    }



    public function test_delete_user()
    {
        $user = factory(User::class)->create();

        $this->delete('/api/users/'.$user->id)->assertStatus(200);

        //users in db should be zero

        $usersCount = User::all()->count();

        $this->assertEquals($usersCount, 0);
    }
}
