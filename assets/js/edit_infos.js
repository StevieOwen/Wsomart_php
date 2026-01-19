let form=document.querySelector("#edit_form");
let formclass=form.className;
let display_form=document.querySelector("#profile");
let theme=document.querySelector("#theme");
let body=document.body;
let edit_btns=document.querySelectorAll('.edit_btn');


display_form.addEventListener('click',(e)=>{
    e.preventDefault();
    form.classList.toggle('hidden');
})

theme.addEventListener('click',(e)=>{
    e.preventDefault();
    
     body.classList.toggle('dark-theme');
})


Array.from(edit_btns).forEach(function(edit_btn){
    edit_btn.addEventListener('click',(e)=>{
        e.preventDefault();

        e.target.previousElementSibling.disabled=!e.target.previousElementSibling.disabled
    })
})