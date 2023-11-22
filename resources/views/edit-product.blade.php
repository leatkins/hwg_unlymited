@php
    use App\Models\Product;
    use App\Http\Controllers\ProductController;

@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    @if(isset($_GET['status']) && $_GET['status'] === 'success')
    <div class="py-6" id="statusMessage">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span><b> <i class="now-ui-icons ui-1_check"></i> Success - </b>Product Updated</span>
              </div>
        </div>
    </div>
    @endif
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="/update-product/{{$product->id}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $product->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" class="form-control" name="description"
                            value="{{ $product->description }}" />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Item #</label>
                        <input type="text" id="item_number" class="form-control" name="item_number"
                            value="{{ $product->item_number }}" />
                    </div>

                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Category</label>
                        <input type="text" id="category" class="form-control" name="category" list="sets"
                            placeholder="{{ $product->category }}" />
                        <datalist id="sets">
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="inventory_count" class="form-label">Inventory Count</label>
                        <input type="number" id="inventory_count" class="form-control" name="inventory_count" value="{{$product->inventory_count}}" />
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        $ <input type="text" id="price" class="form-control" name="price" value="{{number_format($product->price, 2)}}" />
                    </div>

                    <div class="position-relative py-2 px-4">
                        <p>Current Image</p>
                        <img src="{{ asset('storage/app/' . $product->image_url) }}" width=100px alt="Current Image" />

                    <div class="mb-3">
                        <label for="image_url" class="form-label">Product Image</label>
                        <input type="file" id="image_url" class="form-control" name="image_url" />
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-secondary" > Update Product</button>

                    </form>
                    <form action="/deactivate-product/{{$product->id}}" method="POST">
                        @method('PUT')
                        @csrf
                    <button class="btn btn-danger" type="submit"><i class="now-ui-icons ui-1_simple-remove"></i> Delete Product</button>
                    </form>
                <hr />

            </div>
        </div>
    </div>
    <script>
        let hideMessage =setTimeout(hide, 5000);

        function hide() {
            document.getElementById('statusMessage').style.display =  'none';
            clearTimeout(hidemMessage);
        }
    </script>
</x-app-layout>
