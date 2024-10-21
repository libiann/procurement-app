<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Purchase Order') }}
            </h2>
        </div>
    </x-slot>

    <style>
        .hidden {
            display: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputDate" class="form-label">Order Date</label>
                            <input class="date form-control" type="text" name="order_date"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputSupplier" class="form-label">Supplier</label>
                            <select class="form-control" name="supplier_id">
                                <option selected>Select a Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 repeatable-data">
                            <!-- Cloneable Item Details Section -->
                            <div class="item-details-section">
                                <div class="mb-3">
                                    <label for="exampleInputItem" class="form-label">Item</label>
                                    <select class="form-control item-dropdown" name="item_id[]">
                                        <option selected>Select an Item</option>
                                        @foreach ($items as $index => $item)
                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="hidden item-details">
                                    <div class="mb-3">
                                        <label for="exampleInputNo" class="form-label">Item No</label>
                                        <input type="text" class="form-control item_no" id="item_no_1"
                                            name="item_no[]" readonly="readonly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputName" class="form-label">Item Name</label>
                                        <input type="text" class="form-control item_name" id="item_name_1"
                                            name="item_name[]" readonly="readonly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputStockUnit" class="form-label">Stock Unit</label>
                                        <input type="text" class="form-control stock_unit" id="item_stock_unit_1"
                                            name="stock_unit[]" readonly="readonly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPrice" class="form-label">Unit Price</label>
                                        <input type="text" class="form-control unit_price" id="item_unit_price_1"
                                            name="unit_price[]" readonly="readonly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPackingUnit" class="form-label">Packing Unit</label>
                                        <select class="form-control" id="item_packing_unit_1" name="packing_unit[]">
                                            <option selected>Select a Packing Unit</option>
                                            <option value="Pieces">Pieces</option>
                                            <option value="Boxes">Boxes</option>
                                            <option value="Packs">Packs</option>
                                            <option value="Cartons">Cartons</option>
                                            <option value="Pallets">Pallets</option>
                                            <option value="Bags">Bags</option>
                                            <option value="Rolls">Rolls</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputQty" class="form-label">Order Qty</label>
                                        <input type="number" class="form-control order_qty" id="order_qty_1"
                                            name="order_qty[]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputAmount" class="form-label">Item Amount</label>
                                        <input type="number" class="form-control item_amount" name="item_amount[]"
                                            id="item_amount_1" value="{{ old('item_amount') }}" readonly="readonly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputDiscount" class="form-label">Discount</label>
                                        <input type="text" class="form-control discount" name="discount[]"
                                            id="discount_1" value="{{ old('discount') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputAmount" class="form-label">Net Amount</label>
                                        <input type="number" class="form-control net_amount" name="net_amount[]"
                                            id="net_amount_1" value="{{ old('net_amount') }}" readonly="readonly">
                                    </div>
                                    <div class="add-remove-items actions col-sm-2">
                                        <div class="form-group">
                                            <div class="controls">
                                                <br />
                                                <button type="button" class="btn btn-danger remove"
                                                    style="display: none;">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="add-remove-items actions col-sm-2 mb-4">
                            <button type="button" id="clone" class="btn btn-success">Add More</button>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputTotal" class="form-label">Item Total</label>
                            <input type="number" class="form-control item_total" name="item_total"
                                value="{{ old('item_total') }}" readonly="readonly">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputDiscount" class="form-label">Discount</label>
                            <input type="number" class="form-control net_discount" name="net_discount"
                                value="{{ old('net_discount') }}" readonly="readonly">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputNetAmount" class="form-label">Net Amount</label>
                            <input type="number" class="form-control total_net_amount" name="total_net_amount"
                                value="{{ old('total_net_amount') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Item selection and details fetching
            $(document).on('change', '.item-dropdown', function() {
                var itemId = $(this).val();
                var itemDetailsSection = $(this).closest('.item-details-section').find('.item-details');

                if (itemId) {
                    $.ajax({
                        url: '/get-item-details/' + itemId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                // Show the hidden item details section
                                itemDetailsSection.removeClass('hidden');

                                itemDetailsSection.find('.item_no').val(data.item_no);
                                itemDetailsSection.find('.item_name').val(data.item_name);
                                itemDetailsSection.find('.stock_unit').val(data.stock_unit);
                                itemDetailsSection.find('.unit_price').val(data.unit_price);
                                itemDetailsSection.find('.order_qty').val(
                                    ''); // Reset qty and amounts
                                itemDetailsSection.find('.discount').val('');
                                itemDetailsSection.find('.item_amount').val('');
                                itemDetailsSection.find('.net_amount').val('');
                                // Set the packing unit from the server or a default if needed
                                itemDetailsSection.find('.packing_unit').val(data
                                    .packing_unit || '');
                            } else {
                                // Reset fields if no data is returned
                                itemDetailsSection.find(
                                    '.item_no, .item_name, .stock_unit, .unit_price').val(
                                    '');
                            }
                        }
                    });
                } else {
                    itemDetailsSection.find('.item_no, .item_name, .stock_unit, .unit_price').val('');
                    itemDetailsSection.addClass('hidden');
                }
            });

            // Function to calculate totals
            function calculateTotals() {
                let totalItemAmount = 0;
                let totalNetAmount = 0;
                let totalDiscount = 0;

                // Iterate through each item details section to calculate totals
                $('.item-details-section').each(function() {
                    let orderQty = parseFloat($(this).find('.order_qty').val()) || 0;
                    let unitPrice = parseFloat($(this).find('.unit_price').val()) || 0;
                    let discount = parseFloat($(this).find('.discount').val()) || 0;

                    // Calculate item amount for the current line item
                    let itemAmount = orderQty * unitPrice;
                    $(this).find('.item_amount').val(itemAmount.toFixed(2)); // Update item amount field

                    // Calculate net amount for the current line item
                    let netAmount = itemAmount - discount;
                    $(this).find('.net_amount').val(netAmount.toFixed(2)); // Update net amount field

                    // Accumulate totals
                    totalItemAmount += itemAmount; // Total of all items
                    totalNetAmount += netAmount; // Total net amount after discount
                    totalDiscount += discount; // Total discounts
                });

                // Update the total fields
                $('.item_total').val(totalItemAmount.toFixed(2)); // Total amount of items
                $('.net_discount').val(totalDiscount.toFixed(2)); // Total discount amount
                $('.total_net_amount').val(totalNetAmount.toFixed(2)); // Total net amount
            }

            // Auto calculate Item Amount and Net Amount
            $(document).on('input', 'input[name="order_qty[]"], input[name="discount[]"]', function() {
                calculateTotals(); // Recalculate totals on input change
            });

            // Clone functionality for adding more line items
            $('#clone').click(function() {
                let newItemDetailsSection = $('.item-details-section').first().clone();
                newItemDetailsSection.find('input').val(''); // Reset input fields
                newItemDetailsSection.find('.item_no').val('');
                newItemDetailsSection.find('.item_name').val('');
                newItemDetailsSection.find('.stock_unit').val('');
                newItemDetailsSection.find('.unit_price').val('');
                newItemDetailsSection.find('.item_amount').val('');
                newItemDetailsSection.find('.net_amount').val('');
                newItemDetailsSection.find('.item-dropdown').prop('selectedIndex',
                    0); // Reset select options
                newItemDetailsSection.find('.item-details').addClass(
                    'hidden'); // Hide details for new section
                newItemDetailsSection.find('.remove').show(); // Show remove button for the new line item
                $('.repeatable-data').append(newItemDetailsSection); // Append new line item section
            });

            // Remove functionality for individual line items
            $(document).on('click', '.remove', function() {
                if ($('.repeatable-data').children().length > 1) {
                    $(this).closest('.item-details-section').remove(); // Remove current line item section
                    calculateTotals(); // Recalculate totals after removing an item
                }
            });
        });
    </script>
</x-app-layout>
