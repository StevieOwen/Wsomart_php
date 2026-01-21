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

const fieldNames = ['fname', 'lname', 'address', 'phone'];

// 1. On page load: Check if there's "saved" data in localStorage
window.addEventListener('load', () => {
    fieldNames.forEach(name => {
        const savedValue = localStorage.getItem(`draft_${name}`);
        const input = document.querySelector(`input[name="${name}"]`);
        
        // If the user had typed something before, override the PHP value
        if (savedValue !== null) {
            input.value = savedValue;
        }
    });
});

// 2. As the user types: Save the value to localStorage
document.getElementById('edit_form').addEventListener('input', (e) => {
    if (fieldNames.includes(e.target.name)) {
        localStorage.setItem(`draft_${e.target.name}`, e.target.value);
    }
});

document.getElementById('edit_form').addEventListener('submit', function(e) {
    e.preventDefault(); // Stop page reload

    // 1. IMPORTANT: Enable inputs before gathering data
    // Browsers don't "see" disabled fields during form submission
    const inputs = this.querySelectorAll('input[disabled]');
    inputs.forEach(input => input.disabled = false);

    const formData = new FormData(this);
    formData.append('update', 'true'); // Ensure PHP sees the 'update' key

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            alert('Profile updated successfully!');
            // Re-disable inputs after success if desired
            inputs.forEach(input => input.disabled = true);

            fieldNames.forEach(name => localStorage.removeItem(`draft_${name}`));
        
        // Re-disable inputs
        const inputs = document.querySelectorAll('#edit_form input');
        inputs.forEach(input => input.disabled = true);
        } else {
            alert('Something went wrong: ' + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
