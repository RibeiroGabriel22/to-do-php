var modal = document.querySelector('.modal');
var btn = document.querySelector('.btn');
var span = document.querySelector('.close');

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.classList.add('fade-in');
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.classList.remove('fade-in');
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.classList.remove('fade-in');
  }
}
