<x-app-layout>
    <x-slot name="header">
        <style src="/public/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="col-12 d-flex align-items-end flex-column mb-3">
                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="search" id="search"
                            value="{{(isset($_GET['search'])) ? $_GET['search'] : ''}}">
                        </div>
                    </form>
                </div>

                <table class="w-full">
                    <thead
                        class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
                    <tr>
                        <th>&nbsp;</th>
                        <th class="px-3 py-3">
                            First Name
                        </th>
                        <th class="px-3 py-3">
                            Last Name
                        </th>
                        <th class="px-3 py-3">
                            E-Mail Address
                        </th>
                        <th class="px-3 py-3">
                            Phone Number
                        </th>
                        <th class="px-3 py-3">
                            Address
                        </th>
                    </tr>
                    </thead>
                    @foreach ($customers as $customer)
                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-3 py02 whitespace-no-wrap">
                                <a href="/viewCustomer/{{$customer->id}}">
                                    <button class="btn btn-outline-primary">
                                        <i class="now-ui-icons users_single-02"> Customer Details</i>
                                    </button>
                                </a>
                            </td>

                            <td class="px-3 py-2 whitespace-no-wrap text-left">
                                {{ $customer->first_name }}
                            </td>
                            <td class="px-3 py-2 whitespace-no-wrap">
                                {{ $customer->last_name }}
                            </td>
                            <td class="px-3 py-2 whitespace-no-wrap">
                                {{ $customer->email_address }}
                            </td>
                            <td class="px-3 py-2 whitespace-no-wrap">
                                {{ $customer->phone_number }}
                            </td>
                            <td class="px-3 py-2 whitespace-no-wrap">
                                {{$customer->address_1}} {{$customer->address_2}}
                                <br />
                                {{$customer->city}}, {{$customer->state}} {{$customer->zip_code}}
                            </td>
                        </tr>
                    @endforeach

                </table>
                {{ $customers->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
