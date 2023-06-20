// Enable form validation
(function() {
  'use strict';
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function(form) {
    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();

$(document).ready(function () {
  $('#table').DataTable();
});

function deleteService(itemId) {
  if (confirm("Are you sure you want to delete this item?")) {
      // Make an AJAX request to the PHP script for deleting the item
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "delete.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
              // Item deleted successfully, refresh the page or perform any other action
              
              location.reload();
          }
      };
      xhr.send("item_id=" + itemId);
  }
}

function deleteOrg(org) {
  if (confirm("Are you sure you want to delete this item?")) {
      // Make an AJAX request to the PHP script for deleting the item
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "delete.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
              // Item deleted successfully, refresh the page or perform any other action
              
              location.reload();
          }
      };
      xhr.send("org=" + org);
  }
}