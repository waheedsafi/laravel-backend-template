<?php

namespace App\Http\Controllers\v1\template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $auth_user_id = $request->user()->id;
        $tr =  DB::table('notifications as n')
            ->where('n.user_id', $auth_user_id)
            ->select(
                'n.id',
                'n.message',
                'n.is_read',
                'n.action_url',
                'n.context',
                'n.created_at',
            )
            ->orderByDesc('n.id')
            ->get();
        $unreadCount = DB::table('notifications')
            ->where('user_id', $auth_user_id)
            ->where('is_read', false)
            ->count();
        return response()->json([
            'notifications' => $tr,
            'unread_count' => $unreadCount,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function update(Request $request)
    {
        $request->validate([
            'ids' => 'required|array'
        ]);
        $auth_user_id = $request->user()->id;

        // Update notifications only for this user
        $affected = DB::table('notifications')
            ->where('user_id', $auth_user_id)
            ->whereIn('id', $request->ids)
            ->update(['is_read' => true]);

        return response()->json([], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
