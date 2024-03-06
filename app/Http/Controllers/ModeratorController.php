<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeratorDestroyRequest;
use App\Http\Requests\ModeratorStoreRequest;
use App\Notifications\CreatedAsModerator;
use App\Notifications\InvitedAsModerator;
use Illuminate\Http\JsonResponse;
use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class ModeratorController extends Controller
{
    public function store(Conference $conference, ModeratorStoreRequest $request): JsonResponse
    {
        if ($request->get('moderable_type') === 'section') {
            $moderable = Section::find($request->get('moderable_id'));
        } else {
            $moderable = $conference;
        }

        $user = User::where(['email' => $request->get('email')])->first();

        if (is_null($user)) {
            $password = str()->random(10);
            $user = User::create([
                'email' => $request->get('email'),
                'password' => bcrypt($password),
                'email_verified_at' => now(),
            ]);

            $user->notify(new CreatedAsModerator($moderable, $password));
        } else {
            $user->notify(new InvitedAsModerator($moderable));
        }

        $moderable->moderators()->sync([$user->id => ['comment' => $request->get('comment')]], false);

        $data = $moderable->moderators;

        return response()->json($data);
    }

    public function destroy(Conference $conference, ModeratorDestroyRequest $request): JsonResponse
    {
        if ($request->get('moderable_type') === 'section') {
            $moderable = Section::find($request->get('moderable_id'));
        } else {
            $moderable = $conference;
        }

        $moderable->moderators()->detach($request->get('user_id'));

        return response()->json($moderable->moderators);
    }
}
