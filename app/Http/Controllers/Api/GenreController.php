<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GenreModel;
use App\Helpers\ApiFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // GET ALL GENRE
    public function index(Request $request)
    {
        $genre = GenreModel::orderBy('genre_id', 'ASC')->get();

        $response = ApiFormatter::createJson(
            200,
            'Get Data Success',
            $genre
        );

        return response()->json($response);
    }

    // CREATE GENRE
    public function create(Request $request)
    {
        try {

            $params = $request->all();

            $validator = Validator::make($params, [
                'code' => 'required|max:10',
                'name' => 'required',
            ], [
                'code.required' => 'Genre Code is required',
                'code.max' => 'Genre Code max 10 characters',
                'name.required' => 'Genre Name is required',
            ]);

            if ($validator->fails()) {

                return response()->json(
                    ApiFormatter::createJson(
                        400,
                        'Bad Request',
                        $validator->errors()
                    )
                );
            }

            $genre = [
                'genre_code' => $params['code'],
                'genre_name' => $params['name'],
            ];

            $data = GenreModel::create($genre);

            $createdGenre = GenreModel::find($data->genre_id);

            return response()->json(
                ApiFormatter::createJson(
                    200,
                    'Create Genre Success',
                    $createdGenre
                )
            );

        } catch (\Exception $e) {

            return response()->json(
                ApiFormatter::createJson(
                    500,
                    'Internal Server Error',
                    $e->getMessage()
                )
            );
        }
    }

    // DETAIL GENRE
    public function detail($id)
    {
        try {

            $genre = GenreModel::find($id);

            if (is_null($genre)) {
                return response()->json(
                    ApiFormatter::createJson(
                        404,
                        'Genre Not Found'
                    )
                );
            }

            return response()->json(
                ApiFormatter::createJson(
                    200,
                    'Get Detail Genre Success',
                    $genre
                )
            );

        } catch (\Exception $e) {

            return response()->json(
                ApiFormatter::createJson(
                    400,
                    $e->getMessage()
                )
            );
        }
    }

    // UPDATE GENRE
    public function update(Request $request, $id)
    {
        try {

            $params = $request->all();

            $preGenre = GenreModel::find($id);

            if (is_null($preGenre)) {
                return response()->json(
                    ApiFormatter::createJson(
                        404,
                        'Data Not Found'
                    )
                );
            }

            $validator = Validator::make($params, [
                'code' => 'required|max:10',
                'name' => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json(
                    ApiFormatter::createJson(
                        400,
                        'Bad Request',
                        $validator->errors()
                    )
                );
            }

            $genre = [
                'genre_code' => $params['code'],
                'genre_name' => $params['name'],
            ];

            $preGenre->update($genre);

            return response()->json(
                ApiFormatter::createJson(
                    200,
                    'Update Genre Success',
                    $preGenre->fresh()
                )
            );

        } catch (\Exception $e) {

            return response()->json(
                ApiFormatter::createJson(
                    500,
                    'Internal Server Error',
                    $e->getMessage()
                )
            );
        }
    }

    // PATCH GENRE
    public function patch(Request $request, $id)
    {
        try {

            $params = $request->all();

            $preGenre = GenreModel::find($id);

            if (is_null($preGenre)) {
                return response()->json(
                    ApiFormatter::createJson(
                        404,
                        'Data Not Found'
                    )
                );
            }

            $genre = [];

            if (isset($params['code'])) {
                $genre['genre_code'] = $params['code'];
            }

            if (isset($params['name'])) {
                $genre['genre_name'] = $params['name'];
            }

            $preGenre->update($genre);

            return response()->json(
                ApiFormatter::createJson(
                    200,
                    'Update Genre Success',
                    $preGenre->fresh()
                )
            );

        } catch (\Exception $e) {

            return response()->json(
                ApiFormatter::createJson(
                    500,
                    'Internal Server Error',
                    $e->getMessage()
                )
            );
        }
    }

    // DELETE GENRE
    public function delete($id)
    {
        try {

            $genre = GenreModel::find($id);

            if (is_null($genre)) {
                return response()->json(
                    ApiFormatter::createJson(
                        404,
                        'Data Not Found'
                    )
                );
            }

            $genre->delete();

            return response()->json(
                ApiFormatter::createJson(
                    200,
                    'Delete Genre Success'
                )
            );

        } catch (\Exception $e) {

            return response()->json(
                ApiFormatter::createJson(
                    500,
                    'Internal Server Error',
                    $e->getMessage()
                )
            );
        }
    }
}