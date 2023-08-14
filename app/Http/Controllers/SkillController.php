<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="Skills API",
 *    version="1.0.0",
 *    description="API endpoints for CRUD operations on skills"
 * )
 */
class SkillController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/skills",
     *     summary="Get a list of skills",
     *     tags={"Skills"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search query for filtering skills by title and slug using full-text search",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function index()
    {
        // Use the query parameter 'search' to filter skills by title and slug using full-text search
        $skills = Skill::query()
            ->when(request('search'), function ($query, $search) {
                $query->whereRaw('MATCH(title, slug) AGAINST(? IN BOOLEAN MODE)', [$search]);
            })
            ->get();

        // Return a collection of SkillResource instances
        return SkillResource::collection($skills);
    }

    /**
     * @OA\Get(
     *     path="/api/skills/{id}",
     *     summary="Get a single skill by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the skill",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Skill not found"),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function show(Skill $skill)
    {
        return new SkillResource($skill);
    }
    /**
     * @OA\Schema(
     *     schema="SkillResource",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="title", type="string"),
     *     @OA\Property(property="slug", type="string"),
     * )
     */

    /**
     * @OA\Post(
     *     path="/api/skills",
     *     summary="Create a new skill",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title", "slug"},
     *             @OA\Property(property="title", type="string", example="Skill Title"),
     *             @OA\Property(property="slug", type="string", example="skill-slug")
     *       )
     *     ),
     *     @OA\Response(response=201, description="Skill Created"),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->validated());
        return response()->json('Skill Created', 201);
    }


    /**
     * @OA\Put(
     *     path="/api/skills/{id}",
     *     summary="Update a skill by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the skill",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title", "slug"},
     *             @OA\Property(property="title", type="string", example="Skill Title"),
     *             @OA\Property(property="slug", type="string", example="skill-slug")
     *       )
     *     ),
     *     @OA\Response(response=200, description="Skill Updated"),
     *     @OA\Response(response=404, description="Skill not found"),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());
        return response()->json('Skill Updated');
    }


    /**
     * @OA\Delete(
     *     path="/api/skills/{id}",
     *     summary="Delete a skill by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the skill",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Skill Deleted"),
     *     @OA\Response(response=404, description="Skill not found"),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json('Skill Deleted');
    }


}
