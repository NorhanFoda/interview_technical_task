<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($product) ? $product->name : '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($product) ? $product->price : '') }}" step="0.01" min="0" required>
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', isset($product) ? $product->quantity : '') }}" min="0" required>
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }}</button>
<a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">Cancel</a>
