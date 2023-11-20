@php
    use App\Models\Customer;
    use App\Models\Order;
    use App\Models\Product;
    use App\Http\Controllers\ProductController;
    

    $customer = Customer::find($order->customer_id);
  
@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/build/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Order') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="row">

                    <div class="p-6 text-gray-900 col-lg-8" style="padding: 50px">
                        <p><strong>Customer: </strong>{{ $customer->first_name . ' ' . $customer->last_name }}</p>
                        <p><strong>Phone #: </strong>{{$customer->phone_number}} </p>
                        <p><strong>E-mail Address: </strong><a href="mailto:{{$customer->email_address}}" >{{$customer->email_address}} </a></p>
                        <p><strong>Ship To: </strong><br>
                            {{ $order->address_1 }} {{ $order->adress_2 }} <br /> {{ $order->city }},
                            {{ $order->state }} {{ $order->zip_code }}
                        </p>
                    </div>

                    <div class="p-6 col-lg-4">
                        <p><strong>Created at: </strong>{{$order->created_at}}</p><br />
                        <form action="/updateOrder/{{$order->id}}" method="POST">
                            @method('PUT')
                            @csrf
                        <label for="orderStatus" class="form-label">ORDER STATUS</label>
                        <select class="form-select form-select-lg mb-3" name="orderStatus" id="orderStatus"
                            {{ $order->status === 'COMPLETE' ? 'disabled' : '' }}>
                            @foreach (Order::ORDER_STATUS as $status)
                                <option value="{{ $status }}"
                                    {{ $status === $order->status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn" onclick="alert('Order Status Updated!')">Update</button>

                    </form>
                    </div>

                </div>

                <div class="p-6">
                    <h4>Items Ordered</h4><hr>
                    <table style="width:100%">
                        <thead
                            class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
                            <tr>
                                
                                <th class="px-3 py-3">
                                    Item #
                                </th>
                                <th class="px-3 py-3">
                                    Name
                                </th>
                                <th class="px-3 py-3">
                                    Description
                                </th>
                                <th class="px-3 py-3">
                                    Product Price
                                </th>
                                <th class="px-3 py-3">
                                    Quantiy
                                </th>
                                <th>
                                    Line Price
                                </th>
                            </tr>
                        </thead>
                        @foreach($lineItems as $lineItem)
                            <tr>
                                <td class="px-3 py-2 whitespace-no-wrap">{{$lineItem->item_number}}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{$lineItem->name}}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{$lineItem->description}}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">${{number_format($lineItem->product_price, 2)}}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">{{$lineItem->quantity}}</td>
                                <td class="px-3 py-2 whitespace-no-wrap">${{number_format($lineItem->line_price, 2)}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="p-6">
                    <h5><strong>Order Total: </strong>${{number_format($order->amount, 2)}}</h5>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
