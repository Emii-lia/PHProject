// Add Church modal
let ch_modal = document.getElementById("my-modal");
let ch_btn = document.getElementById("open_modal");
let ch_button = document.getElementById("add_ch_btn");
let ideglise = document.getElementById("ideglise");
let church = document.getElementById("church");

ch_btn.onclick = function() {
    ch_modal.style.display = "block";
}

ch_button.onclick = function() {
    ch_modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == ch_modal) {
        ch_modal.style.display = "none";
    }
}