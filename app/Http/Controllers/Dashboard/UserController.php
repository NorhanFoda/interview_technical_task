<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserContract;
use App\Http\Requests\Dashboard\UserRequest;

class UserController extends Controller
{
    protected string $indexView = 'dashboard.users.index';
    protected string $createView = 'dashboard.users.create';
    protected string $editView = 'dashboard.users.edit';
    protected string $showView = 'dashboard.users.show';
    protected string $formView = 'dashboard.users._partials._form';
    protected string $tableView = 'dashboard.users._partials._table';
    protected array $filters = [];
    public function __construct(protected UserContract $contract)
    {
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
        return view($this->createView);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {   
        $this->contract->create($request->all());
        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view($this->showView, compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view($this->editView, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $this->contract->update($user, $request->all());
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->contract->remove($user);
        return redirect()->route('dashboard.users.index')->with('success', 'User deleted successfully');
    }
}
