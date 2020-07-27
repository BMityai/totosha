<div id="productCard_{{ $product->id }}" class="slideCard mt-1 mb-1 rounded max-w-xs pb-2">
    <a class="outline-none" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">
        <div class="relative">
            <div class="sale">
                @if($product->discount > 0)
                    <span>-{{ $product->discount }} %</span>
                @endif
            </div>
            @if(!is_null($product->getMainImage()))
                <img class="rounded-t" src="{{ asset($product->getMainImage()->path) }}" alt="">
            @else
                <img class="rounded-t" src="{{ asset('/images/default.png') }}" alt="">
            @endif

            <span onclick="wishList(event)" href="3" class="absolute w-8 bottom-0 right-0 mr-2 mb-2">
                <img class="rounded-t" src="{{ asset('/images/ico/card/wishlist.png') }}" alt="">
                <img class="rounded-t absolute top-0 @if($product->getIfInTheWishList->isNotEmpty()) opacity-100 @else opacity-0 @endif z-20" src="{{ asset('/images/ico/card/wishlistAdd.png') }}" data-id="{{ $product->id }}"  alt="">
            </span>
        </div>

        <span class="cartProductName mt-1 mb-1 block h-12 pl-2 pr-2">{{ $product->name }}</span>
        <div class="text-center font-semibold">
            <span class=" @if($product->discount > 0) opacity-75 line-through	@endif">{{ $product->price }} ₸</span>
            @if($product->discount > 0) <span>{{ $product->discount_price }} ₸</span> @endif
        </div>
    </a>
    @if($product->count > 0 && !$product->coming_soon)
        <a href="{{ route('addToBasket') }}" onclick="addToCart(event)" id="addButtonToBasket_{{ $product->id }}" data-id="{{ $product->id }}"
           class="@if($product->getIfInTheBasket->isNotEmpty()) hidden @else block @endif w-11/12 block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-2 mr-auto ml-auto rounded outline-none">
            В КОРЗИНУ
        </a>
        <a href="{{ route('addToBasket') }}" onclick="addToCart(event)" id="removeButtonFromCart_{{ $product->id }}" data-csrf="{{ csrf_token() }}" data-id="{{ $product->id }}"
           class="@if($product->getIfInTheBasket->isNotEmpty()) block @else hidden @endif addCartButton w-11/12 block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-2 mr-auto ml-auto rounded outline-none">
            В КОРЗИНЕ
        </a>
    @endif
    @if($product->count == 0 && !$product->coming_soon)
        <a
            class="w-11/12 block text-center bg-gray-500 p-2 mt-2 mr-auto ml-auto rounded outline-none">
            Нет в наличии
        </a>
    @endif
    @if($product->coming_soon)
        <a
            class="w-11/12 block text-center bg-red-500 py-2 mt-2 mr-auto ml-auto rounded outline-none">
            Скоро в продаже
        </a>
    @endif
</div>
