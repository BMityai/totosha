
// menu modal
function menuShow() {
    let body = document.body;
    let checkbox = document.getElementById('sandwichButton');
    let menuModal = document.getElementById('displayOverlayMenu');
    if (checkbox.checked === true){
        body.dataset.scrollY = window.pageYOffset;
        menuModal.classList.add('showMenu');
        document.body.classList.add('overflowStop')
    } else {
        menuModal.classList.remove('showMenu');
        document.body.classList.remove('overflowStop')
        window.scrollTo(0, body.dataset.scrollY)
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
    if(!cabinetModal.contains(event.target) && cabinetModal.classList.contains('showCabinetMenu') && !button.contains(event.target)){
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
    if(!cartModal.contains(event.target) && cartModal.classList.contains('showCabinetMenu') && !button.contains(event.target)){
        cartModal.classList.remove('showCabinetMenu');
    }
}





