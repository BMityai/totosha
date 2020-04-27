<header>
    <div id="displayOverlay" class="opacity-75 h-full w-full bg-blue-600 absolute z-10">

    </div>
    <div class="bg-blue-600 h-12">
        <div class="container h-full flex justify-between">
            <div class="logo h-full z-10 relative">
                <a href="#" class="h-full inline-block">
                    <img src="{{ asset('images/logos/logo-white-no_bgrnd.png') }}" alt=""
                         class="h-full opacity-75 hover:opacity-100">
                </a>
            </div>
            <div class="rightElements text-right p-2 w-1/2 z-10 ">
                <div class="wishList h-full inline-block">
                    <a href="#" class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100"
                             src="{{ asset('images/ico/header/wish_list.png') }}" alt="">
                        <span class="infoNum absolute z-10 ">21</span>
                        <span class="info absolute bg-white text-white">6</span>
                    </a>
                </div>

                <div class="basket h-full inline-block ml-3">
                    <a href="#" class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100"
                             src="{{ asset('images/ico/header/shopping-bag.png') }}" alt="">
                        <span class="infoNum absolute z-10 ">2</span>
                        <span class="info absolute bg-white text-white">6</span>
                    </a>
                </div>

                <div class="cabinet h-full inline-block ml-3">
                    <a href="#" class="h-full inline-block">
                        <img class="h-full opacity-75 hover:opacity-100"
                             src="{{ asset('images/ico/header/login.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header_main h-12 mt-4">
        <div class="container h-full relative" >
            <div id="menuToggle" class="z-10">
                <input id="sandwichButton" type="checkbox" onchange="menuShow()"/>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <search-component></search-component>
        </div>
    </div>
</header>
