<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CursoController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        $response->throw();

        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $courses = $this->fetchDataFromApi($url . '/courses');

        return view('Curso.index', compact('courses'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $course = $this->fetchDataFromApi($url . '/courses/' . $id);

        return view('Curso.show', compact('course'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url . '/areas');
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('Curso.create', compact('areas', 'trainingCenters'));
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post($url . '/courses', $request->only([
            'course_number',
            'day',
            'area_id',
            'training_center_id',
        ]))->throw();

        return redirect()->route('curso.index')->with('success', 'Curso creado correctamente.');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $course = $this->fetchDataFromApi($url . '/courses/' . $id);
        $areas = $this->fetchDataFromApi($url . '/areas');
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('Curso.edit', compact('course', 'areas', 'trainingCenters'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put($url . '/courses/' . $id, $request->only([
            'course_number',
            'day',
            'area_id',
            'training_center_id',
        ]))->throw();

        return redirect()->route('curso.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/courses/' . $id)->throw();

        return redirect()->route('curso.index')->with('success', 'Curso eliminado correctamente.');
    }
}
