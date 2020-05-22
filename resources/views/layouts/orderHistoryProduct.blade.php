<div class="sm:flex mt-4 sm:mt-2">
    <div class="w-full sm:w-1/4 text-center self-center">
        {{ $product->name }}
    </div>
    <div class="flex w-full sm:w-3/4 mt-2">
        <div class=" w-1/3 text-center self-center">
            @if($product->discount > 0)
                <p class="line-through text-red-700">{{ $product->price }} ₸</p>
            @endif
            {{ $product->discount_price }} ₸
        </div>

        <div class="w-1/6 sm:w-1/4 text-center self-center">
            @if($product->discount)
                -{{ $product->discount }} %
            @else
                -
            @endif
        </div>

        <div class="w-1/6 sm:w-1/4 text-center self-center">
            {{ $product->count }}
        </div>

        <div class="w-1/3 text-center self-center">
            @if($product->discount > 0)
                <p class="line-through text-red-700">{{ $product->price * $product->count }} ₸</p>
            @endif
            {{ $product->discount_price * $product->count }} ₸
        </div>
    </div>
</div>
<hr>
