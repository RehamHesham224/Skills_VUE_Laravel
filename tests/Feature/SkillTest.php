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
    use RefreshDatabase;
    private User $admin;
    private  $skill;
    private  $skills;
    private  $skillResource;
    private $skillResources;

    public function signIn($user= null){
        $user= $user ?: User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);

        return $user;
    }
    public function test_get_all_skills_resources(){
        $this->signIn();
        //arrange
        $skills= Skill::factory()->count(5)->create();
        $resource=SkillResource::collection($skills);
        $resourceResponse=$resource->response()->getData(true);
        //act
        $response = $this->getJson('/api/skills');
        $json=$response->json();
        //assert
        $response->assertStatus(200);
        $this->assertEquals($json,$resourceResponse);
    }
    public function test_show_skill_resource(): void
    {
        //arrange in setup method
        $skill= Skill::factory()->create();
        $resource=new SkillResource($skill);
        //act
        $this->signIn();
        $response = $this->getJson('/api/skills/'.$skill->id);
        //assert
        $response->assertStatus(200);
        $response->assertResource($resource);
    }
    public function test_skill_can_be_created(){
        $this->withoutExceptionHandling();
        //arrange in setup method
        $skill=[
            "title" => "Title created",
            'slug'=> "slug created",
        ];
        //act
        $this->signIn();
        $this->postJson('/api/skills', $skill);
        //assert
        $this->assertDatabaseHas('skills',$skill);
    }
    public function test_skill_can_be_updated(){
        $this->withoutExceptionHandling();
        //arrange in setup method
        $skill= Skill::factory()->create();
        $resource=new SkillResource($skill);
        //act
        $this->signIn();
        $this->patchJson('/api/skills/'.$skill->id, [
            "title" => "Changed",
            'slug'=>'Changed'
        ]);
        //assert
        $this->assertDatabaseHas('skills',[
            'title' => 'Changed',
            'slug'=>'Changed'
        ]);
    }
    public function test_skill_require_title(){
        //arrange in setup method
        $skill= Skill::factory()->raw(['title' => '']);
        $resource=new SkillResource($skill);
        //act
        $this->signIn();
        $response=$this->post('/api/skills');
        //assert
        $response
        ->assertStatus(302)
        ->assertSessionHasErrors('title');
    }


}
