let res_num = 0;
let buttons_modal = document.querySelectorAll('button');
buttons_modal.forEach(btn => {
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
// let delete_btn = document.querySelector('.btn_delete')
// console.log(delete_btn);
let user_id = 0;
let buttons = document.querySelectorAll('button');
buttons.forEach(btn => {
    btn.addEventListener('click', function () {
        console.log(btn);
        if (this.classList.contains('btn_delete')) {
            user_id = this.dataset.id;
        } else if (this.classList.contains('delete-confirm')) {
            console.log("Oui", `#form_${user_id}`);
            document.querySelector(`#form_${user_id}`).submit();
        }
    }, false)
})
// delete_btn.forEach(btn => {
    
//     btn.addEventListener('click', function (e) => {

//     })
// });
