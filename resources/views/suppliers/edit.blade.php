<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Supplier') }}
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
                    <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Supplier name</label>
                            <input type="name" class="form-control" id="exampleInputName" name="supplier_name"
                                value="{{ $supplier->supplier_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputAddress" class="form-label">Address</label>
                            <input type="name" class="form-control" id="exampleInputAddress" name="address"
                                value="{{ $supplier->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTaxNo" class="form-label">TAX No.</label>
                            <input type="name" class="form-control" id="exampleInputTaxNo" name="tax_no"
                                value="{{ $supplier->tax_no }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCountry" class="form-label">Country</label>
                            <select class="form-control" name="country">
                                <option selected>Select a Country</option>
                                <option value="India" {{ 'India' === $supplier->country ? 'selected' : '' }}>India
                                </option>
                                <option value="UAE" {{ 'UAE' === $supplier->country ? 'selected' : '' }}>UAE</option>
                                <option value="Finland" {{ 'Finland' === $supplier->country ? 'selected' : '' }}>Finland
                                </option>
                                <option value="United States"
                                    {{ 'United States' === $supplier->country ? 'selected' : '' }}>United States
                                </option>
                                <option value="Oman" {{ 'Oman' === $supplier->country ? 'selected' : '' }}>Oman
                                </option>
                                <option value="Qatar" {{ 'Qatar' === $supplier->country ? 'selected' : '' }}>Qatar
                                </option>
                                <option value="Ireland" {{ 'Ireland' === $supplier->country ? 'selected' : '' }}>
                                    Ireland
                                </option>
                                <option value="United Kingdom"
                                    {{ 'United Kingdom' === $supplier->country ? 'selected' : '' }}>United Kingdom
                                </option>
                                <option value="Canada" {{ 'Canada' === $supplier->country ? 'selected' : '' }}>Canada
                                </option>
                                <option value="Germany" {{ 'Germany' === $supplier->country ? 'selected' : '' }}>
                                    Germany
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputMobile" class="form-label">Mobile No.</label>
                            <input type="name" class="form-control" id="exampleInputMobile" name="mobile"
                                value="{{ $supplier->mobile }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlEmail" name="email"
                                value="{{ $supplier->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputStatus" class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option selected>Select a Status</option>
                                <option value="Active" {{ 'Active' === $supplier->status ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ 'Inactive' === $supplier->status ? 'selected' : '' }}>
                                    Inactive</option>
                                <option value="Blocked" {{ 'Blocked' === $supplier->status ? 'selected' : '' }}>Blocked
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
