<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MangaModel;
use App\Helpers\ApiFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MangaController extends Controller
{
    // GET ALL MANGA
    public function index()
    {
        $manga = MangaModel::orderBy('manga_id', 'ASC')->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $manga
            )
        );
    }

    // GET MANGA BY GENRE
    public function byGenre($genre_id)
    {
        $manga = MangaModel::where(
            'genre_id',
            $genre_id
        )->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $manga
            )
        );
    }

    // CREATE MANGA
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'genre_id' => 'required',
                'code' => 'required|max:10',
                'title' => 'required',
                'author' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()) {

            return response()->json(
                ApiFormatter::createJson(
                    400,
                    'Bad Request',
                    $validator->errors()
                )
            );
        }

        $manga = MangaModel::create([
            'genre_id' => $request->genre_id,
            'manga_code' => $request->code,
            'manga_title' => $request->title,
            'author' => $request->author,
            'status' => $request->status
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Create Manga Success',
                $manga
            )
        );
    }

    // DETAIL MANGA
    public function detail($id)
    {
        $manga = MangaModel::find($id);

        if (!$manga) {

            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Detail Manga Success',
                $manga
            )
        );
    }

    // UPDATE MANGA
    public function update(Request $request, $id)
    {
        $manga = MangaModel::find($id);

        if (!$manga) {

            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $manga->update([
            'genre_id' => $request->genre_id,
            'manga_code' => $request->code,
            'manga_title' => $request->title,
            'author' => $request->author,
            'status' => $request->status
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Update Manga Success',
                $manga->fresh()
            )
        );
    }

    // DELETE MANGA
    public function delete($id)
    {
        $manga = MangaModel::find($id);

        if (!$manga) {

            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $manga->delete();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Delete Manga Success'
            )
        );
    }
}