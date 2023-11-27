<x-web-header />
<script src="https://www.paypal.com/sdk/js?client-id=AUmSN7a1kL3_OxZ3-1jkvope1uPNgRDvAn1_4EGOvgAYjDXdmLcMEHpP1K12lOG6dFvMufFNGwa8LYnM&currency=USD"></script>
<x-web-styles />
<div class="header-bar"></div>

@php
use App\Models\Product;
$lineItems = session()->get('lineItems'); 
    $subTotal = 0;
    $handlingFee = 5.99;
    $taxRate = 0.081;
@endphp

<main id="main">

    <!-- Shopping Cart -->
    <section style="margin-top:75px;background-color:white" id="cart">
        <div class="container-fluid">
            <div class="container-lg">
                <div class="section-title" data-aos="zoom-out">
                    <h2>Shopping</h2>
                    <p>Cart</p>

                </div>

                <div class="container-sm text-center">
                    <img src="assets/web_img/coverAd_HWG.png" width="35%" alt="Promotional Image"/>
                </div>
                <div class="py-6 text-right">
                    <a href="./products">
                        <button class="btn btn-lg btn-outline-warning" style="float:left">Keep Shopping</button>
                    </a>
                    <form action="/clearCart" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-lg btn-outline-danger" name="clearCart"> Clear Cart</button>
                    </form>
                  
                </div>
                <hr>
                
                @if (!empty($lineItems))

                <div class="py-6 container">
                    @foreach($lineItems as $key => $value)
                    @php
                        $product = Product::find($value['product_id']);
                        $linePrice = $value['quantity'] * $product->price;
                        $subTotal = $linePrice + $subTotal; 
                    @endphp
                    <div class="card my-6 p-6">
                        <table width="100%">
                            <tr>
                                <form action="/removeItem/{{$key}}" method="POST" > 
                                    @method('PUT')
                                    @csrf
                                    <td><button class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button> <br />QTY: {{$value['quantity']}}</td>
                                </form> 
                                <td><img src="{{asset('storage/app/'. $product->image_url)}}" alt="Product Image" width="75px" /></td>
                                <td>
                                    <strong>{{$product->name}}</strong>
                                    <p>{{$product->description}}</p>
                                    <p>${{number_format($product->price, 2)}}</p>
                                </td>
                                <td>
                                    <strong>${{number_format($linePrice, 2)}}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
    
                </div>
                
                @else
                    <h1 class="text-center py-6"><strong>Cart is empty</strong></h1>
                @endif

                <div class="py-6" >
                <hr />
                </div>
                @if(!empty($lineItems))
                <div class="text-right"> 
                    <p>Sub-Total: &nbsp; <strong>${{number_format($subTotal, 2)}}</strong></p>
                    <p>Shipping &amp; Handling: &nbsp; ${{number_format($handlingFee, 2)}}</p>
                    @php
                        $tax = $subTotal * $taxRate;
                        $totalCost = $tax + $handlingFee + $subTotal;
                        $payPalTotal = str_replace('.', '', number_format($totalCost, 2))
                    @endphp
                    <p>Tax: &nbsp; ${{number_format($tax, 2)}}
                    <p>Amout Due: &nbsp; <strong>${{number_format($totalCost, 2)}}</strong></p>
                    <input type="number" id="payPalGrandTotal" value="{{$payPalTotal}}" style="display:none" />
                </div> 

                <div style="display:none">
                    <form action="/completePayment" method="POST"> 
                        @method('PUT')
                        @csrf
                        <textarea name="orderData" id="pay-pal-info"></textarea>
                        <button type="submit" id="submitOrder">Submit</button>
                    </form>
                </div>
                <div class="container py-6" style="margin-top: 20px; margin-left:15%; margin-right:15%; padding-right:50px">
                    <div  id="paypal-button-container"></div>

                    <script>
                        paypal.Buttons({

                            // Sets up the transaction when a payment button is clicked
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: document.getElementById('payPalGrandTotal').value // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                        }
                                    }]
                                });
                            },

                            // Finalize the transaction after payer approval
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(orderData) {
                                    // Successful capture! For dev/demo purposes:
                                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                    document.getElementById('pay-pal-info').value = JSON.stringify(orderData); 
                                    document.getElementById("submitOrder").click(); 

                                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                                    // When ready to go live, remove the alert and show a success message within this page. For example:
                                    // var element = document.getElementById('paypal-button-container');
                                    // element.innerHTML = '';
                                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                    // Or go to another URL:  actions.redirect('thank_you.html');
                                });
                            }
                        }).render('#paypal-button-container');

                    </script>
                

                </div>
                @endif
            </div>
        </div>
    </section>

<x-disclaimer />
<x-web-footer /> 