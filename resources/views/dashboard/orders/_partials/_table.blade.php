<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($models as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>
                    <span class="badge badge-{{ $order->status->color() }}">
                        {{ $order->status->label() }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-secondary">
                        {{ $order->type->label() }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('dashboard.orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No orders found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $models->links() }}
</div>
