<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DistrictModel;
use App\Helpers\ApiFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    // 1. Ambil Semua Data District
    public function index()
    {
        $district = DistrictModel::orderBy('district_id', 'ASC')->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $district
            )
        );
    }

    // 2. Ambil Semua Data District berdasarkan ID City
    public function byCity($city_id)
    {
        $district = DistrictModel::where('city_id', $city_id)->get();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Get Data Success',
                $district
            )
        );
    }

    // 3. Buat Data Baru District
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'district_code' => 'required|max:10',
            'district_name' => 'required'
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

        $district = DistrictModel::create([
            'city_id' => $request->city_id,
            'district_code' => $request->district_code,
            'district_name' => $request->district_name
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Create District Success',
                $district
            )
        );
    }

    // 4. Ambil Detail District
    public function detail($id)
    {
        $district = DistrictModel::find($id);

        if (!$district) {
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
                'Get Detail District Success',
                $district
            )
        );
    }

    // 5. Update District
    public function update(Request $request, $id)
    {
        $district = DistrictModel::find($id);

        if (!$district) {
            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'district_code' => 'required|max:10',
            'district_name' => 'required'
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

        $district->update([
            'city_id' => $request->city_id,
            'district_code' => $request->district_code,
            'district_name' => $request->district_name
        ]);

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Update District Success',
                $district->fresh()
            )
        );
    }

    // 6. Hapus District
    public function delete($id)
    {
        $district = DistrictModel::find($id);

        if (!$district) {
            return response()->json(
                ApiFormatter::createJson(
                    404,
                    'Data Not Found'
                )
            );
        }

        $district->delete();

        return response()->json(
            ApiFormatter::createJson(
                200,
                'Delete District Success'
            )
        );
    }
}