<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;

class CursoController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $price = $request->price;
        $discount = $request->discount;
        $expire_date = $request->expire_date;
        $data = date('d-m-Y', strtotime($expire_date));
        $finalPrice = $price - ($price * ($discount / 100));
        $nameCode = strtoupper(substr($request->name, 0, 3));
        $latestCourse = Course::where('version', 'LIKE', $nameCode . '-%')->latest('version')->first();

        $version = ($latestCourse) ? intval(substr($latestCourse->version, 4)) + 1 : 1;
        Course::create([
            'name' => $request->name,
            'version' => $nameCode . '-' . $version, // Almacenar el código en el campo version
            'category' => $request->category,
            'price' => $finalPrice,
            'discount' => $request->discount,
            'expire_date' => $data,
        ]);

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
        toastr()->success('Curso actualizado exitosamente!');
        return redirect()->route('courses.index', compact('course'));
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        if ($course->registrations->count() > 0) {
            toastr()->error('No se puede eliminar el curso porque tiene registros asignados!');
            return redirect()->route('clients.index');
        }
        $course->delete();
        toastr()->success('Curso eliminado exitosamente!');
        return redirect()->route('courses.index');
    }
}
