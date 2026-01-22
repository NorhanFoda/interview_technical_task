<div class="card mb-4">
    <div class="card-header">
        Permissions
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($permissions as $group => $perms)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header text-capitalize">
                            {{ $group }}
                        </div>
                        <div class="card-body">
                            @foreach($perms as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                           value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                                           {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
