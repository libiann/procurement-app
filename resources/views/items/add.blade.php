<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Item') }}
            </h2>
        </div>
    </x-slot>

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
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Item name</label>
                            <input type="name" class="form-control" id="exampleInputName" name="item_name"
                                value="{{ old('item_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputLocation" class="form-label">Inventory Location</label>
                            <input type="name" class="form-control" id="exampleInputLocation"
                                name="inventory_location" value="{{ old('inventory_location') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputBrand" class="form-label">Brand</label>
                            <input type="name" class="form-control" id="exampleInputBrand" name="brand"
                                value="{{ old('brand') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCategory" class="form-label">Category</label>
                            <input type="name" class="form-control" id="exampleInputCategory" name="category"
                                value="{{ old('category') }}">
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
                        <div class="mb-3">
                            <label for="exampleInputStockUnit" class="form-label">Stock Unit</label>
                            <select class="form-control" name="stock_unit">
                                <option selected>Select a Stock Unit</option>
                                <option value="Piece" {{ 'Piece' === old('stock_unit') ? 'selected' : '' }}>Piece
                                </option>
                                <option value="Kilogram" {{ 'Kilogram' === old('stock_unit') ? 'selected' : '' }}>
                                    Kilogram</option>
                                <option value="Gram" {{ 'Gram' === old('stock_unit') ? 'selected' : '' }}>Gram
                                </option>
                                <option value="Milliliter" {{ 'Milliliter' === old('stock_unit') ? 'selected' : '' }}>
                                    Milliliter</option>
                                <option value="Liter" {{ 'Liter' === old('stock_unit') ? 'selected' : '' }}>Liter
                                </option>
                                <option value="Meter" {{ 'Meter' === old('stock_unit') ? 'selected' : '' }}>Meter
                                </option>
                                <option value="Centimeter" {{ 'Centimeter' === old('country') ? 'selected' : '' }}>
                                    Centimeter
                                </option>
                                <option value="Dozen" {{ 'Dozen' === old('stock_unit') ? 'selected' : '' }}>Dozen
                                </option>
                                <option value="Bundle" {{ 'Bundle' === old('stock_unit') ? 'selected' : '' }}>Bundle
                                </option>
                                <option value="Roll" {{ 'Roll' === old('stock_unit') ? 'selected' : '' }}>Roll
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputprice" class="form-label">Unit Price</label>
                            <input type="name" class="form-control" id="exampleInputprice" name="unit_price"
                                value="{{ old('unit_price') }}">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Item Images</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="images[]" multiple
                                accept="image/png, image/jpeg, image/gif, image/svg+xml" onchange="previewImages()">
                        </div>

                        <!-- Image preview section -->
                        <div id="imagePreview" class="d-flex flex-wrap"></div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages() {
            var preview = document.getElementById('imagePreview');
            var files = document.getElementById('formFileMultiple').files;

            preview.innerHTML = ''; // Clear previous previews

            if (files) {
                Array.from(files).forEach(function(file) {
                    if (file.type.match('image.*')) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.maxWidth = '150px';
                            img.style.margin = '10px';
                            preview.appendChild(img);
                        }

                        reader.readAsDataURL(file);
                    }
                });
            }
        }
    </script>
</x-app-layout>
