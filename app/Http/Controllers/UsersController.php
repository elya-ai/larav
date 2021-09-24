<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Phones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function getUsers()
    {
    	$users = User::get();
    	return response()->json($users);
    }

    public function addUsers(Request $req)
    {
    	$users = new User();

    	$users->name = $req->name;
    	$users->login = $req->login;
    	$users->password = $req->password;

    	$a = $users->save();

    	if ($a)
    		return "Запись добавлена";
    	return "Попробуйте снова";
    }

    public function updateUsers(Request $req)
    {
    	$users = User::where('id', $req->id)->first();

    	$users->name = $req->name;
    	$users->login = $req->login;
    	$users->password = $req->password;

    	$users->save();
    	return response()->json($users);
    }

    public function delete(Request $req)
    {
    	$users = User::where('name', $req->name)->first();
    	$users->delete();
    	return response()->json("Удалено");
    }

    public function register(Request $req)
    {
    	$validator = Validator::make($req->all(),
    		[
    		'name' => 'required',
    		'login' => 'required',
    		'password' => 'required|min:6|max:15',
    		]);
    	if ($validator->fails())
    		return response()->json($validator->errors());

    	$arr = $req->all();
    	$arr['password'] = Hash::make($req->password);

    	$users = User::create($arr);
    	return response()->json("Вы успешно зарегистрировались!");
    }

    public function auth(Request $req)
    {
    	$validator = Validator::make($req->all(),
    		[
    		'login' => 'required',
    		'password' => 'required',
    		]);
    	if ($validator->fails())
    		return response()->json($validator->errors());

    	if ($users = User::where('login', $req->login)->first())
    	{
    		if (Hash::check($req->password, $users->password))
    		{
    			$users->api_token  = Str::random(50);
    			$users->save();
    			return response()->json("Вы успешно авторизовались!");
    		}
    	}
    	return response()->json("Попробуйте снова...");
    }

    public function proverka(Request $req)
    {
    	return response()->json("Метод отработал");
    }

    public function adminOrGuest(Request $req)
    {
        return response()->json("Добро пожаловать!");
    }

    public function getProd()
    {
        $users = User::get();
        foreach ($users as $user) {
            $user['products'] = $user->products()->get();
        }
        return response()->json($users);
    }

    public function getFirm()
    {
        $users = User::get();
        foreach ($users as $user) {
            $user['phones'] = $user->phones()->get();
        }
        return response()->json($users);
    }
}
