<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ComputerController extends Controller
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
        $computers = $this->fetchDataFromApi($url . '/computers');

        return view('Computer.index', compact('computers'));
    }

    public function create()
    {
        return view('Computer.create');
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');
        Http::post($url . '/computers', $request->only(['number', 'brand']))->throw();

        return redirect()->route('computer.index')->with('success', 'Computador creado correctamente.');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url . '/computers/' . $id);

        return view('Computer.show', compact('computer'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url . '/computers/' . $id);

        return view('Computer.edit', compact('computer'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');
        Http::put($url . '/computers/' . $id, $request->only(['number', 'brand']))->throw();

        return redirect()->route('computer.index')->with('success', 'Computador actualizado correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/computers/' . $id)->throw();

        return redirect()->route('computer.index')->with('success', 'Computador eliminado correctamente.');
    }
}
