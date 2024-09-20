<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        return User::get();
    }

    public function get($id)
    {
        return User::findOrFail($id);
    }

    public function add($id)
    {
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}
