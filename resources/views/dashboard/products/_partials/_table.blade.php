<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($models as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('dashboard.products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('dashboard.products.destroy', $product) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $models->links() }}
</div>
