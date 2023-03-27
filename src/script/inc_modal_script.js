
// Add  costs modal
let inc_btn = document.getElementById("add_new_inc");
let inc_modal = document.getElementById("inc-modal");
let inc_button = document.getElementById("confirm-inc-btn");

inc_btn.onclick = function() {
    inc_modal.style.display = "block";
}

inc_button.onclick = function() {
    inc_modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == inc_modal) {
        inc_modal.style.display = "none";
    }
}