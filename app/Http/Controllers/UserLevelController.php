<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\Models\User;
use App\Enums\UserLevel;

class UserLevelController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('updateLevel', $user);
        return view('userlevels.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('updateLevel', $user);

        $validated = $request->validate([
            'level' => ['required', new Enum(UserLevel::class)]
        ]);

        $user->level = $validated['level'];
        $user->save();

        return redirect(route('users.index'));
    }
}
