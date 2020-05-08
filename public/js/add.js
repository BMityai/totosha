// menu modal
function menuShow() {
    let body = document.body;
    let span1 = document.getElementById('sandwich_1')
    let span2 = document.getElementById('sandwich_2')
    let span3 = document.getElementById('sandwich_3')
    let menuModal = document.getElementById('displayOverlayMenu');
    if (menuModal.classList.contains('showMenu')) {
        window.scrollTo(0, body.dataset.scrollY)
        menuModal.classList.remove('showMenu');
        body.classList.remove('overflowStop')
        span3.classList.remove('forSandwichAllSpan')
        span2.classList.remove('forSandwichSecondSpan')
        span1.classList.remove('forSandwichThirdSpan')
    } else {
        body.dataset.scrollY = window.pageYOffset;
        menuModal.classList.add('showMenu');
        body.classList.add('overflowStop')
        span3.classList.add('forSandwichAllSpan')
        span2.classList.add('forSandwichSecondSpan')
        span1.classList.add('forSandwichThirdSpan')
    }
}


// cabinet modal
function cabinetMenuShow() {
    let cabinetModal = document.getElementById('displayOverlayCabinet');
    cabinetModal.classList.toggle("showCabinetMenu");
}

// cabinet modal close listener
document.addEventListener('click', outsideClickCabinetListener)

function outsideClickCabinetListener(event) {
    let cabinetModal = document.getElementById('displayOverlayCabinet');
    let button = document.getElementById('cabinetId');
    if (!cabinetModal.contains(event.target) && cabinetModal.classList.contains('showCabinetMenu') && !button.contains(event.target)) {
        cabinetModal.classList.remove('showCabinetMenu');
    }
}

// cart modal
function cartShow() {
    let wishlistModal = document.getElementById('displayOverlayCart');
    wishlistModal.classList.toggle("showCabinetMenu");
}

// cart modal close listener
document.addEventListener('click', outsideClickCartListener)

function outsideClickCartListener(event) {
    let cartModal = document.getElementById('displayOverlayCart');
    let button = document.getElementById('cartId');
    if (!cartModal.contains(event.target) && cartModal.classList.contains('showCabinetMenu') && !button.contains(event.target)) {
        cartModal.classList.remove('showCabinetMenu');
    }
}

// add product to cart (button & modal)
function addToCart(event) {
    event.preventDefault();
    let button = event.target;
    let modal = document.getElementById('displayOverlayAddToCart')
    let cartInfo = document.getElementById('cartInfoNum')
    let cartInfoNum = cartInfo.textContent;
    if (button.classList.contains('addCartButton')) {
        button.text = 'В КОРЗИНУ';
        button.classList.remove('addCartButton')
        modal.innerText = 'Товар успешно удален'
        cartInfo.textContent = parseInt(cartInfoNum) - 1;
    } else {
        button.text = 'ДОБАВЛЕН';
        button.classList.add('addCartButton');
        modal.innerText = 'Товар успешно добавлен'
        cartInfo.textContent = parseInt(cartInfoNum) + 1;
    }
    modal.classList.add('showInfo');
    setTimeout(function () {
        modal.classList.remove('showInfo');
    }, 1000)
}

// price filter show
function showPriceFilter() {
    let price = document.getElementById('sidePrice');
    let submitButton = document.getElementById('filterSubmitButton');
    price.classList.add('showFilterBlog');
    submitButton.classList.add('showFilterBlog');

    let showButton = document.getElementById('showFilter');
    let product = document.getElementById('sideProduct');
    let sort = document.getElementById('sideSort');
    showButton.classList.add('hiddenSortBlog');
    product.classList.add('hiddenSortBlog');
    sort.classList.add('hiddenSortBlog');
}

// wishlist add and remove on card
function wishList(event) {
    event.preventDefault();
    let wishlistButton = event.target;
    let wishlist = document.getElementById('wishlistInfoNum');
    let wishlistInfo = wishlist.textContent;
    let modal = document.getElementById('displayOverlayAddToWishList')

    if (wishlistButton.classList.contains('opacity-0')) {
        wishlistButton.classList.remove('opacity-0');
        wishlist.textContent = parseInt(wishlistInfo) + 1;
        modal.innerText = 'Добавлен в Wish List'

    } else {
        wishlistButton.classList.add('opacity-0');
        wishlist.textContent = parseInt(wishlistInfo) - 1;
        modal.innerText = 'Удален из Wish List'
    }

    modal.classList.add('showInfo');
    setTimeout(function () {
        modal.classList.remove('showInfo');
    }, 1000)
}

// wishlist add and remove on productPage
function wishlistProductPage(event) {
    event.preventDefault();
    let wishlistButton = event.target;
    let wishlist = document.getElementById('wishlistInfoNum');
    let wishlistInfo = wishlist.textContent;
    let modal = document.getElementById('displayOverlayAddToWishList')

    if (wishlistButton.classList.contains('addCartButton')) {
        wishlistButton.classList.remove('addCartButton');
        wishlist.textContent = parseInt(wishlistInfo) - 1;
        modal.innerText = 'Удален из Wish List'
        wishlistButton.text = 'В ИЗБРАННОЕ';
    } else {
        wishlistButton.classList.add('addCartButton');
        wishlist.textContent = parseInt(wishlistInfo) + 1;
        modal.innerText = 'Добавлен в Wish List'
        wishlistButton.text = 'В ИЗБРАННОМ';
    }

    modal.classList.add('showInfo');
    setTimeout(function () {
        modal.classList.remove('showInfo');
    }, 1000)
}

function showReviewForm(event) {
    event.preventDefault();
    let button = event.target;
    let form = document.getElementById('reviewForm');
    if(form.classList.contains('hidden')){
        form.classList.remove('hidden');
        button.text = 'Скрыть форму'
    } else {
        form.classList.add('hidden');
        button.text = 'Оставить отзыв'
    }
}




