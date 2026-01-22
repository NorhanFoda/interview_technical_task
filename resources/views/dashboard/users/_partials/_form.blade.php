<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
        <option value="">Select Role</option>
        @foreach($roles as $id => $name)
            <option value="{{ $name }}" {{ old('role', isset($user) && $user->roles->first() ? $user->roles->first()->name : '') == $name ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" {{ isset($user) ? '' : 'required' }}>
    @if(isset($user))
        <small class="form-text text-muted">Leave blank to keep current password</small>
    @endif
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>

<button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
<a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Cancel</a>
