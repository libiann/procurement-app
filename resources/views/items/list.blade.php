<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Items') }}
            </h2>
            <a href="{{ route('items.create') }}" type="button" class="btn btn-primary">Add Item</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Item No</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Inventory Location</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Stock Unit</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->inventory_location }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->supplier->supplier_name }}</td>
                                        <td>{{ $item->stock_unit }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="btn btn-primary  btn-sm m-2">Edit</a>
                                            <div class="col-sm">
                                                <form action="{{ route('items.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-delete btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            var form = $(this).parents("form");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    </script>
</x-app-layout>
