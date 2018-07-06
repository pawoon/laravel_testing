<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test users page.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('users');

        $response->assertStatus(200)
            ->assertViewHas('users');
    }

    /**
     * Test create users page.
     *
     * @return void
     */
    public function testCreatePage()
    {
        $response = $this->get('users/create');

        $response->assertStatus(200);
    }

    /**
     * Test create users success.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $userData = factory(\App\User::class)->make()->toArray();
        $userData['password'] = 'secret';

        $response = $this->post('users', $userData);

        $response->assertStatus(302)
            ->assertSessionHas('message_success', 'User created.');
        $this->assertDatabaseHas('users', [
            'email' => $userData['email']
        ]);
    }

    /**
     * Test create users failed with errors validation.
     *
     * @return void
     */
    public function testStoreValidationFailed()
    {
        $userData = factory(\App\User::class)->make()->toArray();
        unset($userData['name']);

        $response = $this->post('users', $userData);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['name' => 'The name field is required.']);
        $this->assertDatabaseMissing('users', ['email' => $userData['email']]);
    }

    /**
     * Test show detail users page by user id.
     *
     * @return void
     */
    public function testShowPageSuccess()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->get('users/' . $user->id);

        $response->assertStatus(200)
            ->assertViewHas('user');
    }
    
    /**
     * Test show detail user not found.
     *
     * @return void
     */
    public function testShowPageUserNotFound()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->get('users/' . 2);

        $response->assertStatus(404);
    }

    /**
     * Test edit user form by user id.
     *
     * @return void
     */
    public function testEditPage()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->get('users/' . $user->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('user');
    }
    
    /**
     * Test edit user form user not found.
     *
     * @return void
     */
    public function testEditPageUserNotFound()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->get('users/' . 2 . '/edit');

        $response->assertStatus(404);
    }

    /**
     * Test update user by user id.
     *
     * @return void
     */
    public function testUpdateSuccess()
    {
        $user = factory(\App\User::class)->create();

        $userData = $user->toArray();
        $userData['name'] = 'Banana';
        $userData['password'] = 'Success';

        $response = $this->put('users/' . $user->id, $userData);

        $response->assertStatus(302)
            ->assertSessionHas('message_success', 'User updated.');
        $this->assertDatabaseHas('users', [
            'name' => $userData['name']
        ]);
    }
    
    /**
     * Test failed update user with errors validation.
     *
     * @return void
     */
    public function testUpdateValidationFailed()
    {
        $user = factory(\App\User::class)->create();

        $userData = $user->toArray();
        unset($userData['name']);
        $userData['email'] = 'foo@bar.com';

        $response = $this->put('users/' . $user->id, $userData);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['name' => 'The name field is required.']);
    }

    /**
     * Test delete user success.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->delete('users/' . $user->id);

        $response->assertStatus(302)
            ->assertSessionHas('message_success', 'User deleted.');
        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);
    }
}
