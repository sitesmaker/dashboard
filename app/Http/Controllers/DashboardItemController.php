<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardItem;

class DashboardItemController extends Controller
{
    private static $error_message = "Произошла ошибка!";
    private static $create_message = "Создано успешно!";
    private static $update_message = "Обновлено успешно!";
    private static $delete_message = "Удалено успешно!";

    function createTask(Request $request): \Illuminate\Http\JsonResponse
    {
        $title = $request->get('title');
        $text = $request->get('text');
        $status_id = $request->get('status_id');

        try {
            DashboardItem::create([
                'title'  => $title,
                'text'   => $text,
                'status_id' => $status_id,
            ]);

            return response()->json([
                'message' => self::$create_message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }

    function readTasks($id): \Illuminate\Http\JsonResponse
    {
        try {
            $TaskList = DashboardItem::where('status_id', $id)->get();

            return response()->json($TaskList, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }

    function updateTask(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            DashboardItem::where('id', $id)->update($request->only('title', 'text'));

            return response()->json([
                'message' => self::$update_message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }

    function deleteTask($id): \Illuminate\Http\JsonResponse
    {
        try {
            DashboardItem::where('id', $id)->delete();

            return response()->json([
                'message' => self::$delete_message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }
}
