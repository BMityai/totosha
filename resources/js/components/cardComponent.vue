<template>
    <div class="slideCard mt-1 mb-1 rounded max-w-xs pb-2">
        <a href="#">
            <div class="relative">
                <div class="sale">
                    <span>-57 %</span>
                </div>
                <img class="rounded-t" src="http://placehold.it/800x700" alt="">
                <a href="3" class="absolute w-8 bottom-0 right-0 mr-2 mb-2">
                    <img class="rounded-t" src="/images/ico/card/wishlist.png" alt="">
                    <img class="rounded-t absolute top-0" src="/images/ico/card/wishlistAdd.png" alt="">
                </a>
            </div>

            <span class="mt-1 mb-1 block h-12 pl-2 pr-2">LййййLййййLйййй Lйййй Lйййй Lйййй Lйййй Lйййй Lйййй Lйййй LййййLйййй Lйййй йййm</span>
            <div class="text-center font-semibold">
                <span>1234</span> ₸
            </div>
        </a>

        <a href="#"
           class="w-11/12 block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-2 mr-auto ml-auto rounded">
            <span>В КОРЗИНУ</span>
        </a>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>


<style>

    .sale {
        position: absolute;
        background-color: #ed1406;
        width: 30%;
        top: 5px;
        text-align: center;
        border-radius: 0 8px 8px 0;
    }

    .sale span{
        color: white;
        vertical-align: middle;
        display: inline-block;
        width: auto;
        font-weight: 600;
        margin: 4px 0;
    }
</style>
