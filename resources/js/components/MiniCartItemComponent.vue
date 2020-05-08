<template>
    <div class="mr-2">
    <div class="flex justify-between my-1">
        <div class="w-11/12">
        <div class="productName text-white text-base sm:text-xl">
            weqwefassgasdfa
        </div>
        <div class="countPrice flex justify-between mt-4 ">
                <div class="flex flex-row  h-6 w-24">
                    <button
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
                        <span>22</span>
                    </div>

                    <button
                        class="rounded font-semibold text-black bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer">
                        <span class="m-auto text-2xl text-black font-thin leading-none">+</span>
                    </button>
                </div>
            <div class="price w-1/2 text-white text-base sm:text-xl">123 ₸</div>
        </div>
        </div>
        <div class="deleteProduct w-6 opacity-75 hover:opacity-100">
            <a href="">
            <img :src=" '/images/ico/cart/trash_can.png' " alt="">
            </a>
        </div>
    </div>
        <hr>
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
    .count {
        color: #fff;
        text-align: center;
    }

    .count button {
        background-color: #fff;
        color: #000;
    }

    .price {
        text-align: end;
    }

    .countValue {
        border-left: solid 2px #3182ce;
        border-right: solid 2px #3182ce;
    }

    .deleteProduct {
        align-self: center;
    }

</style>
