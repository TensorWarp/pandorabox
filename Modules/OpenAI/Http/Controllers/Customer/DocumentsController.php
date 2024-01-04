<?php


namespace Modules\OpenAI\Http\Controllers\Customer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DocumentsController extends Controller
{
    public function toggleBookmark(Request $request): mixed
    {
        $authUser = auth()->user();
        $bookmarksArray = $authUser->document_bookmarks_openai;

        try {
            if (is_null($bookmarksArray)) {
                $bookmarksArray = $authUser->document_bookmarks_openai = [];
            }

            if ($request->toggle_state == 'true') {
                $bookmarksArray = array_unique(array_merge($bookmarksArray, [$request->document_id]), SORT_NUMERIC);
                $message = __("Successfully bookmarked!");
            } else {
                $bookmarksArray = array_diff($bookmarksArray, [$request->document_id]);
                $message = __("Successfully removed from bookmarks!");
            }

            $authUser->document_bookmarks_openai = $bookmarksArray;
            $authUser->save();
        } catch (Exception $e) {
            return response()->json(["success" => false, "message" => __("Failed to update bookmarks! Please try again later.")], 500);
        }

        return response()->json(["success" => true, "message" => $message], 200);
    }

}
