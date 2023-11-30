<x-web-header />
@php
    $lineItems = session()->get('lineItems');
@endphp
<x-web-styles />


<div class="header-bar"></div>

<main>

    <div class="container">
        @if(isset($_GET['item-added']) && $_GET['item-added'] === 'true')
        <div class="status-message center-img text-center" id="status-message">
            <p>  Item Added to Cart! <br />
                <a href="/cart">
                    <button class="btn btn-warning"><i class="fa-sharp fa-solid fa-cart-shopping"></i> View Cart</button>
                </a>
            </p>
        </div>
        @endif


        <img src="{{asset('assets/img/promo_image3.jpeg')}}"  alt="Products promotional image" class="center-img" />
        <div class="text-center" style="background-color:black; color:whitesmoke; border-radius: 1em">
            <hr />
            <h3 class="py-6">Men's Fragrances &nbsp; &nbsp; &nbsp; * &nbsp; &nbsp; &nbsp; Women's Fragrances &nbsp; &nbsp; &nbsp; * &nbsp; &nbsp; &nbsp; Burning Oils &nbsp; &nbsp; &nbsp;*  &nbsp; &nbsp; &nbsp; Burners  </h3>
        </div>
    </div>

    <div class="container products-start">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight"><u>Products</u></h3>
        <div class="category-start">

            <table width="100%">
                <tr>
                    <td>
                        <form action="">
                            <label for="categorySelection"><strong>Select A Category<strong></label>
                            <select class="form-select" width="50%" name="categorySelection" id="categorySelection" onchange="changeCategory()">
                                <option value="all">All Products....</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category }}" {{isset($_GET['categorySelection']) && $_GET['categorySelection'] === $category->category ? 'selected'  : ''}}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="hidden-button" id="categoryChange" type="submit">Go</button>
                        </form>
                    </td>
                    <td style="padding-left: 20%">
                        <form>
                            <label for="categorySelection"><strong>Search Products<strong></label>
                            <input type="text" class="form-control" name="search"  placeholder="Search"
                                value="{{(isset($_GET['search'])) ? $_GET['search'] : ''}}"/>
                            <button type="submit" class="hidden-button">Search</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>

        <div class="container grid">
            @foreach ($products as $product)
            <div class="card">
                <table width="100%">
                    <tr>
                        <td height="300px">
                            <img src="{{asset('storage/app/'. $product->image_url)}}" alt="Product Image" />
                        </td>

                        <td class="p-4">
                            <form action="/addLineItem/{{$product->id}}" method="POST" />
                            @method('PUT')
                            @csrf
                            <p><strong>{{$product->name}}</strong></p>
                            <p>{{$product->description}}</p><br />
                            <p>QTY <input type="number" min="1" max="{{$product->inventory_count}}" name="quantity"  value="1" /></p>
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight">${{number_format($product->price, 2)}}</h3>
                            <br />

                                <button class="btn btn-warning" type="submit">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
        <div class="p-6">
            {{$products->links()}}
        </div>
    </div>
    <section style="padding:25px;background-color:black;color:white">
		<div class="container">
			<h1>Items also offered - <i>upon request only</i></h1>
			<hr/>
			<div style="margin-left:3%">
				<h4>
					<bi class="bi-check-circle"></bi>&nbsp; Amber Glass Body Oil Spray | 2oz - <span
							style="color:orangered">$14.00</span>
				</h4>

				<h4>
					<bi class="bi-check-circle"></bi>&nbsp; Amber Glass Body Oil Spray | 3oz - <span
							style="color:orangered">$25.00</span>
				</h4>

				<h4>
					<bi class="bi-check-circle"></bi>&nbsp; Body Gel | 3oz - <span
							style="color:orangered">$14.00</span>
				</h4>

				<h4>
					<bi class="bi-check-circle"></bi>&nbsp; Body Wash | 3oz - <span
							style="color:orangered">$11.00</span>
				</h4>
			</div>
			<div class="text-center">
				<h2>For more details...</h2>
				<h4>
					<bi class="bi-phone-vibrate"></bi>
					<span style="color:orangered">Call: </span>(725)-696-2226
				</h4>
				<h4>
					<bi class="bi-envelope-open-fill"></bi>
					<span style="color:orangered">E-mail: </span>
					<a href="mailto:jason@hwg-unlymited.com">jason@hwg-unlymited.com</a>
				</h4>
			</div>
		</div>

	</section>
    <script>
        let clearMessage = setTimeout(hideMessage, 5000);

        function hideMessage() {
            document.getElementById("status-message").style.display = 'none';
        }

        function changeCategory() {
            document.getElementById("categoryChange").click();
        }
    </script>
</main>
<x-disclaimer />
<x-web-footer />



