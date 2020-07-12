<p id="countAlert_{{ $basketProduct->product->id }}" class="hidden text-center text-red-700 text-sm -mb-4">Количество
    ограничено</p>

<div id="mainCartProductContent_{{ $basketProduct->product->id }}" class="block sm:flex my-4 text-base">
    <div class="w-full sm:w-1/2 flex">
        <div class="cartProductImg w-1/4">
            <a href="">
                <img src="{{ asset($basketProduct->product->getMainImage()->path) }}" alt="">
            </a>
        </div>
        <div class="cartProductName w-11/12 p-1 text-lg sm:text-base self-center text-justify sm:text-center">
            <a href="">{{ $basketProduct->product->name }}</a>
        </div>
    </div>
    <div class="w-full sm:w-1/2 flex text-lg text-base sm:text-lg">
        <div class="cartPerProductPrice w-1/3 p-1 self-center text-center">
            <p class="@if($basketProduct->product->discount > 0) line-through text-red-700 text-base @endif ">{{ $basketProduct->product->price }}
                ₸</p>
            @if($basketProduct->product->discount > 0)
                <p>{{ $basketProduct->product->discount_price }} ₸</p>
            @endif
        </div>
        <div class="cartPerProductCount w-1/3 p-1 self-center">
            <div class="flex flex-row  h-6 w-24 mx-auto">
                <button onclick="countDown(event)"
                        class="font-semibold bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer rounded">
                    <span class="m-auto text-2xl text-black font-thin leading-none">-</span>

                </button>
                <input
                    type="hidden"
                    class="md:p-2 p-1 text-xs md:text-base border-gray-400 focus:outline-none text-center"
                    readonly
                    name="custom-input-number"/>
                <div
                    class="rounded  bg-white text-black w-24 text-lg border-2 border-r-2 flex items-center justify-center cursor-default">
                <span id="mainCartProductCount_{{ $basketProduct->product->id }}" class="productCount"
                      data-max="{{ $basketProduct->product->count }}"
                      data-id="{{ $basketProduct->product->id }}">{{ $basketProduct->count }}</span>
                </div>

                <button onclick="countUp(event)"
                        class="rounded font-semibold text-black bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer">
                    <span class="m-auto text-2xl text-black font-thin leading-none">+</span>
                </button>
            </div>
        </div>
        <div id="productInMaincartId_{{ $basketProduct->product->id }}"
             class="cartPerProductTotalPrice w-1/3 p-1 self-center text-center">
            @if($basketProduct->product->discount > 0)
                <p class="withoutDiscountTotalPrice line-through text-base text-red-700 withoutDiscountTotalPrice">{{ $basketProduct->count * $basketProduct->product->price}}
                    ₸</p>
            @endif

            <p class="discountTotalPrice font-semibold">{{ $basketProduct->count * $basketProduct->product->discount_price}}
                ₸</p>
        </div>
        <div class="cartPerProductDelete w-6 self-center ">
        <span href="" onclick="addToCart(event)" class="cursor-pointer">
            <img data-id="{{ $basketProduct->product->id }}" src="{{ asset('images/ico/cart/trash_can_blue.png') }}"
                 data-event="delete" alt="">
        </span>
        </div>
    </div>
</div>
<hr>
