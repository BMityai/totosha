<div class="mr-2" id="productInMinicartId_{{$productInCart->product->id}}">
    <div class="flex justify-between my-1">
        <div class="w-11/12">
            <div class="productName text-white text-base sm:text-xl">
                {{$productInCart->product->name}}
            </div>
            <p class="countAlert hidden text-red-700 text-sm -mb-4">Количество ограничено</p>
            <div class="countPrice flex justify-between mt-4 ">
                <div class="flex flex-row  h-6 w-24">
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
                        class="rounded countValue bg-white text-black w-24 text-base flex items-center justify-center cursor-default">
                        <span id="miniBasketCount_{{ $productInCart->product->id }}" class="productCount" data-max="{{ $productInCart->product->count }}" data-id="{{ $productInCart->product->id }}">{{ $productInCart->count }}</span>
                    </div>

                    <button onclick="countUp(event)" class="rounded font-semibold text-black bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer">
                        <span class="m-auto text-2xl text-black font-thin leading-none">+</span>
                    </button>
                </div>
                <div class="price w-1/2 text-white text-base sm:text-xl" data-price="{{$productInCart->product->discount_price}}" data-withoutDiscount="{{$productInCart->product->price}}">{{$productInCart->product->discount_price * $productInCart->count}} ₸</div>
            </div>
        </div>
        <div class="deleteProduct w-6 opacity-75 hover:opacity-100">
            <a href="" onclick="addToCart(event)" class="cursor-pointer">
                <img src="{{ asset('images/ico/cart/trash_can.png') }}" data-id="{{ $productInCart->product->id }}" data-event="delete" alt="">
            </a>
        </div>
    </div>
    <hr>
</div>
