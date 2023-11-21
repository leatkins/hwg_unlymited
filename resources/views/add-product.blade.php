@php
    use App\Models\Product;
    use App\Http\Controllers\ProductController;

@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/build/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="/add-new-product" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" class="form-control" name="description"/>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Item #</label>
                        <input type="text" id="item_number" class="form-control" name="item_number"/>
                    </div>

                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Category</label>
                        <input type="text" id="category" class="form-control" name="category" list="sets" />
                        <datalist id="sets">
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="inventory_count" class="form-label">Inventory Count</label>
                        <input type="number" id="inventory_count" class="form-control" name="inventory_count" />
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        $ <input type="text" id="price" class="form-control" name="price"  />
                    </div>

                    <div class="position-relative py-2 px-4"> 
                        
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Product Image</label>
                        <input type="file" id="image_url" class="form-control" name="image_url" />
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-secondary" type="submit" > Add New Product</button>

                    </form>
            
                <hr />

            </div>
        </div>
    </div>
</x-app-layout>
