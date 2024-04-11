
const checkbox = document.querySelector('.check');
const pass = document.querySelector('.password');
checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
        pass.type = 'text';
    } else {
        pass.type = 'password';
    }
});



