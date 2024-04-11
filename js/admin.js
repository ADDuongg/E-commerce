
document.addEventListener('DOMContentLoaded', function () {
    var food = document.querySelector('.food');
    var home = document.querySelector('.home');
    var revenue = document.querySelector('.revenue');
    var statistic = document.querySelector('.data');
    var order = document.querySelector('.order');
    var btnAdd = document.querySelector('.btnAdd');
    var btnAdd_account = document.querySelector('.btnAddAccount');
    var account = document.querySelector('.account');
    console.log(order);
    account.addEventListener('click', function () {
        console.log(123);
        window.location.href = "./account.php";
    });
    order.addEventListener('click', function () {
        console.log(123);
        window.location.href = "../component_old/order.php";
    });
    revenue.addEventListener('click', function () {
        window.location.href = "./revenueadmin.php";
    });
    statistic.addEventListener('click', function () {
        window.location.href = "../component_old/datafood.php";
    });
    home.addEventListener('click', function () {
        window.location.href = "./admin.php";
    })
    food.addEventListener('click', function () {
        /*  aleret(1) */
        window.location.href = "./foodadmin.php";
    })

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            window.location.href = "./addFoodForm.php"
        })
    }





})



