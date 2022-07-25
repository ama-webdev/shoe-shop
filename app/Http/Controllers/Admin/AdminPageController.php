<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class AdminPageController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}