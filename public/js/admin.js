function getProductsFilterForm(event) {
    event.preventDefault();
    let form = document.getElementById('productsFilterForm');
    form.classList.toggle('hidden')
}

function getOrdersFilterForm(event) {
    event.preventDefault();
    let form = document.getElementById('ordersFilterForm');
    form.classList.toggle('hidden')
}

