<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return response()->json($pages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:pages',
        ]);

        $page = Page::create($request->all());
        return response()->json($page, 201);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return response()->json($page);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:pages,slug,' . $id,
        ]);

        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json($page, 200);
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return response()->json(null, 204);
    }
}
