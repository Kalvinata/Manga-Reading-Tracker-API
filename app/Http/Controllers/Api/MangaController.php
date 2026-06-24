<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Helpers\ApiFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    // GET ALL CITY
    public function index()
    {
        $city = CityModel::orderBy('city_id', 'ASC')->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $city
            )
        );
    }

    // GET CITY BY PROVINCE
    public function byProvince($province_id)
    {
        $city = CityModel::where(
            'province_id',
            $province_id
        )->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $city
            )
        );
    }

    // CREATE CITY
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'province_id' => 'required',
                'code' => 'required|max:10',
                'name' => 'required'
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

        $city = CityModel::create([
            'province_id' => $request->province_id,
            'city_code' => $request->code,
            'city_name' => $request->name
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Create City Success',
                $city
            )
        );
    }

    // DETAIL CITY
    public function detail($id)
    {
        $city = CityModel::find($id);

        if (!$city) {

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
                'Get Detail Success',
                $city
            )
        );
    }

    // UPDATE CITY
    public function update(Request $request, $id)
    {
        $city = CityModel::find($id);

        if (!$city) {

            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $city->update([
            'province_id' => $request->province_id,
            'city_code' => $request->code,
            'city_name' => $request->name
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Update City Success',
                $city->fresh()
            )
        );
    }

    // DELETE CITY
    public function delete($id)
    {
        $city = CityModel::find($id);

        if (!$city) {

            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $city->delete();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Delete City Success'
            )
        );
    }
}