<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@include('dashboard.roles._partials._permissions_card')

<button type="submit" class="btn btn-primary">{{ isset($role) ? 'Update' : 'Create' }}</button>
<a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">Cancel</a>
