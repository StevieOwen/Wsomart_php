car_btns=document.getElementsByClassName('car-btn');

Array.from(car_btns).forEach(function(car_btn){

    car_btn.addEventListener('click',(e)=>{
        e.preventDefault();
        alert('Create an account or login');
    })
})


// dropdown_but=document.getElementById('dropdown-btn');

// dropdown_menu=document.getElementById('cat-menu');

// but_icon=document.getElementById('but-icon');

// dropdown_but.addEventListener('click',(e)=>{

//     e.preventDefault();

//     dropdown_menu.classList.toggle('hidden');
//     but_icon.src= (but_icon.src.includes("down.png"))?"./assets/icon/caret-arrow-up.png":"./assets/icon/down.png";
// })

document.addEventListener('DOMContentLoaded', function() {
            // // Get current category from URL parameter
            // const urlParams = new URLSearchParams(window.location.search);
            // const currentCategory = urlParams.get('category') || 'all';
            
            // // Set active class based on URL parameter
            // document.querySelectorAll('.category-pill').forEach(pill => {
            //     if (pill.dataset.category === currentCategory) {
            //         pill.classList.add('active');
            //     } else {
            //         pill.classList.remove('active');
            //     }
            // });
            
            // // Category filter functionality
            // document.querySelectorAll('.category-pill').forEach(pill => {
            //     pill.addEventListener('click', function() {
            //         const category = this.dataset.category;
            //         // Redirect to same page with category parameter
            //         window.location.href = '?category=' + category;
            //     });
            // });

        // cat_buttons=document.querySelectorAll(".category-pill");
        // cat_buttons.forEach(function(cat_button){
            
        //     cat_button.addEventListener('click',(e)=>{
        //         // e.preventDefault();
                
        //          cat_buttons.forEach(btn => btn.classList.remove("active"));
        //          cat_button.classList.add("active");
        //     })

        // })

});


