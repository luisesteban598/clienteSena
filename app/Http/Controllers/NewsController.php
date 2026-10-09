<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        $response->throw();

        return $response->json();
    }

    public function publicIndex()
    {
        $url = env('URL_SERVER_API');
        $news = $this->fetchDataFromApi($url . '/news');

        return view('News.public', compact('news'));
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $news = $this->fetchDataFromApi($url . '/news');

        return view('News.index', compact('news'));
    }

    public function create()
    {
        return view('News.create');
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        $payload = $request->only([
            'title',
            'summary',
            'content',
            'image',
            'is_published',
        ]);

        if ($request->filled('is_published')) {
            $payload['is_published'] = filter_var($request->input('is_published'), FILTER_VALIDATE_BOOLEAN);
        }

        Http::post($url . '/news', $payload)->throw();

        return redirect()->route('news.index')->with('success', 'Noticia creada correctamente.');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $news = $this->fetchDataFromApi($url . '/news/' . $id);

        return view('News.show', compact('news'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $news = $this->fetchDataFromApi($url . '/news/' . $id);

        return view('News.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        $payload = $request->only([
            'title',
            'summary',
            'content',
            'image',
            'is_published',
        ]);

        if ($request->filled('is_published')) {
            $payload['is_published'] = filter_var($request->input('is_published'), FILTER_VALIDATE_BOOLEAN);
        }

        Http::put($url . '/news/' . $id, $payload)->throw();

        return redirect()->route('news.index')->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/news/' . $id)->throw();

        return redirect()->route('news.index')->with('success', 'Noticia eliminada correctamente.');
    }
}
