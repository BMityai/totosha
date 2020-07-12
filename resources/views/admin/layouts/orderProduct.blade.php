
<div id="productInOrder_{{$product->id}}" class="block sm:flex my-4 text-base">
    <div class="w-full sm:w-1/2 flex">
        <div class="cartProductImg w-1/4">
            <a href="">
                <img src="{{ asset($product->product->getMainImage()->path) }}" alt="">
            </a>
        </div>
        <div
            class="cartProductName w-11/12 p-1 text-lg sm:text-base self-center text-justify sm:text-center">
            <a href="">{{ $product->name }}</a>
        </div>
    </div>
    <div class="w-full sm:w-1/2 flex text-lg text-base sm:text-lg">
        <div class="cartPerProductPrice w-1/3 p-1 self-center text-center">
            <p class="@if($product->discount > 0) line-through text-red-700 text-base @endif ">{{ $product->price }}
                ₸</p>
            @if($product->discount > 0)
                <p>{{ $product->discount_price }} ₸</p>
            @endif
        </div>
        <div class="cartPerProductCount w-1/3 p-1 self-center">
            <p class="productCount text-center">{{ $product->count }}</p>

        </div>
        <div class="cartPerProductTotalPrice w-1/3 p-1 self-center text-center">
            @if($product->discount > 0)
                <p class="withoutDiscountTotalPrice line-through text-base text-red-700 withoutDiscountTotalPrice">{{ $product->count * $product->price}}
                    ₸</p>
            @endif

            <p class="discountTotalPrice font-semibold">{{ $product->count * $product->discount_price}}
                ₸</p>
        </div>

    </div>
</div>
