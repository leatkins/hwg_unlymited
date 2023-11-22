@php
    use App\Models\Customer;
    use App\Models\Order;
    use App\Models\Product;
    use App\Http\Controllers\ProductController;
@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5">
        <div class="content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Sales</h5>
                            <h4 class="card-title">Total Sales</h4>
                            <div class="p-8 text-center">
                                <h1> ${{ $totalSales }}</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Customers</h5>
                            <h4 class="card-title">Total Customers</h4>
                            <div class="p-8 text-center">
                                <h1>{{Customer::all()->count()}}</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Inventory</h5>
                            <h4 class="card-title">Items in Stock</h4>
                            <div class="p-8 text-center">
                                <h1>{{ProductController::getInventoryCount()}}</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        <h3 class="text-center">{{ __('Customer Orders') }}</h3>
                        <hr />

                        <form class="m-3">
                            <label for="exampleFormControlInput1" class="form-label">Order Status</label>
                            <select class="form-select" aria-label="Order Status Selector" id="orderStatus"
                                name="orderStatus" onchange="orderStatusSearch(this.value)">
                                <option value="ALL">:::All Orders:::</option>
                                @php
                                    $selected = '';
                                @endphp
                                @foreach (Order::ORDER_STATUS as $status)
                                    {{ $selected = isset($_GET['orderStatus']) && $_GET['orderStatus'] == $status ? 'selected' : '' }}
                                    <option value="{{ $status }}" {{ $selected }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button type=submit id="hiddenSubmit" style="display:none">Go</button>
                        </form>

                        <table class="w-full">
                            <thead
                                class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th class="px-3 py-3">
                                        Order Status
                                    </th>
                                    <th class="px-3 py-3">
                                        Customer
                                    </th>
                                    <th class="px-3 py-3">
                                        Shipping Address
                                    </th>
                                    <th class="px-3 py-3">
                                        Order Total
                                    </th>
                                    <th class="px-3 py-3">
                                        Created On (UTC)
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($orders as $order)
                                @php
                                    $customer = Customer::find($order->customer_id);

                                @endphp
                                <tr class="border-b border-gray-200 text-sm">
                                    <td class="px-3 py02 whitespace-no-wrap">
                                        <a href="/viewOrder/{{$order->id}}">
                                            <button class="btn btn-outline-primary">
                                                <i class="now-ui-icons shopping_basket"> VIEW ORDER</i>
                                            </button>
                                        </a>
                                    </td>

                                    <td class="px-3 py-2 whitespace-no-wrap text-left">
                                        {{ $order->status }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        {{ $customer->first_name . ' ' . $customer->last_name }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        {{ $order->address_1 . ' ' . $order->address_2 }}
                                        <br />
                                        {{ $order->city . ', ' . $order->state . ' ' . $order->zip_code }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        {{ '$' . number_format($order->amount, 2) }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        {{$order->created_at}}
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $orders->links() }}

                        {{-- @livewire('orders-table-view') --}}
                    </div>

                </div>
            </div>
        </div>
        <script>
            function orderStatusSearch(status) {
                document.getElementById('hiddenSubmit').click();
            }
        </script>

</x-app-layout>
