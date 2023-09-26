<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(UserRequest $request)
	{
		$users = User::latest()->paginate();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(UserRequest $request)
	{

		$user = new User;
		return view('users.create', compact('user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request,UserRequest $requestUser)
	{

		$data = $request->validate([
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|confirmed|min:8',
			'image' => 'required|max:2048',
			'user_type' => 'required|in:admin,user',
		]);
		if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $request->name . '.' . $file->extension();
            $file->storeAs('public/users', $filename);
            $data['image'] = $filename;
        }
	
		$data['password'] = Hash::make($data['password']);
		$data['email_verified_at'] = now();
		$name = $request->input('name');
		 $userType = $data['user_type'] === 'admin' ? 1 : 0;
	
        // return$data;
	//  dd($data);
		User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => $data['password'],
			'image' => $data['image'],
			'user_type' => $userType
		]);
	
		return redirect()->route('users.index')->withSuccess('Data successfully created.');
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user,UserRequest $request)
	{

		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user,UserRequest $requestUser)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users,email,' . $user->id,
        'password' => $request->password ? 'required|confirmed' : '',
        'image' => 'nullable|image|max:2048',
        'user_type' => 'required',
    ]);

    $data['name'] = $request->name;
    
    if ($request->password) {
        $data['password'] = Hash::make($request->password); // استخدم القيمة المُرسلة لكلمة المرور
    }


    $data['email'] = $request->email;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images');
        $data['image'] = $imagePath;
    }
	$userType = $request->input('user_type') === 'admin' ? 1 : 0;
    $data['user_type'] = $userType;

    $user->update($data);

    return redirect()->route('users.index')->withSuccess('Data successfully updated.');
}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(User $user)
	{
		$user->delete();
		return to_route('users.index')->withSuccess('Data successfully deleted.');
	}
}
