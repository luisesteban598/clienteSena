<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{

    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');

        return view('TrainingCenter.index', compact('trainingCenters'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $trainingCenter = $this->fetchDataFromApi($url . '/training-centers/' . $id);

        return view('TrainingCenter.show', compact('trainingCenter'));
    }


    public function create()
    {
        return view('TrainingCenter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $url = env('URL_SERVER_API');
        $file = $request->file('imagen');

        Http::attach('imagen', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($url . '/training-centers', [
                'name' => $request->name,
                'location' => $request->location
            ])
            ->throw();

        return redirect()->route('trainingCenter.index');
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

        Http::put($url . '/training-centers/' . $id, $request->all())->throw();

        return redirect()->route('trainingCenter.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/training-centers/' . $id)->throw();
        return redirect()->route('trainingCenter.index');
    }

}