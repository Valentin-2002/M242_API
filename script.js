document.addEventListener("DOMContentLoaded", function(event) { 
    // Get Message Windows
    var msg = document.querySelector('#msg');

    // Make Message Window disappear after 3 Seconds of displaying
    window.setTimeout(function(){ 
        msg.style.display = "none";
     }, 3000);
});
  