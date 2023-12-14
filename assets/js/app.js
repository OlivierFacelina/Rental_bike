let delete_btn = document.querySelectorAll('.btn_delete')
let form_delete = document.querySelector('#form_delete')
console.log(delete_btn);
let student_id = 0;
let buttons = document.querySelectorAll('button');
delete_btn.forEach(btn => {
    btn.addEventListener('click', function () {
        console.log(btn);
        if (this.classList.contains('btn_delete')) {
            confirm('voulez-vous vraiment supprimer cet utilisateur ?')
            student_id = this.dataset.id;
        } else if (this.classList.contains('delete-confirm')) {
            console.log("Oui", `#form_${student_id}`);
            document.querySelector(`#form_${student_id}`).submit();
        }
    }, false)
})
// delete_btn.forEach(btn => {
    
//     btn.addEventListener('click', function (e) => {

//     })
// });