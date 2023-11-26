<x-web-header />
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
                <div class="text-right py-6" style="padding-left:90%">
                    <form action="/clearCart" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-lg btn-outline-danger" name="clearCart"> Clear Cart</button>
                    </form>
                    <?php
                    if (isset($_POST['clearCart'])) {
                        session_unset();
                    }
                    ?>
                </div>
                <hr>
                <!-- Cart Items Go Here -->
                <h1 id="emptyCart"></h1>
                <div id="theCart" class="container"></div>
                
                @if (!empty($lineItems))

                <div class="py-6 container">
                    @foreach($lineItems as $key => $value)
                    @php
                        $product = Product::find($value['product_id']);
                        $linePrice = $value['quantity'] * $product->price;
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

                <div class="text-center" style="margin-top:200px">
                    <a href="index.php#products">
                        <button class="btn btn-lg btn-outline-warning">Keep Shopping</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

<x-disclaimer />
<x-web-footer /> 