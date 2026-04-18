<?php

use App\Models\Todo;
use App\Models\User;

test('user can create a todo', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('todos.store'), [
        'title' => 'Test Todo',
        'description' => 'This is a test todo',
    ]);

    $response->assertRedirect(route('todos.index'));
    $this->assertDatabaseHas('todos', [
        'user_id' => $user->id,
        'title' => 'Test Todo',
        'description' => 'This is a test todo',
        'completed' => false,
    ]);
});

test('user can view their todos', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('todos.index'));

    $response->assertStatus(200);
    $response->assertSee($todo->title);
});

test('user can update a todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->patch(route('todos.update', $todo), [
        'title' => 'Updated Title',
        'completed' => true,
    ]);

    $response->assertRedirect(route('todos.index'));
    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'title' => 'Updated Title',
        'completed' => true,
    ]);
});

test('user can delete a todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->delete(route('todos.destroy', $todo));

    $response->assertRedirect(route('todos.index'));
    $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
});

test('user cannot access other users todos', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $todo = Todo::factory()->create(['user_id' => $user1->id]);

    $response = $this->actingAs($user2)->get(route('todos.show', $todo));

    $response->assertStatus(404);
});