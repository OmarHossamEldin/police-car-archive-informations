<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\collectionFormatter;

class UserController extends Controller
{
    /**
     * validation rules
     * @var array
     */
    private $validationRules = [
        'name' => 'required|string',
        'username' => 'required|string|unique:users',
        'password' => 'required|min:8'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select(['id', 'name', 'username'])->get();
        $headers = collectionFormatter::headers($users);
        $dataTable = collectionFormatter::data($users);
        return Inertia::render('Users/index', [
            'title' => 'المستخدمين',
            'headers' => $headers,
            'dataTable' => $dataTable
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate($this->validationRules);
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        $user = $user->only(['id', 'name', 'username']);
        return response()->json(['message' => 'لقد تم انشاء مستخدم جديد بنجاح', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['message' => 'تم ايجاد المستخدم المطلوب', 'user' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validationRules['username'] = 'required|string|unique:users,id';
        $this->validationRules['password'] = 'optional|min:8';
        $validateData = $request->validate($this->validationRules);
        $user->update($validateData);
        $user = $user->only(['id', 'name', 'username']);
        return response()->json(['message' => 'تم تحديث بيانات المستخدم', 'user' => $user], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([],204);
    }
}
