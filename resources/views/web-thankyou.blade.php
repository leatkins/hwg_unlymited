@php
    use App\Models\Customer;
    use App\Models\Order;
    $customer = Customer::find($order->customer_id);
@endphp

<x-web-header />
<x-web-styles />

<div class="header-bar"></div>

<main>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="text-center">
                        <h2><strong>THANK YOU!</strong></h2>
                    </div>
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
                        <p><strong>Created at: </strong>{{$order->created_at}}</p>
                        <p><strong>Confirmation: </strong>{{$order->confirmation_number}}</p>
                        <br />
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
</main>


</main>
<x-disclaimer />
<x-web-footer />

