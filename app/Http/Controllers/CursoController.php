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
        $codigoCursos = [
            'INSTALACIONES ELÉCTRICAS DOMICILIARIAS' => 'ED',
            'INSTALACIONES DOMÓTICAS' => 'DOM',
            'ARMADO DE TABLEROS DE FUERZA' => 'ATF',
            'ELECTROTECNIA INDUSTRIAL' => 'ETC',
            'REBOBINADO DE MOTORES ELÉCTRICOS INDUSTRIALES' => 'RM',
            'INSTALACIÓN DE PANELES SOLARES' => 'PS',
            'INSTALACIÓN DE CÁMARAS DE SEGURIDAD' => 'CS',
            'INSTALACIÓN DE CERCOS ELÉCTRICOS Y ALARMAS DE SEGURIDAD' => 'CEA',
            'PLOMERIA DOMICILIARIA' => 'PL',
            'ELECTRÓNICA BÁSICA Y PLACAS PCB' => 'EB',
            'DISEÑO ELECTRÓNICO Y PROGRAMACIÓN DE MICROCONTROLADORES' => 'PE',
            'SOLDADURA POR ARCO ELÉCTRICO' => 'SMAW',
            'SOLDADURA GMAW Y AXIACETILÉNICA' => 'GMAW',
            'SISTEMAS DE PUESTA A TIERRA Y PARARRAYOS' => 'SPAT',
            'ACOMETIDAS EN MEDIA TENSIÓN Y SUBESTACIONES DE TRANSFORMACIÓN' => 'ACMT',
            'CÁLCULO LUMINOTÉCNICO CON DIALUX EVO' => 'DX',
            'ELABORACIÓN DE PROYECTOS ELÉCTRICOS RESIDENCIALES' => 'EPE',
            'EPLAN EELECTRIC P8 APLICADO A PLANOS Y ESQUEMAS ELÉCTRICOS INDUSTRIALES' => 'EP',
            'AUTOCAD ELECTRICAL' => 'AE',
            'DISEÑO MECÁNICO CON SOLIDWORKS' => 'SW',
        ];

        if (array_key_exists($request->name, $codigoCursos)) {
            $nameCode = $codigoCursos[$request->name];
            $latestCourse = Course::where('version', 'LIKE', $nameCode . '-%')->latest('version')->first();
            $version = ($latestCourse) ? intval(substr($latestCourse->version, strlen($nameCode) + 1)) + 1 : 1;
            $price = $request->price;
            $discount = $request->discount;
            $finalPrice = $price - ($price * ($discount / 100));

            Course::create([
                'name' => $request->name,
                'version' => $nameCode . '-' . $version,
                'category' => $request->category,
                'price' => $finalPrice,
                'discount' => $request->discount,
                'start_date' => date('j-M-Y', strtotime($request->start_date)),
            ]);
            return response()->json(['success' => 'Curso creado exitosamente.']);
        } else {
            return response()->json(['error' => 'Nombre de curso no válido.'], 400);
        }
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Curso no encontrado.'], 404);
        }

        $codigoCursos = [
            'INSTALACIONES ELÉCTRICAS DOMICILIARIAS' => 'ED',
            'INSTALACIONES DOMÓTICAS' => 'DOM',
            'ARMADO DE TABLEROS DE FUERZA' => 'ATF',
            'ELECTROTECNIA INDUSTRIAL' => 'ETC',
            'REBOBINADO DE MOTORES ELÉCTRICOS INDUSTRIALES' => 'RM',
            'INSTALACIÓN DE PANELES SOLARES' => 'PS',
            'INSTALACIÓN DE CÁMARAS DE SEGURIDAD' => 'CS',
            'INSTALACIÓN DE CERCOS ELÉCTRICOS Y ALARMAS DE SEGURIDAD' => 'CEA',
            'PLOMERIA DOMICILIARIA' => 'PL',
            'ELECTRÓNICA BÁSICA Y PLACAS PCB' => 'EB',
            'DISEÑO ELECTRÓNICO Y PROGRAMACIÓN DE MICROCONTROLADORES' => 'PE',
            'SOLDADURA POR ARCO ELÉCTRICO' => 'SMAW',
            'SOLDADURA GMAW Y AXIACETILÉNICA' => 'GMAW',
            'SISTEMAS DE PUESTA A TIERRA Y PARARRAYOS' => 'SPAT',
            'ACOMETIDAS EN MEDIA TENSIÓN Y SUBESTACIONES DE TRANSFORMACIÓN' => 'ACMT',
            'CÁLCULO LUMINOTÉCNICO CON DIALUX EVO' => 'DX',
            'ELABORACIÓN DE PROYECTOS ELÉCTRICOS RESIDENCIALES' => 'EPE',
            'EPLAN EELECTRIC P8 APLICADO A PLANOS Y ESQUEMAS ELÉCTRICOS INDUSTRIALES' => 'EP',
            'AUTOCAD ELECTRICAL' => 'AE',
            'DISEÑO MECÁNICO CON SOLIDWORKS' => 'SW',
        ];

        if (array_key_exists($request->name, $codigoCursos)) {
            $price = $request->price;
            $discount = $request->discount;
            $finalPrice = $price - ($price * ($discount / 100));

            $course->update([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $finalPrice,
                'version' => $request->version,
                'discount' => $request->discount,
                'start_date' => date('j-M-Y', strtotime($request->start_date)),
            ]);
            flash()->addSuccess('Curso actualizado exitosamente', 'Muy Bien!');
            return redirect()->route('courses.index');
        } else {
            return redirect()->back()->with('error', 'Nombre de curso no válido.');
        }
    }


    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course->detailRegisters->count() > 0) {
            flash()->addWarning('No se puede eliminar el curso porque tiene registros asociados', 'Atención!');
            return redirect()->route('courses.index');
        }

        $course->delete();

        flash()->addSuccess('Curso eliminado exitosamente', 'Muy Bien!');
        return redirect()->route('courses.index');
    }


    public function updateState(Course $course)
    {
        $course->status = !$course->status;
        $course->save();

        if ($course->status) {
            $message = 'Curso activado exitosamente.';
        } else if (!$course->status) {
            $message = 'Curso desactivado exitosamente.';
        } else{
            $message = 'Error al actualizar el estado del curso.';
        }

        return response()->json(['success' => $message]);
    }
}
