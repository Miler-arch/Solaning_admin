<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create($request->all());
        return response()->json(['success' => 'Curso creado exitosamente.']);
    }

    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        toast('Curso actualizado exitosamente.','success')->autoClose(1500);
        return redirect()->route('courses.index', compact('course'));
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        toast('Curso eliminado exitosamente.','success')->autoClose(1500);
        return redirect()->route('courses.index');
    }
}
