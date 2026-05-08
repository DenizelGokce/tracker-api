<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_get_all_tasks()
    {
        Task::factory()->count(3)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function test_can_create_a_task()
    {
        $data = [
            'title' => 'Test taak'
        ];
        $response = $this->postJson('/api/tasks', $data);
        $response->assertStatus(201)
                ->assertJsonFragment([
                    'title' => 'Test taak'
                ]);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test taak'
        ]);
    }

}
