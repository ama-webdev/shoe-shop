<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckRole;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:edit-customer-user'])->only(['create', 'store', 'edit', 'update']);
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.users.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'roles' => 'required'
        ]);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $roles = $request->roles;

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->status = 'ACTIVE';
        $user->save();
        $user->assignRole($roles);
        return redirect()->route('admin.users.index')->with('created', 'Successfully created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $has_role = CheckRole::checkRole(Auth::user(), $user);
        if (!$has_role) {
            abort(403);
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|unique:users,email,' . $id,
            'roles' => 'required'
        ]);
        $name = $request->name;
        $email = $request->email;
        $roles = $request->roles;
        $status = $request->status;
        $new_password = $request->new_password;

        $user = User::findOrFail($id);
        $user->name = $name;
        $user->email = $email;
        $user->status = $status;
        if ($new_password) {
            $user->password = Hash::make($new_password);
        }
        $user->update();
        $user->syncRoles([]);
        $user->assignRole($roles);

        return redirect()->route('admin.users.index')->with('updated', 'Successfully udpated');
    }

    public function destroy($id)
    {
        //
    }
    public function ssd(Request $request)
    {
        $role = $request->role_id;
        $name = $request->name;
        $email = $request->email;
        $stauts = $request->status;
        $query = User::query();

        return Datatables::of($query)
            ->filter(function () use ($name, $email, $role, $stauts, $query) {
                if ($name) {
                    $query = $query->where('name', $name);
                }

                if ($role) {
                    $query = $query->whereHas('roles', function ($q) use ($role) {
                        $q->where('id', $role);
                    });
                }

                if ($email) {
                    $query = $query->where('email', $email);
                }

                if ($stauts) {
                    $query = $query->where('status', $stauts);
                }
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.users.edit', $each->id) . '" class="edit-btn me-2 d-block text-center"><i class="fa-solid fa-pen-to-square" style="font-size:1.2rem;color:#444;"></i></a>';
                // $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash"></i></a>';
                return $edit;
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
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->editColumn('status', function ($each) {
                $status = '';
                if ($each->status && $each->status == 'ACTIVE') {
                    $status = '<i class="fa-solid fa-circle-check text-success d-block text-center" style="font-size:1.2rem"></i>';
                } elseif ($each->status && $each->status == 'INACTIVE') {
                    $status = '<i class="fa-solid fa-circle-xmark text-danger d-block text-center" style="font-size:1.2rem"></i>';
                } else {
                    $status = '-';
                }
                return $status;
            })
            ->rawColumns(['role', 'action', 'status'])
            ->make(true);
    }
}