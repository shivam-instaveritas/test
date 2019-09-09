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
        $this->withoutExceptionHandling();
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


}
