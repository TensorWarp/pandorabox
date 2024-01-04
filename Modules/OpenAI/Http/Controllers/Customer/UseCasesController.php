<?php


namespace Modules\OpenAI\Http\Controllers\Customer;

use Exception;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\UseCase;
use Modules\OpenAI\Http\Requests\ToggleFavoriteUseCaseRequest;

class UseCasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('forceJson')->only('toggleFavorite');
    }

    public function searchTabData(): mixed
    {
        $useCases = UseCase::query()->where('status', 'Active')->filter()->get();
        $userUseCaseFavorites = auth()->user()->use_case_favorites;
        return view('openai::user.renderable.use-case-search-result', compact('useCases', 'userUseCaseFavorites'))->render();
    }

    public function toggleFavorite(ToggleFavoriteUseCaseRequest $request): mixed
    {
        $authUser = auth()->user();
        $favoritesArray = $authUser->use_case_favorites;

        try {
            if (is_null($favoritesArray)) {
                $favoritesArray = $authUser->use_case_favorites = [];
            }

            if ($request->toggle_state == 'true') {
                $favoritesArray = array_unique(array_merge($favoritesArray, [$request->use_case_id]), SORT_NUMERIC);
                $message = __("Successfully marked favorite!");
            } else {
                $favoritesArray = array_diff($favoritesArray, [$request->use_case_id]);
                $message = __("Successfully removed from favorites!");
            }

            $authUser->use_case_favorites = $favoritesArray;
            $authUser->save();
        } catch (Exception $e) {
            return response()->json(["success" => false, "message" => __("Failed to update favorites! Please try again later.")], 500);
        }

        return response()->json(["success" => true, "message" => $message], 200);
    }
}
