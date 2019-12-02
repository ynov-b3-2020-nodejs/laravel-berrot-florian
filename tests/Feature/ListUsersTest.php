<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListUsersTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrlUsersResponseWell()
    {
        $res=$this->get('/users');
        $res->assertStatus(200);
    }
    public function  testEmptyWhenNoUsers()
    {
        $response = $this->getJson('/users');
        $response ->assertHeader('Content-Type','application/json');
        $response ->assertExactJson([
            'users'=>[]
        ]);
    }
    public function  testHasAUser()
    {
        //GIVEN
        /** @var Collection $users*/
        $users = factory(\App\User::class, 10)->create();
        //DO
        $response = $this->getJson('/users');
        //ASSERT
        $expectedUsers = $users->map->only(['name', 'email'])->toArray();
        $actualUsers = $response->json('users');

        $this->assertEquals($expectedUsers, $actualUsers);

    }
    public function testItDeleteAnUser(){
        //GIVEN

        $userToDelete = factory(\App\User::class)->create();
        $userToKeep = factory(\App\User::class)->create();
        //do
        $res = $this->deleteJson("/users/$userToDelete->id");

        //ASSERT

        // code et la reponse

        $res->assertStatus(204)
            ->assertNoContent();
        //Chopper les users et verifier que le notre n'y est pas


        $this->assertDatabaseMissing('users', ['id' =>$userToDelete->id]);
        $this->assertDatabaseHas('users', ['id' =>$userToKeep->id]);

    }
}
   /* public function testItCreateUser(){
        //GIVEN

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;

        //DO
        //Creation d'un user

        $res= $this->postJson('/users',[
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $this->assertEquals(1,\App\User::count());
        $this->assertDatabaseHas('users',['name' => $name,'email' => $email,]);

        $res->assertStatus(201);

        $user = User::first();
        $res->assertExactJson([
           'user'=>[
               'id'=>$user->id,
               'name'=>$name,
               'email'=>$email,

           ]
        ]);
    }s
}*/
