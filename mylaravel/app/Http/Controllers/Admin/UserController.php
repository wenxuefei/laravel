<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function delete($id)
    {
        echo route('udelete', ['id', $id]);
        return $id;
    }
}
