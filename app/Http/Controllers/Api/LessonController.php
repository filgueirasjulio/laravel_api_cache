<?php

namespace App\Http\Controllers\Api;

use App\Services\LessonService;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Requests\StoreUpdateLessonRequest;


class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @return \Illuminate\Http\Response
     */
    public function index(string $course_uuid, string $module_uuid)
    {
        $lessons = $this->lessonService->getLessonsByModule($course_uuid, $module_uuid);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLessonRequest $request, string $course_uuid, string $module_uuid)
    {
        $module = $this->lessonService->createNewLesson($request->validated(), $course_uuid, $module_uuid);

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $course_uuid, string $module_uuid, string $lesson_uuid)
    {
        $module = $this->lessonService->getLessonByModule($course_uuid, $module_uuid, $lesson_uuid);

        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLessonRequest $request, string $course_uuid, string $module_uuid, string $lesson_uuid)
    {
        $this->lessonService->updateLesson($course_uuid, $module_uuid, $lesson_uuid, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy( string $course_uuid, string $module_uuid, string $lesson_uuid)
    {
        $this->lessonService->deleteLesson($course_uuid, $module_uuid, $lesson_uuid);

        return response()->json([], 204);
    }
}