<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrainingCenterController extends Controller
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
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('TrainingCenter.index', compact('trainingCenters'));
    }

    public function create()
    {
        return view('TrainingCenter.create');
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');
        Http::post($url . '/training-centers', $request->only(['name', 'location']))->throw();

        return redirect()->route('trainingCenter.index')->with('success', 'Centro de formación creado correctamente.');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $trainingCenter = $this->fetchDataFromApi($url . '/training-centers/' . $id);

        return view('TrainingCenter.show', compact('trainingCenter'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $trainingCenter = $this->fetchDataFromApi($url . '/training-centers/' . $id);

        return view('TrainingCenter.edit', compact('trainingCenter'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');
        Http::put($url . '/training-centers/' . $id, $request->only(['name', 'location']))->throw();

        return redirect()->route('trainingCenter.index')->with('success', 'Centro de formación actualizado correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/training-centers/' . $id)->throw();

        return redirect()->route('trainingCenter.index')->with('success', 'Centro de formación eliminado correctamente.');
    }
}
