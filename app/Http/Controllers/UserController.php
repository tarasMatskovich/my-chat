<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    const USERS_PER_PAGE = 3;

    public function user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('user', ['user' => $user]);
    }

    public function users(Request $request)
    {
        $users = UserResource::collection(User::offset(($request->page - 1) * self::USERS_PER_PAGE)->limit(self::USERS_PER_PAGE)->get());
        return [
            'users' => $users,
            'totalUsers' => User::count()
        ];
    }

    public function allUsers()
    {
        $users = UserResource::collection(User::all());
        return $users;
    }

    public function edit()
    {
        $user = User::find(auth()->id());
        return view('edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $data = $request->except('_token');
        // удаляем предыдущее изображение
        if (isset($data['image']) && $user->img) {
            $user->deleteImage();
        }
        $user->fill($data);
        if (isset($data['image'])) {
            $inputImage = $data['image'];
            $filename = time() . '.' . $inputImage->getClientOriginalExtension();
            $path = public_path('img/users/' . $filename);
            Image::make($data['image'])->fit(350)->save($path);
            $user->img = $filename;
        }
        $user->update();
        return redirect()->route('user', ['id' => auth()->id()])->with('success', 'Сохранения успешно сохранены');
    }

    public function delete()
    {
        $id = auth()->id();
        auth()->logout();
        $user = User::findOrFail($id);
        $user->img ? $user->deleteImage() : '';
        $user->delete();
        return redirect()->route('login')->with('success', 'Ваша страница была успешно удалена.');
    }
}
