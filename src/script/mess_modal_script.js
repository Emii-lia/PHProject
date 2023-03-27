let modal = document.getElementById("successMessage");

// let btn = document.getElementById("add_ch_btn");

let button = document.getElementById("ok-btn");

 // We want the modal to open when the Open button is clicked

    // We want the modal to close when the OK button is clicked
button.onclick = function() {
modal.style.display = "none";
}
// The modal will close when the user clicks anywhere outside the modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}