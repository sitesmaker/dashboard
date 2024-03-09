<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardStatus;
use Exception;

class DashboardController extends Controller
{
    private static $error_message = "Произошла ошибка!";
    private static $create_message = "Создано успешно!";
    private static $update_message = "Обновлено успешно!";
    private static $delete_message = "Удалено успешно!";

    function createStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $title = $request->get('title');

        try {
            $DashboardStatus = DashboardStatus::create([
                'title'  => $title,
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

    function readStatus(): \Illuminate\Http\JsonResponse
    {
        try {
            $DashboardStatusData = DashboardStatus::all();

            return response()->json($DashboardStatusData, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }

    function updateStatus(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $title = $request->get('title');

        try {
            $DashboardStatusData = DashboardStatus::where('id', $id)->update(['title' => $title]);

            return response()->json([
                'message' => self::$update_message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => self::$error_message,
            ], 500);
        }
    }

    function deleteStatus($id): \Illuminate\Http\JsonResponse
    {
        try {
            $DashboardStatusData = DashboardStatus::where('id', $id)->delete();

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
