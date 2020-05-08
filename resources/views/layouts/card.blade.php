<div class="slideCard mt-1 mb-1 rounded max-w-xs pb-2">

    <a class="outline-none" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">
        <div class="relative">
            <div class="sale">
                @if($product->discount > 0)
                    <span>-{{ $product->discount }} %</span>
                @endif
            </div>
            <img class="rounded-t" src="http://placehold.it/800x700" alt="">
            <span onclick="wishList(event)" href="3" class="absolute w-8 bottom-0 right-0 mr-2 mb-2">
                <img class="rounded-t" src="{{ asset('/images/ico/card/wishlist.png') }}" alt="">
                <img class="rounded-t absolute top-0 opacity-0 z-20" src="{{ asset('/images/ico/card/wishlistAdd.png') }}" alt="">
            </span>
        </div>

        <span class="cartProductName mt-1 mb-1 block h-12 pl-2 pr-2">{{ $product->name }}</span>
        <div class="text-center font-semibold">
            <span class=" @if($product->discount > 0) opacity-75 line-through	@endif">{{ $product->price }} ₸</span>
            @if($product->discount > 0) <span>{{ $product->discount_price }} ₸</span> @endif
        </div>
    </a>
    @if($product->count > 0 && !$product->coming_soon)
        <a href="#" onclick="addToCart(event)"
           class="w-11/12 block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-2 mr-auto ml-auto rounded outline-none">
            В КОРЗИНУ
        </a>
    @endif
    @if($product->count == 0 && !$product->coming_soon)
        <a
            class="w-11/12 block text-center bg-gray-500 p-2 mt-2 mr-auto ml-auto rounded outline-none">
            Нет в наличии
        </a>
    @endif
    @if($product->count == 0 && $product->coming_soon)
        <a
            class="w-11/12 block text-center bg-red-500 py-2 mt-2 mr-auto ml-auto rounded outline-none">
            Скоро в продаже
        </a>
    @endif
</div>
