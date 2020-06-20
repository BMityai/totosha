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
}

function calculanteWithDiscountPrice(event) {
    let discountValue = event.target.value;
    let priceWithDiscount = document.getElementById('priceWithDiscount');
    let price = document.getElementById('price');
    if(price.value.length !== 0 && discountValue > 0 && discountValue < 100){
        let finishPrice = price.value - price.value * discountValue / 100;
        priceWithDiscount.value = Math.round(finishPrice);
    }
}

function deleteImg(event) {
    event.preventDefault();
    let imgId = event.target.dataset.id;
    let uri = event.target.parentNode.href;
    let deleteBlock = event.target.parentNode.parentNode;
    let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    axios.post(uri, {
        'imageId': imgId,
        'X-CSRF-TOKEN': csrf_token
    }).then(response => {
        if (response.status === 200) {
            deleteBlock.remove();
        }
    });
}

function changeMainImg(event) {
    event.preventDefault();
    let newMainImg = event.target;
    let imgId = newMainImg.dataset.id;
    let uri = event.target.parentNode.href;
    let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.post(uri, {
        'imageId': imgId,
        'X-CSRF-TOKEN': csrf_token
    }).then(response => {
        if (response.status === 200) {
            if (response.data.oldMainImgId !== null){
                let oldMainImg = document.getElementById('productImg_' + response.data.oldMainImgId);
                oldMainImg.classList.remove('bg-green-700');
                oldMainImg.classList.add('bg-indigo-700');
                oldMainImg.textContent = 'На главную'
            }
            newMainImg.classList.remove('bg-indigo-700');
            newMainImg.classList.add('bg-green-700');
            newMainImg.textContent = 'На главной'
        }
    });
}
