<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User; 
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    /**
     * Data provider for creating projects.
     *
     * @return array
     */
    public static function createProjectDataProvider(): array
    {
        return [
            'valid data' => [
                [
                    'name' => 'Project Name',
                    'description' => 'Project Description',
                ],
                200,
                ['success' => true]
            ],
            'missing name' => [
                [
                    'description' => 'Project Description',
                ],
                422,
                [
                    'message' => 'The name field is required.',
                    'errors' => [
                        'name' => ['The name field is required.']
                    ]
                ]
            ],
            'invalid description' => [
                [
                    'name' => 'Project Name',
                    'description' => str_repeat('a', 256),
                ],
                422,
                [
                    'message' => 'The description field must not be greater than 255 characters.',
                    'errors' => [
                        'description' => ['The description field must not be greater than 255 characters.']
                    ]
                ]
            ]
        ];
    }

    /**
     * Test creating a project with various data sets.
     *
     * @DataProvider createProjectDataProvider
     */
    #[DataProvider('createProjectDataProvider')]
    public function testCreateProject(array $data, int $expectedStatus, array $expectedJson)
    {
        User::truncate();

        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/projects/add', $data);

        if ($expectedStatus === 200) {
            $this->assertDatabaseHas('projects', [
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }

        $response->assertStatus($expectedStatus);
        $response->assertJson($expectedJson);
    }

}
