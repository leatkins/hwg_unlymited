@php
    use App\Models\Customer;
    use App\Models\Order;
    use App\Models\Product;
    use App\Http\Controllers\ProductController;

@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/build/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    @if(isset($_GET['notActive']))
    <div class="py-6" id="statusMessage">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span><b> <i class="now-ui-icons ui-1_check"></i> Success - </b>Deactivated {{$_GET['notActive']}} </span>
              </div>
        </div>
    </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/add-product">
            <button class="btn btn-primary"> <i class="now-ui-icons ui-1_simple-add"></i> Add New Product </button>
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="row">
                    <div class="col-4 flex align-items-start">
                        <form action="">
                            <label for="productCategory">Category</label>
                            <select class="form-select form-select-lg mb-3" name="productCategory" id="productCategory"
                                onchange="clickFilter()">
                                <option value="ALL-PRODUCTS">ALL PRODUCTS</option>

                                @foreach ($categories as $object)
                                    <option
                                        {{ isset($_GET['productCategory']) && $_GET['productCategory'] === $object->category ? 'selected' : '' }}>
                                        {{ $object->category }}</option>
                                @endforeach

                            </select>
                            <button type="submit" id="filter" style="display:none">Filter</button>
                        </form>
                    </div>

                    <div class="col-4">&nbsp;</div>

                    <div class="col-4 d-flex align-items-end flex-column mb-3">
                        <form action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" name="search" id="search"> &nbsp;
                            </div> 
                        </form>
                    </div>
                </div>


                <hr />
                @foreach ($products as $product)
                @if($product->active === 1)
                    <div class="card mx-6 my-6" style="width: 18rem;">
                        <img src="{{ asset('storage/app/' . $product->image_url) }}" height="100%" class="card-img-top"
                            alt="product image">
                        <div class="card-body">
                            <p><small> <strong>{{ $product->category }}</strong> | {{ $product->item_number }}</small>
                            </p>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p>${{ number_format($product->price, 2) }}</p>
                            <strong>QTY In Stock:</strong> {{$product->inventory_count}} &nbsp;
                            <a href="/edit-product/{{$product->id}}" class="btn btn-primary">Edit <i
                                    class="now-ui-icons ui-2_settings-90"></i></a>
                        </div>
                    </div>
                @endif
                @endforeach

                <div>{{ $products->links() }}</div>

            </div>
        </div>
    </div>
    <script>
        function clickFilter() {
            document.getElementById('filter').click()
        }
    </script>

<script>
    let hideMessage =setTimeout(hide, 5000); 

    function hide() {
        document.getElementById('statusMessage').style.display =  'none'; 
        clearTimeout(hidemMessage); 
    }
</script>
</x-app-layout>
