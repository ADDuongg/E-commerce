document.addEventListener('DOMContentLoaded', function () {
    function redirectTo(page) {
        window.location.href = page;
    }

    function addClickListener(element, page) {
        if (element) {
            element.addEventListener('click', function () {
                redirectTo(page);
            });
        }
    }

    var elements = [
        {selector: '.food', page: './foodadmin.php'},
        {selector: '.home', page: './admin.php'},
        {selector: '.revenue', page: './revenueadmin.php'},
        {selector: '.data', page: '../component_old/datafood.php'},
        {selector: '.order', page: '../component_old/order.php'},
        {selector: '.btnAdd', page: './addFoodForm.php'},
        {selector: '.account', page: './account.php'},
        {selector: '.food1', page: './foodadmin.php'},
        {selector: '.home1', page: './admin.php'},
        {selector: '.revenue1', page: './revenueadmin.php'},
        {selector: '.data1', page: '../component_old/datafood.php'},
        {selector: '.order1', page: '../component_old/order.php'},
        {selector: '.btnAdd1', page: './addFoodForm.php'},
        {selector: '.account1', page: './account.php'}
    ];

    elements.forEach(function (item) {
        var element = document.querySelector(item.selector);
        addClickListener(element, item.page);
    });
});
