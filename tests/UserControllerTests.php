<?php


namespace Tests;


use App\Models\User;
use Illuminate\Http\Response;

class UserControllerTests extends TestCase
{

    public function testUserIsShownCorrectly()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'comments' => $this->faker->text
        ]);

        $this->json('get', 'user/' . $user->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('view');
    }

    public function testShowMissingUser()
    {
        $this->json('get', 'user/0')
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertSeeText('No such user (0)');
    }

    public function testUserUpdateComments()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'comments' => $this->faker->text,
        ]);

        $payload = [
            'id' => $user->id,
            'comments' => $this->faker->text,
            'password' => config('settings.user_password')
        ];

        $this->json('post', 'user/update-comments', $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertSeeText('OK');
    }

    public function testUserUpdateCommentWithMissingData()
    {
        $payload = [
            // id is missing
            'comments' => $this->faker->text,
            'password' => config('settings.user_password')
        ];
        $this->json('post', 'user/update-comments', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUserUpdateCommentWithIncorrectPassword()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'comments' => $this->faker->text,
        ]);
        $payload = [
            'id' => $user->id,
            'comments' => $this->faker->text,
            'password' => 'password'
        ];

        $this->json('post', 'user/update-comments', $payload)
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertSeeText('Invalid password');
    }
}
