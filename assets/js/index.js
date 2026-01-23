car_btns=document.getElementsByClassName('car-btn');

Array.from(car_btns).forEach(function(car_btn){

    car_btn.addEventListener('click',(e)=>{
        e.preventDefault();
        alert('Create an account or login');
    })
})


dropdown_but=document.getElementById('dropdown-btn');

dropdown_menu=document.getElementById('cat-menu');

but_icon=document.getElementById('but-icon');

dropdown_but.addEventListener('click',(e)=>{

    e.preventDefault();

    dropdown_menu.classList.toggle('hidden');
    but_icon.src= (but_icon.src.includes("down.png"))?"./assets/icon/caret-arrow-up.png":"./assets/icon/down.png";
})