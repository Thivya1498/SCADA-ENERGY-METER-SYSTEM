 // Close the modal if the user clicks anywhere outside the modal
 window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}