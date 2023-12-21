let res_num = 0;
let buttons = document.querySelectorAll('button');
buttons.forEach(btn => {
    btn.addEventListener('click', function () {
        if (this.classList.contains('delete')) {
            res_num = this.dataset.res_num;
        } else if (this.classList.contains('delete-confirm')) {
            let formSelector = `#form_${res_num}`
            let form = document.querySelector(formSelector);
            // document.querySelector(`#form_${res_num}`).submit();
            if (form) {
                form.submit();
            } else {
                console.error(`Form not found: ${formSelector}`);
            }
        }
    }, false)
});