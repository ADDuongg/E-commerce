var home = document.querySelector('.home')
var menu = document.querySelector('.menu')
var about = document.querySelector('.about')
var offer = document.querySelector('.offer')
var contact = document.querySelector('.contact')
var btnlogin = document.querySelector('.btn_login')
var btn_view_all_menu = document.querySelector('.btn-view-all-menu')
const input = document.querySelector('.inputsearch');
const resultSearch = document.querySelector('.resultSearch');
var divfood = document.querySelector('.divfoodsearch')
input.addEventListener('focus', function () {
    resultSearch.style.display = 'block';
    console.log(123);
});

function updateDiv(data) {
    var tmp_html = '';

    data.forEach(item => {
        var price = item['price'];
        var discountedPrice = item['discount_value'] !== '0' ? Number(price - (price * (item['discount_value'] / 100))) : price;

        var priceClass = item['discount_value'] !== 0 ? 'text-danger' : 'text-secondary'; // Kiểm tra giảm giá và áp dụng class

        tmp_html += `
            <div class="d-flex justify-content-start mb-2 p-2 food">
                <img src="../foodimage/${item['image']}" alt="" style="height: 80px; width: 130px; flex: 4">
                <div class="d-flex flex-column justify-content-between flex-wrap align-items-start ps-2" style="flex: 6">
                    <p style="color: black; font-weight:bold">${item['name']}</p>
                    <div class="d-flex justify-content-between" style="width: 100%;">
                        <p class="${priceClass}" style="font-weight:bold">Giá tiền: $ ${discountedPrice.toFixed(2)}</p>
                        <a href="../component/detailfood.php?id=${item['id']}&&type=${item['type']}" class="btn btn-success btnaddfood" style="width: 65px; height: 40px; text-decoration:none; color: white"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        `;
    });

    divfood.innerHTML = tmp_html;
}


var inputvalue = ''
input.addEventListener('input', function () {
    inputvalue = input.value
    fetch(`../controller_old/searchfood.php?search=${inputvalue}`)
        .then(res => res.json())
        .then(data => {
            console.log(data)
            updateDiv(data)
        })
        .catch(err => console.log(err))
})
document.addEventListener('click', function (e) {
    if (!input.contains(e.target) && !resultSearch.contains(e.target) && input) {
        resultSearch.style.display = 'none';
    }
});
if (btn_view_all_menu) {
    btn_view_all_menu.addEventListener('click', function () {
        window.location.href = '../component/ourMENU.php'
    })
}
home.addEventListener('click', function () {
    window.location.href = "../component/page.php"
})
menu.addEventListener('click', function () {
    window.location.href = "../component/ourMENU.php"
})
about.addEventListener('click', function () {
    window.location.href = "../component/about.php"
})
offer.addEventListener('click', function () {
    window.location.href = "../component/offer.php"
})
contact.addEventListener('click', function () {
    window.location.href = "../component/contact.php"
})

if(btnlogin){
    btnlogin.addEventListener('click', function () {
        window.location.href = "../login.php";
    })
}