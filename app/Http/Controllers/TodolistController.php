<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todolist = Todolist::latest()->get();
        return TodolistResource::collection($todolist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|in:0,1'
        ]);
        $todolist = Todolist::firstOrCreate(
            ['title' => $data['title']],
            [
                'description' => $data['description'],
                'is_done' => $data['is_done']
            ]
        );

        return new TodolistResource($todolist);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todolist = Todolist::find($id);
        if (!$todolist) {
            return response(['message' => 'Todolist Not Found!'], 404);
        }
        return new TodolistResource($todolist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|in:0,1'
        ]);
        $todolist = Todolist::find($id);
        if ($todolist === null) {
            return response()->json(['message' => 'Todolist Not Found'], 404);
        }
        try {
            $todolist->update($data);

            return response()->json([
                'message' => 'Todolist Updated Successfully!',
                'data' => new TodolistResource($todolist)
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Todolist Update Failed',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todolist = Todolist::find($id);
        if (!$todolist) {
            return response(['message' => 'Todolist Not Found!'], 404);
        }

        $todolist->delete();

        return response()->json([
            'message' => 'todolist Deleted successfully'
        ], 200);
    }
}
