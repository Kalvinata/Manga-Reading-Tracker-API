<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReadingListModel;
use App\Helpers\ApiFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReadingListController extends Controller
{
    // GET ALL READING LIST
    public function index()
    {
        $readingList = ReadingListModel::orderBy(
            'reading_list_id',
            'ASC'
        )->get();

        return ApiFormatter::createJson(
            200,
            'Get Data Success',
            $readingList
        );
    }

    // GET READING LIST BY MANGA
    public function byManga($manga_id)
    {
        $readingList = ReadingListModel::where(
            'manga_id',
            $manga_id
        )->get();

        return ApiFormatter::createJson(
            200,
            'Get Data Success',
            $readingList
        );
    }

    // CREATE READING LIST
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manga_id' => 'required',
            'user_id' => 'nullable',
            'reading_status' => 'required',
            'chapter_read' => 'required',
            'rating' => 'nullable',
            'notes' => 'nullable'
        ]);

        if ($validator->fails()) {

            return ApiFormatter::createJson(
                400,
                'Bad Request',
                $validator->errors()
            );
        }

        $readingList = ReadingListModel::create([
            'manga_id' => $request->manga_id,
            'user_id' => $request->user_id,
            'reading_status' => $request->reading_status,
            'chapter_read' => $request->chapter_read,
            'rating' => $request->rating,
            'notes' => $request->notes
        ]);

        return ApiFormatter::createJson(
            200,
            'Create Reading List Success',
            $readingList
        );
    }

    // DETAIL READING LIST
    public function detail($id)
    {
        $readingList = ReadingListModel::find($id);

        if (!$readingList) {

            return ApiFormatter::createJson(
                404,
                'Data Not Found'
            );
        }

        return ApiFormatter::createJson(
            200,
            'Get Detail Reading List Success',
            $readingList
        );
    }

    // UPDATE READING LIST
    public function update(Request $request, $id)
    {
        $readingList = ReadingListModel::find($id);

        if (!$readingList) {

            return ApiFormatter::createJson(
                404,
                'Data Not Found'
            );
        }

        $readingList->update([
            'manga_id' => $request->manga_id,
            'user_id' => $request->user_id,
            'reading_status' => $request->reading_status,
            'chapter_read' => $request->chapter_read,
            'rating' => $request->rating,
            'notes' => $request->notes
        ]);

        return ApiFormatter::createJson(
            200,
            'Update Reading List Success',
            $readingList->fresh()
        );
    }

    // DELETE READING LIST
    public function delete($id)
    {
        $readingList = ReadingListModel::find($id);

        if (!$readingList) {

            return ApiFormatter::createJson(
                404,
                'Data Not Found'
            );
        }

        $readingList->delete();

        return ApiFormatter::createJson(
            200,
            'Delete Reading List Success'
        );
    }
}