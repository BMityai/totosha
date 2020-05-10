<template>
    <div class="mr-2">
    <div class="flex justify-between my-1">
        <div class="w-11/12">
        <div class="productName text-white text-base sm:text-xl">
            {{ this.name }}
        </div>
            <p v-if='no_in_stock' class="text-red-700 text-sm">Количество ограничено</p>
        <div class="countPrice flex justify-between mt-4 ">
                <div class="flex flex-row  h-6 w-24">
                    <button @click="countDown()"
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
                        <span>{{ this.count}}</span>
                    </div>

                    <button @click="countUp()"
                        class="rounded font-semibold text-black bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer">
                        <span class="m-auto text-2xl text-black font-thin leading-none">+</span>
                    </button>
                </div>
            <div class="price w-1/2 text-white text-base sm:text-xl">{{ this.totalPriceForProduct }} ₸</div>
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
        data: () => ({
            count:1,
            no_in_stock:false,
            totalPriceForProduct:0,
        }),
        methods: {
            setupPriceData(){
                this.totalPriceForProduct = this.price
            },
            countUp(){
                let productTotalCount = this.count
                if(this.count < this.count_in_stock){
                    productTotalCount = this.count += 1;
                } else {
                    this.no_in_stock = true;
                }
                this.totalPriceForProduct = productTotalCount * this.price
                this.totalPriceCalculate();
            },

            countDown(){
                let productTotalCount = this.count
                if(this.count > 1){
                    productTotalCount = this.count -= 1;
                }
                this.totalPriceForProduct = productTotalCount * this.price
                this.totalPriceCalculate();
            },

            totalPriceCalculate(){
                setTimeout(function () {
                    let cartTotalPrice = 0;
                let totalPriceContent = document.getElementById('cartTotalPrice');
                let totalPriceElements = [].slice.call(document.getElementsByClassName('price'));
                totalPriceElements.forEach((element) => {
                    cartTotalPrice += parseInt(element.textContent.split(' ')[0]);
                })
                totalPriceContent.textContent = cartTotalPrice;
                }, 100);
            }

        },
        mounted(){
            this.setupPriceData()
            this.totalPriceCalculate()
        },
        watch: {

        },
        props: [
            'csrf',
            'name',
            'price',
            'id',
            'count_in_stock'
        ],
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
