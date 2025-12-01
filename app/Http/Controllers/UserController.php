<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
    $filterableColumns = ['email'];
    $searchableColumns = ['name', 'email'];
	$data['user'] = User::filter($request, $filterableColumns)
					->paginate(10)
					->withQueryString();
		return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data['name']                  = $request->name;
        $data['email']                 = $request->email;
         $data['role']                 = $request->role;
        $data['password']              = Hash::make($request->password);
        $data['password_confirmation'] = $request->password_confirmation;

        User::create($data);

        return redirect()->back()->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $user = User::findOrFail($id);

    return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    // Update password hanya jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
