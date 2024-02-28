<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        // Overrides
        $request->request->add(['username' => Str::slug($request->username)]);
        
        if ($request->image) {
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);
            $imagePath = public_path('profiles/') . '/' . $imageName;
            $imageServer->save($imagePath);
        }
        
        $this->validate($request, [
            'name' => "required",
            'username' => [
                'required',
                'unique:users,username,'.auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil,edit'
            ],
            'email' => 'required|email'
        ]);

        $user = User::find(auth()->user()->id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName ?? auth()->user()->image ?? null;

        $user->save();

        return redirect()->route('posts.index', $user->username); 
    }
}
