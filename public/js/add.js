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
    totalPriceCalculate();
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
    let operation = '';
    if (button.tagName === 'A') {
        operation = showModalAndChangeButton(button);
    } else {
        operation = 'delete';
    }
    //axios send request
    let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let uri = document.querySelector('meta[name="uri"]').getAttribute('content');
    let product_id = button.dataset.id;
    axios.post(uri, {
        'productId': product_id,
        'X-CSRF-TOKEN': csrf_token
    }).then(response => {
        if (response.status === 200) {
            if (operation === 'add') {
                addMiniCartComponentToMiniCartItemsContent(response.data);
            }
            if (operation === 'delete') {
                deleteMiniCartComponentToMiniCartItemsContent(product_id);
            }
            changeCartInfoNum();
            totalPriceCalculate()

        } else {
            modal.innerText = 'Ошибка... Что-то пошло не так...'
            modal.classList.add('bg-red-700')
        }
    })

    modal.classList.add('showInfo');
    setTimeout(function () {
        modal.classList.remove('showInfo');
    }, 1000)
}

function deleteMiniCartComponentToMiniCartItemsContent(product_id) {
    let miniCartItemsContent = document.getElementById('productInMinicartId_' + product_id);
    let modal = document.getElementById('displayOverlayAddToCart')
    let cartInfo = document.getElementById('cartInfoNum')
    let cartInfoNum = cartInfo.textContent;
    let button = document.getElementById('removeButtonFromCart_' + product_id);
    let secondButton = document.getElementById('addButtonToBasket_' + product_id);
    miniCartItemsContent.remove()
    modal.classList.remove('bg-green-400');
    button.text = 'В КОРЗИНУ';
    button.classList.remove('addCartButton');
    secondButton.text = 'В КОРЗИНУ';
    secondButton.classList.remove('addCartButton');
    modal.classList.add('bg-red-500');
    cartInfo.textContent = parseInt(cartInfoNum) - 1;
    modal.innerText = 'Товар успешно удален';
    modal.classList.add('showInfo');

    setTimeout(function () {
        modal.classList.remove('showInfo');
    }, 1000)
}

function addMiniCartComponentToMiniCartItemsContent(product) {
    let miniCartItemsContent = document.getElementById('miniCartItemsContent');
    miniCartItemsContent.insertAdjacentHTML('beforeEnd', getMiniCartItemHtml(product))
}

function getMiniCartItemHtml(product) {
    return '<div class="mr-2" id="productInMinicartId_' + product.id + '">\n' +
        '    <div class="flex justify-between my-1">\n' +
        '        <div class="w-11/12">\n' +
        '            <div class="productName text-white text-base sm:text-xl">\n' +
        product.name +
        '            </div>\n' +
        '            <p class="countAlert hidden text-red-700 text-sm -mb-4">Количество ограничено</p>\n' +
        '            <div class="countPrice flex justify-between mt-4 ">\n' +
        '                <div class="flex flex-row  h-6 w-24">\n' +
        '                    <button onclick="countDown(event)"\n' +
        '                            class="font-semibold bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer rounded">\n' +
        '                        <span class="m-auto text-2xl text-black font-thin leading-none">-</span>\n' +
        '\n' +
        '                    </button>\n' +
        '                    <input\n' +
        '                        type="hidden"\n' +
        '                        class="md:p-2 p-1 text-xs md:text-base border-gray-400 focus:outline-none text-center"\n' +
        '                        readonly\n' +
        '                        name="custom-input-number"/>\n' +
        '                    <div\n' +
        '                        class="rounded countValue bg-white text-black w-24 text-base flex items-center justify-center cursor-default">\n' +
        '                        <span data-max="' + product.count + '" data-id="' + product.id + '" class="productCount">1</span>\n' +
        '                    </div>\n' +
        '\n' +
        '                    <button onclick="countUp(event)" class="rounded font-semibold text-black bg-white hover:opacity-75 text-white border-gray-400 h-full w-20 flex focus:outline-none cursor-pointer">\n' +
        '                        <span class="m-auto text-2xl text-black font-thin leading-none">+</span>\n' +
        '                    </button>\n' +
        '                </div>\n' +
        '                <div class="price w-1/2 text-white text-base sm:text-xl" data-price="'+ product.price +'">' + product.price + ' ₸</div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="deleteProduct w-6 opacity-75 hover:opacity-100">\n' +
        '            <span  class="cursor-pointer" onclick="addToCart(event)">\n' +
        '                <img src="images/ico/cart/trash_can.png" alt="" data-id="' + product.id + '">\n' +
        '            </span>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <hr>\n' +
        '</div>'
}

function showModalAndChangeButton(button) {
    let modal = document.getElementById('displayOverlayAddToCart')
    let cartInfo = document.getElementById('cartInfoNum')
    let cartInfoNum = cartInfo.textContent;

    if (button.classList.contains('addCartButton')) {
        return 'delete';
    } else {
        modal.classList.remove('bg-red-500')
        button.text = 'В КОРЗИНЕ';
        button.classList.add('addCartButton');
        cartInfo.textContent = parseInt(cartInfoNum) + 1;
        modal.classList.add('bg-green-400');
        modal.innerText = 'Товар успешно добавлен'
        return 'add';
    }
}

function changeCartInfoNum() {
    let cartInfoBgrnd = document.getElementById('cartInfoBgrnd');
    let cartInfo = document.getElementById('cartInfoNum');
    let cartInfoNum = cartInfo.textContent;
    if (parseInt(cartInfoNum) < 1 && !cartInfo.classList.contains('hidden')) {
        cartInfoChangeToNotVisible(cartInfo, cartInfoBgrnd);
    }

    if (parseInt(cartInfoNum) > 0 && !cartInfo.classList.contains('block')) {
        cartInfoChangeToVisible(cartInfo, cartInfoBgrnd);
    }
}

function cartInfoChangeToVisible(cartInfo, cartInfoBgrnd) {
    let cartContent = document.getElementById('notEmptyCart');
    let emptyCartContent = document.getElementById('emptyCart');

    cartContent.classList.remove('hidden');
    cartContent.classList.add('block');
    emptyCartContent.classList.remove('block');
    emptyCartContent.classList.add('hidden');

    cartInfo.classList.remove('hidden');
    cartInfo.classList.add('block');
    cartInfoBgrnd.classList.remove('hidden');
    cartInfoBgrnd.classList.add('block');
}

function cartInfoChangeToNotVisible(cartInfo, cartInfoBgrnd) {
    let cartContent = document.getElementById('notEmptyCart');
    let emptyCartContent = document.getElementById('emptyCart');

    cartContent.classList.remove('block');
    cartContent.classList.add('hidden');
    emptyCartContent.classList.remove('hidden');
    emptyCartContent.classList.add('block');

    cartInfo.classList.remove('block');
    cartInfo.classList.add('hidden');
    cartInfoBgrnd.classList.remove('block');
    cartInfoBgrnd.classList.add('hidden');

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
        modal.classList.remove('bg-red-500')
        wishlistButton.classList.remove('opacity-0');
        wishlist.textContent = parseInt(wishlistInfo) + 1;
        modal.classList.add('bg-green-400')
        modal.innerText = 'Добавлен в Wish List'

    } else {
        modal.classList.remove('bg-green-400')
        wishlistButton.classList.add('opacity-0');
        wishlist.textContent = parseInt(wishlistInfo) - 1;
        modal.classList.add('bg-red-500')
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
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        button.text = 'Скрыть форму'
    } else {
        form.classList.add('hidden');
        button.text = 'Оставить отзыв'
    }
}

function filteredProducts() {
    let form = document.getElementById('filterForm');
    form.submit();
}

function sideFilteredProducts() {
    let form = document.getElementById('sideFilterForm');
    form.submit();
}

//show product full img
function showProductFullImg(event) {
    let img = event.target.src;
    let body = document.body;
    let modal = document.getElementById('productFullImgModal');
    let modalImg = document.getElementById('productFullImg');
    modal.classList.toggle('showProductFullImg');
    body.classList.toggle('overflowStop');
    modalImg.src = img;
}

//count up mini cart product
function countUp(event) {
    let button = event.target;
    let input = button.closest('div').querySelector('.productCount');
    let maxValue = input.dataset.max;
    let productId = input.dataset.id;
    let value = parseInt(input.textContent);
    let alertEl = document.getElementById('productInMinicartId_' + productId).querySelector('.countAlert')

    if (parseInt(input.textContent) < parseInt(maxValue)) {
        value += 1;
        countChangeResponse(productId, value);
        input.textContent = value;
        editPerProductPrice(button);
        totalPriceCalculate();
    } else {
        alertEl.classList.remove('hidden')
    }
}

//count down mini cart product
function countDown(event) {
    let button = event.target;
    let input = button.closest('div').querySelector('.productCount');
    let productId = input.dataset.id;
    let value = parseInt(input.textContent);
    let alertEl = document.getElementById('productInMinicartId_' + productId).querySelector('.countAlert');

    if (parseInt(input.textContent) > 1) {
        value -= 1;
        countChangeResponse(productId, value);
        input.textContent = value;
        editPerProductPrice(button);
        totalPriceCalculate();
        if(!alertEl.classList.contains('hidden')){
            alertEl.classList.add('hidden')
        }
    }
}

//axios send count
function countChangeResponse(productId, count) {
    let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let uri = document.querySelector('meta[name="count_uri"]').getAttribute('content');
    axios.post(uri, {
        'productId': productId,
        'count': count,
        'X-CSRF-TOKEN': csrf_token
    }).then(response => {
        if (response.status === 200) {
            return response.data.count
        } else {
            return null;
        }
    })
}

function editPerProductPrice(button) {
    let count = button.closest('div').querySelector('.productCount').textContent;
    let id = button.closest('div').querySelector('.productCount').dataset.id;
    let price = document.getElementById('productInMinicartId_' + id).querySelector('.price');
    let intPrice = parseInt(price.dataset.price);
    price.textContent = parseInt(count) * intPrice + ' ₸';
}

function totalPriceCalculate() {
        let cartTotalPrice = 0;
        let totalPriceContent = document.getElementById('cartTotalPrice');
        let totalPriceElements = [].slice.call(document.getElementsByClassName('price'));
        totalPriceElements.forEach((element) => {
            cartTotalPrice += parseInt(element.textContent.split(' ')[0]);
        })
        totalPriceContent.textContent = cartTotalPrice + ' ₸';
}



