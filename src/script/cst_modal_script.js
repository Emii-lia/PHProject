// Add costs modal
let cst_btn = document.getElementById("add_new_cst");
let cst_modal = document.getElementById("cost-modal");
let cst_button = document.getElementById("confirm-cst-btn");

cst_btn.onclick = function() {
    cst_modal.style.display = "block";
}

cst_button.onclick = function() {
    cst_modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == cst_modal) {
        cst_modal.style.display = "none";
    }
}