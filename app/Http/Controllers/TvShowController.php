<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;

class TvShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TvShow::paginate(9));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'cast' => 'required|array|min:1',
            'cast.*.name' => 'required|string',
            'cast.*.character' => 'required|string',
        ]);

        $tvShow = TvShow::create($fields);

        return response()->json([
            'success' => true,
            'data' => $tvShow,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tvShow = TvShow::find($id);

        if (!$tvShow) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Tv Show not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tvShow,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tvShow = TvShow::find($id);

        if (!$tvShow) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Tv Show not found',
            ], 404);
        }

        $fields = $request->validate([
            'title' => 'required|string',
            'cast' => 'required|array|min:1',
            'cast.*.name' => 'required|string',
            'cast.*.character' => 'required|string',
        ]);

        $tvShow->update($fields);

        return response()->json([
            'success' => true,
            'data' => $tvShow,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tvShow = TvShow::find($id);

        if (!$tvShow) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Tv Show not found',
            ], 404);
        }

        $tvShow->delete();

        return response(status: 204);
    }
}
