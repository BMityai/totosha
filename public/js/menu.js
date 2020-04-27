function menuShow() {
    let checkbox = document.getElementById('sandwichButton');
    let menuModal = document.getElementById('displayOverlay');
    if (checkbox.checked === true){
        menuModal.classList.add('showMenu');
    } else {
        menuModal.classList.remove('showMenu');
    }
}






