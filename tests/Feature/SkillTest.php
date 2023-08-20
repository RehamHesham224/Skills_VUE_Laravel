<?php

namespace Tests\Feature;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SkillTest extends TestCase
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private User $admin;

    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->admin=$this->createAdmin();
    }
    public function test_get_all_skills(){
        //arrange
        //$skill= Skill::factory()->create();
        $skills=Skill::all();
        $resource=SkillResource::collection($skills);
        $resourceResponse=$resource->response()->getData(true);
        //act
        $response = $this->actingAs($this->admin)->getJson('/api/skills/');
        $json=$response->json();
        //assert
        $response->assertStatus(200);
        $this->assertEquals($json,$resourceResponse);
    }

    public function test_show_skill(): void
    {
        //arrange
        $skill=Skill::find(2);
        $resource=new SkillResource($skill);
        //act
        $response = $this->actingAs($this->admin)->getJson('/api/skills/'.$skill->id);
        //assert
        $response->assertStatus(200);
        $this->assertEquals($response,$response);
        $response->assertResource($resource);
    }
//    public function test_show_skill(): void
//    {
//        //arrange
////        $skill= Skill::factory()->create();
//        $skill=Skill::find(2);
//        $resource=new SkillResource($skill);
//        $resourceResponse=$resource->response()->getData(true);
//        //act
//        $response = $this->actingAs($this->admin)->getJson('/api/skills/'.$skill->id);
//        $json=$response->json();
//        //assert
//        $response->assertStatus(200);
//        $this->assertEquals($json,$resourceResponse);
//        $response->assertResource($resource);
//
//    }
    private function createAdmin(){
        return User::factory()->create(['is_admin' => 1]);
    }

}
