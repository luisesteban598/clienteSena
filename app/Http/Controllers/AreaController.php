<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AreaController extends Controller
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

        $areas = $this->fetchDataFromApi($url . '/areas');

        return view('Area.index', compact('areas'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $area = $this->fetchDataFromApi($url . '/areas/' . $id);

        return view('Area.show', compact('area'));
    }


    public function create()
    {
        return view('Area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $url = env('URL_SERVER_API');
        $file = $request->file('imagen');

        Http::attach('imagen', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($url . '/areas', ['name' => $request->name])
            ->throw();

        return redirect()->route('area.index');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $area = $this->fetchDataFromApi($url . '/areas/' . $id);

        return view('Area.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put($url . '/areas/' . $id, $request->all())->throw();

        return redirect()->route('area.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/areas/' . $id)->throw();
        return redirect()->route('area.index');
    }

}