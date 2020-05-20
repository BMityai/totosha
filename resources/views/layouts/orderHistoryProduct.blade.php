
<div class="flex mt-2">
    <div class="w-1/4 text-center">
        {{ $product->name }}
    </div>

    <div  class="w-1/5 text-center">
        @if($product->discount > 0)
            <span class="line-through">{{ $product->price }} ₸</span>
        @endif
        {{ $product->discount_price }} ₸
    </div>

    <div class="w-1/6 text-center">
        -{{ $product->discount }} %
    </div>

    <div class="w-1/6 text-center">
        {{ $product->count }}
    </div>

    <div class="w-1/5 text-center">
        @if($product->discount > 0)
            <span class="line-through">{{ $product->price * $product->count }} ₸</span>
        @endif
        {{ $product->discount_price * $product->count }}  ₸
    </div>
</div>
