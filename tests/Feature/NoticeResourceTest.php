<?php

namespace Tests\Feature;

use App\Models\Notice;
use Tests\TestCase;

class NoticeResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_json_response()
    {
        // Arrange
        $arrayToEntry= [
                ["title" => 'Радий Хабиров параолимпийцам']
        ];
        Notice::factory()->create($arrayToEntry[0]);

        // Act
        $response = $this->getJson('/api/title');
        $arrayEncode = $response->json();

        // Assert
        $response->assertExactJson($arrayToEntry);
        $this->assertSame($arrayToEntry, $arrayEncode);
    }
}
