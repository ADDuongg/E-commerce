const input = document.querySelector('.inputsearch');
const input1 = document.querySelector('.inputsearch1');
const resultSearch = document.querySelector('.resultSearch');
const resultSearch1 = document.querySelector('.resultSearch1');
const divfood = document.querySelector('.divfoodsearch');
const divfood1 = document.querySelector('.divfoodsearch1');
const divBarItems = document.querySelectorAll('.linav');
const btnlogin = document.querySelector('.btn_login');
const btnlogin1 = document.querySelector('.btn_login1');
const btn_view_all_menu = document.querySelector('.btn-view-all-menu');
const btnNav = document.querySelector('.btnNav')
const btnHide = document.querySelector('.btnHide')
const divToggle = document.querySelector('.divToggle')

if (btnNav) {
    btnNav.addEventListener('click', function () {
        divToggle.classList.add('showDiv')
    })
}
if (btnHide) {
    btnHide.addEventListener('click', function () {
        divToggle.classList.remove('showDiv')
    })
}

divBarItems.forEach(item => {
    item.addEventListener('click', () => {
        const text = item.textContent.trim().toUpperCase();
        switch (text) {
            case 'HOME':
                window.location.href = "../page.php";
                break;
            case 'OUR MENU':
                window.location.href = "../component/ourMENU.php";
                break;
            case 'ABOUT':
                window.location.href = "../component/about.php";
                break;
            case 'OFFER':
                window.location.href = "../component/offer.php";
                break;
            case 'CONTACT':
                window.location.href = "../component/contact.php";
                break;
            default:
                break;
        }
    });
});

function handleInputFocus(input, resultSearch) {
    input.addEventListener('focus', () => {
        resultSearch.style.display = 'block';
        
    });
}
function handleLogin(btn) {
    if (btn) {
        btn.addEventListener('click', () => {
            window.location.href = "/login.php";
        });
    }
}

handleLogin(btnlogin);
handleLogin(btnlogin1)

handleInputFocus(input, resultSearch);
handleInputFocus(input1, resultSearch1);

function updateDiv(data, divfood) {
    let tmp_html = '';

    data.forEach(item => {
        const price = item['price'];
        const discountedPrice = item['discount_value'] !== '0' ? Number(price - (price * (item['discount_value'] / 100))) : price;
        const priceClass = item['discount_value'] !== 0 ? 'text-danger' : 'text-secondary';

        tmp_html += `
            <div class="d-flex justify-content-start mb-2 p-2 food">
                <div class="" style="flex:3">
                <img src="../foodimage/${item['image']}" alt="" style="height: 8rem; width: 8rem; "></div>
                <div class="d-flex flex-column justify-content-start flex-wrap align-items-start ps-2"  style="flex:7">
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

function handleInput(input, resultSearch, divfood) {
    let inputvalue = '';
    input.addEventListener('input', () => {
        inputvalue = input.value;
        fetch(`../controller_old/searchfood.php?search=${inputvalue}`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateDiv(data, divfood);
            })
            .catch(err => console.log(err));
    });
}

handleInput(input, resultSearch, divfood);
handleInput(input1, resultSearch1, divfood1);

document.addEventListener('click', e => {
    if (!input.contains(e.target) && !resultSearch.contains(e.target) && input) {
        resultSearch.style.display = 'none';
    }
    if (!input1.contains(e.target) && !resultSearch1.contains(e.target) && input1) {
        resultSearch1.style.display = 'none';
    }
});

if (btn_view_all_menu) {
    btn_view_all_menu.addEventListener('click', () => {
        window.location.href = '../component/ourMENU.php';
    });
}


