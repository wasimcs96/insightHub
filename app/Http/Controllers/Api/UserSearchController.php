<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserSearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');
    //     $page = $request->input('page', 1);
    //     $perPage = 5;

    //     if (!$keyword || strlen($keyword) < 2) {
    //         return response()->json([
    //             'data' => [],
    //             'has_more' => false
    //         ]);
    //     }

    //     $query = User::where('name', 'like', '%' . $keyword . '%')->whereHas('jobHeadcount');

    //     $total = $query->count();
    //     $users = $query->skip(($page - 1) * $perPage)
    //                 ->take($perPage)
    //                 ->get(['id', 'name']);

    //     $hasMore = ($page * $perPage) < $total;

    //     return response()->json([
    //         'data' => $users,
    //         'has_more' => $hasMore
    //     ]);
    // }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $page = $request->input('page', 1);
        $perPage = 5;

        if (!$keyword || strlen($keyword) < 2) {
            return response()->json([
                'data' => [],
                'has_more' => false
            ]);
        }

        // Modify the query to include headcount_code from the jobHeadcount relationship
        $query = User::where('tenant_id', auth()->user()->tenant_id)->where('name', 'like', '%' . $keyword . '%')
                    ->whereHas('jobHeadcount')
                    ->with(['jobHeadcount' => function($query) {
                        $query->select('headcount_code', 'user_id'); // Ensure we get headcount_code and user_id
                    }]);

        $total = $query->count();

        // Now retrieve the users with their jobHeadcount headcount_code
        $users = $query->skip(($page - 1) * $perPage)
                    ->take($perPage)
                    ->get(['id', 'name']); // Keep the user's id and name in the result

        // Add headcount_code to the result
        $users->transform(function($user) {
            // Attach the headcount_code to the user data
            $user->headcount_code = $user->jobHeadcount->headcount_code ?? null;
            return $user;
        });

        $hasMore = ($page * $perPage) < $total;

        return response()->json([
            'data' => $users,
            'has_more' => $hasMore
        ]);
    }


}
