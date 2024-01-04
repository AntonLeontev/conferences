<?php

namespace Src\Domains\Auth\Actions;

use Illuminate\Foundation\Http\FormRequest;
use Src\Domains\Auth\Models\Organization;
use Src\Domains\Auth\Models\User;

class CreateOrganization
{
    public function handle(FormRequest $request, User $user): Organization
    {
        //TODO logo saving

        return Organization::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'short_name' => $request->short_name,
            'inn' => $request->inn,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
            'type' => $request->type,
            'actions' => json_encode($request->actions),
            'vk' => $request->vk,
            // 'logo',
        ]);
    }
}
