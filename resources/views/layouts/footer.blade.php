<footer>
    <div class="bg-blue-600 mt-16">
        <div class="container">

            <div class="mobileViewContacts pt-1 mb-1 justify-center">
                <a href="#" class="w-1/3">
                    <img src="{{ asset('images/logos/footer_logo.png') }}" alt=""
                         class="opacity-75 hover:opacity-100">
                </a>
                <div class="contacts w-1/2 ">
                    <div class="socialNet flex justify-around h-full items-center">
                        <a href="" class="w-6 opacity-75 hover:opacity-100">
                            <img src="{{ asset('images/ico/contacts/instagram.png') }}" alt="">
                        </a>
                        <a href="" class="w-6 opacity-75 hover:opacity-100">
                            <img src="{{ asset('images/ico/contacts/whatsApp.png') }}" alt="">
                        </a>
                        <a href="" class="w-6 opacity-75 hover:opacity-100">
                            <img src="{{ asset('images/ico/contacts/telegram.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <hr>
            <div class="footerContent flex justify-between pt-2 pb-6 text-white text-base sm:text-xl">
                <div class="leftFooterContent w-1/3 p-1 text-center">
                    <a href="{{ route('getStoreInfo', 'how_to_make_an_order') }}"><p class="opacity-75 hover:opacity-100 mt-1">Помощь</p></a>
                    <a href="{{ route('getStoreInfo', 'payment_and_delivery') }}"><p class="opacity-75 hover:opacity-100 mt-1">Оплата и доставка</p></a>
                    <a href="{{ route('getStoreInfo', 'purchase_returns') }}"><p class="opacity-75 hover:opacity-100 mt-1">Возврат товара</p></a>
                    <a href="{{ route('getStoreInfo', 'wholesales') }}"><p class="opacity-75 hover:opacity-100 mt-1">Оптовикам</p></a>
                </div>

                <div class="centerFooterContent w-1/3 p-1">
                    <a href="#" class=" inline-block">
                        <img src="{{ asset('images/logos/footer_logo.png') }}" alt=""
                             class="opacity-75 hover:opacity-100">
                    </a>
{{--                    <div class="contacts">--}}
{{--                        <div class="socialNet flex justify-around">--}}
{{--                            <a href="" class="w-1/5 sm:w-12">--}}
{{--                                <img src="{{ asset('images/ico/contacts/instagram.png') }}" alt="">--}}
{{--                            </a>--}}
{{--                            <a href="" class="w-1/5 sm:w-12">--}}
{{--                                <img src="{{ asset('images/ico/contacts/whatsApp.png') }}" alt="">--}}
{{--                            </a>--}}
{{--                            <a href="" class="w-1/5 sm:w-12">--}}
{{--                                <img src="{{ asset('images/ico/contacts/telegram.png') }}" alt="">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="rightFooterContent w-1/3 p-1 text-center">
                    <a href="{{ route('getStoreInfo', 'about_us') }}"><p class="opacity-75 hover:opacity-100 mt-1">О нас</p></a>
                    <a href="{{ route('getReviews') }}"><p class="opacity-75 hover:opacity-100 mt-1">Отзывы</p></a>
                    <a href="{{ route('getStoreInfo', 'loyalty_program') }}"><p class="opacity-75 hover:opacity-100 mt-1">Бонусная программа</p></a>
                    <a href="{{ route('getStoreInfo', 'contacts') }}"><p class="opacity-75 hover:opacity-100 mt-1">Контакты</p></a>

                </div>

            </div>

        </div>
    </div>

</footer>
