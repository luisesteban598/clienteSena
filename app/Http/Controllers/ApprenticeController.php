<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApprenticeController extends Controller
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
        $apprentices = $this->fetchDataFromApi($url . '/apprentices');

        return view('Apprentice.index', compact('apprentices'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $apprentice = $this->fetchDataFromApi($url . '/apprentices/' . $id);

        return view('Apprentice.show', compact('apprentice'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $courses = $this->fetchDataFromApi($url . '/courses');
        $computers = $this->fetchDataFromApi($url . '/computers');

        return view('Apprentice.create', compact('courses', 'computers'));
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post($url . '/apprentices', $request->only([
            'name',
            'email',
            'cell_number',
            'course_id',
            'computer_id',
        ]))->throw();

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz creado correctamente.');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $apprentice = $this->fetchDataFromApi($url . '/apprentices/' . $id);
        $courses = $this->fetchDataFromApi($url . '/courses');
        $computers = $this->fetchDataFromApi($url . '/computers');

        return view('Apprentice.edit', compact('apprentice', 'courses', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put($url . '/apprentices/' . $id, $request->only([
            'name',
            'email',
            'cell_number',
            'course_id',
            'computer_id',
        ]))->throw();

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz actualizado correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/apprentices/' . $id)->throw();

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz eliminado correctamente.');
    }
}
