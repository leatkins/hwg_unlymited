<x-app-layout>
    <x-slot name="header">
        <style src="/public/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer View') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4><strong></strong> {{$customer->first_name}} {{$customer->last_name}}</h4>
                <a href="mailto:{{$customer->email_address}}">{{$customer->email_address}}</a>
                <p>{{$customer->phone_number}}</p>
                <p>{{$customer->address_1}} {{$customer->addres_2}}
                    <br />
                    {{$customer->city}}, {{$customer->state}} {{$customer->zip_code}}
                </p>

                <div class="text-center py-2">
                    <h4>Order History</h4>
                </div>

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
            </div>
        </div>
    </div>
</x-app-layout>
