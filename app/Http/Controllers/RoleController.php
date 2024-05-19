<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('role_access');

        $rolesQuery = Role::query();

        $this->applySearch($rolesQuery, $request->search);

        $roles = RoleResource::collection($rolesQuery->paginate(5));

        return inertia('Roles/Index', [
            'roles' => $roles,
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });
    }

    public function create()
    {
        Gate::authorize('role_create');

        $permissions = PermissionResource::collection(Permission::all());

        return inertia('Roles/Create',[
            'permissions' => $permissions
        ]);
    }    

    public function store(StoreRoleRequest $request)
    {
        Gate::authorize('role_create');

        $role = Role::create($request->validated());
        $role->permissions()->sync($request->selectedPermissions);

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        Gate::authorize('role_edit');

        $role->load('permissions');

        return inertia('Roles/Edit', [
            'role' => RoleResource::make($role),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        Gate::authorize('role_edit');

        $role->update($request->validated());
        $role->permissions()->sync($request->selectedPermissions);
        return redirect()->route('roles.index');
    }
    
    public function destroy(Role $role)
    {
        Gate::authorize('role_delete');

        $role->delete();

        return redirect()->route('roles.index');
    }    
}
