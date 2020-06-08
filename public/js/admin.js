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

function editReview() {
    let adminCommentContent = document.getElementById('managerCommentBlock');
    let textareContent = document.getElementById('mytextarea').parentNode.children[3];
    textareContent.style = "display:flex!important; height:300px;"
    adminCommentContent.classList.add('hidden');
    // adminCommentContent.classList.remove('hidden');

}
