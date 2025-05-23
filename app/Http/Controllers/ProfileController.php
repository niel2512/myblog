<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());
        $validated = $request->validated();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // if ($request->hasFile('avatar')) {
            // logika untuk menghapus file di storage apabila user update foto baru
            // if(!empty($request->user()->avatar)) {
            //     Storage::disk('public')->delete($request->user()->avatar);
            // }

            //supaya file yg di upload disimpan di storage->app->public 
            // $path = $request->file('avatar')->store('img', 'public'); 
            //tapi harus php artisan storage:link supaya terhubung di folder public yang di app->public->img
            // $validated['avatar'] = $path;
        // }
        // $request->user()->save();

        // logika untuk upload file pakai library js filepond
        if($request->avatar) {
         if(!empty($request->user()->avatar)) {
                Storage::disk('public')->delete($request->user()->avatar);
            }
            // logika untuk memindahkan file .png dari tmp dan dipindahkan ke folder img
            $newFileName =  Str::after($request->avatar, 'tmp/');
            Storage::disk('public')->move($request->avatar, "img/$newFileName");
            $validated['avatar'] = "img/$newFileName";
        }
        $request->user()->update($validated);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function upload(Request $request)
    {
        if($request->hasFile('avatar')){
            //nanti akan membuat folder tmp didalam storage->public
            $path = $request->file('avatar')->store('tmp', 'public');  
            return $path;
        }
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
