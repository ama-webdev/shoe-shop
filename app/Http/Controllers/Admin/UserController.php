<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.users.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ssd(Request $request)
    {
        $role = $request->role;
        $name = $request->name;
        $email = $request->email;
        $query = User::query();

        return Datatables::of($query)
            ->filter(function () use ($name, $email, $role, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }

                if ($role) {
                    $query = $query->has('model_has_roles.role_id', $role);
                }

                if ($email) {
                    $query = $query->where('email', $email);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.users.edit', $each->id) . '" class="text-warning edit-btn me-2"><i class="fas fa-edit"></i></a>';
                $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->addColumn('role', function ($each) {
                $roles = $each->getRoleNames();
                $role_group = '';
                foreach ($roles as $role) {
                    $role_group .= '<p class="m-0 p-0">' . $role . '</p>';
                }

                return $role_group;
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s A');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s A');
            })
            ->rawColumns(['role', 'action'])
            ->make(true);
    }
}