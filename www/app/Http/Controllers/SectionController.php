<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\collectionFormatter;

class Sectioncontroller extends Controller
{
    /**
     * validation rules
     * @var array
     */
    private $validationRules = [
        'name' => 'required|string|unique:sections'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::select(['id', 'name'])->get();
        $headers = collectionFormatter::headers($sections);
        $dataTable = collectionFormatter::data($sections);
        return Inertia::render('Sections/index', [
            'title' => 'القطاعات',
            'headers' => $headers,
            'dataTable' => $dataTable
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate($this->validationRules);
        $section = auth()->user()->section()->create($validateData);
        $section = $section->only(['id', 'name']);
        return response()->json(['message' => 'لقد تم انشاء قطاع جديد بنجاح', 'section' => $section], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return response()->json(['message' => 'تم ايجاد المستخدم المطلوب', 'section' => $section], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $this->validationRules['name'] = 'required|string|unique:sections,name';
        $validateData = $request->validate($this->validationRules);
        $validateData['user_id'] = auth()->user()->id;
        $section->update($validateData);
        $section = $section->only(['id', 'name']);
        return response()->json(['message' => 'تم تحديث بيانات المستخدم', 'section' => $section], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json([],204);
    }
}
