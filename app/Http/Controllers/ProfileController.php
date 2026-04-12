<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function changeAvatar(NewAvatarRequest $request)
    {
        /*$oldFileName = $request->user()->avatar;
        if($oldFileName){
            Storage::disk('public')->delete("images/avatars/{$oldFileName}");
        }*/

        /*$test = $request->file('image_profile')
                ->store('images/avatars','public');
        $fileName = basename($test);*/

        $name = uniqid().".webp";
        $file = $request->file('image_profile');
        $gd = new Driver();
        $manager = new ImageManager($gd);

        $image = $manager->read($file)->toWebp(90 /*Quality of Image*/);
        Storage::disk('public')->put('images/avatars/'.$name, (string) $image);
        $request->user()->update(['avatar' => $name]);

        return redirect()->back();
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
