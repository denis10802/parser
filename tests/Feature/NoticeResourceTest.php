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
        $arrayToEntry = [
                "title" => 'Радий Хабиров параолимпийцам',
        ];
        Notice::factory()->create($arrayToEntry);
        $response = $this->getJson('/responses');
        $response->assertExactJson([$arrayToEntry]);
    }
}
