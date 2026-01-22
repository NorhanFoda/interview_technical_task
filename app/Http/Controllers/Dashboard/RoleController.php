<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleContract;
use App\Http\Requests\Dashboard\RoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected string $indexView = 'dashboard.roles.index';
    protected string $createView = 'dashboard.roles.create';
    protected string $editView = 'dashboard.roles.edit';
    protected string $showView = 'dashboard.roles.show';
    protected string $formView = 'dashboard.roles._partials._form';
    protected string $tableView = 'dashboard.roles._partials._table';
    protected array $filters = [];

    public function __construct(protected RoleContract $contract)
    {
        $this->middleware('permission:roles.view')->only(['index', 'show']);
        $this->middleware('permission:roles.create')->only(['create', 'store']);
        $this->middleware('permission:roles.update')->only(['edit', 'update']);
        $this->middleware('permission:roles.delete')->only(['destroy']);
        $this->filters = request()->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->contract->search($this->filters);
        return view($this->indexView, compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        return view($this->createView, compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->contract->create($request->all());
        return redirect()->route('dashboard.roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view($this->editView, compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->contract->update($role, $request->all());
        return redirect()->route('dashboard.roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->contract->remove($role);
        return redirect()->route('dashboard.roles.index')->with('success', 'Role deleted successfully');
    }
}
