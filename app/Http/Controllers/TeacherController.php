<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeacherController extends Controller
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
        $teachers = $this->fetchDataFromApi($url . '/teachers');

        return view('Teacher.index', compact('teachers'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $teacher = $this->fetchDataFromApi($url . '/teachers/' . $id);

        return view('Teacher.show', compact('teacher'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url . '/areas');
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('Teacher.create', compact('areas', 'trainingCenters'));
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post($url . '/teachers', $request->only([
            'name',
            'email',
            'area_id',
            'training_center_id',
        ]))->throw();

        return redirect()->route('teacher.index')->with('success', 'Instructor creado correctamente.');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $teacher = $this->fetchDataFromApi($url . '/teachers/' . $id);
        $areas = $this->fetchDataFromApi($url . '/areas');
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('Teacher.edit', compact('teacher', 'areas', 'trainingCenters'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put($url . '/teachers/' . $id, $request->only([
            'name',
            'email',
            'area_id',
            'training_center_id',
        ]))->throw();

        return redirect()->route('teacher.index')->with('success', 'Instructor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/teachers/' . $id)->throw();

        return redirect()->route('teacher.index')->with('success', 'Instructor eliminado correctamente.');
    }
}
