<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Users";
        $datas = User::get();
        return view('users.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
        ]) ;
        return redirect()->to('users');
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
        $edit = User::find($id);
        return view('users.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $category = Categories::find( $id );
        // $category->category_name = $request->category_name;
        // $Ccategory->save();
        $users = User::find( $id );
        User::where('id', $id)->update([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password ?? $users->password,

        ]) ;
        return redirect()->to('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $category = Categories::find( $id );
        // $category->delete();
        User::where('id', $id)->delete();
        return redirect()->to('users');
    }
}
