<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Purchase Orders') }}
            </h2>
            <a href="{{ route('orders.create') }}" type="button" class="btn btn-primary">Add Purchase Order</a>
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
                                    <th scope="col">Order No</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Item Total</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Net Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->supplier->supplier_name }}</td>
                                        <td>{{ $order->item_total }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->net_amount }}</td>
                                        <td>
                                            <a class="btn btn-warning float-center"
                                                href="{{ route('orders.export', $order->id) }}"><i
                                                    class="fa fa-download"></i> Export Purchase Order</a>
                                            <a class="btn btn-success float-center"
                                                href="{{ route('orders.print', $order->id) }}"><i
                                                    class="fa fa-download"></i> Print Purchase Order</a>
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
</x-app-layout>
