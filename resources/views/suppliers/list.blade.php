<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Suppliers') }}
            </h2>
            <a href="{{ route('suppliers.create') }}" type="button" class="btn btn-primary">Add Supplier</a>
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
                                    <th scope="col">Supplier No</th>
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">TAX No</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Mobile No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $index => $supplier)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>{{ $supplier->tax_no }}</td>
                                        <td>{{ $supplier->country }}</td>
                                        <td>{{ $supplier->mobile }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->status }}</td>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                class="btn btn-primary  btn-sm m-2">Edit</a>
                                            <div class="col-sm">
                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                    method="post">
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
