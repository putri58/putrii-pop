<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.profile.edit', compact('user'));
}
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }
    $user->save();
    return back()->with('success', 'Profile updated!');
}
    public function destroy()
    {
        $user = Auth::user();
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }
        return redirect()->route('profile.edit')->with('success', 'Profile picture deleted successfully!');
    }
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('admin.profile.show', compact('user'));
}

}