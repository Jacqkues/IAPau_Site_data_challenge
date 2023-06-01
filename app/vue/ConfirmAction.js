function confirmAction(event) {
    // Prompt the confirmation box
    var result = confirm("Voulez vous vraiment supprimer cet element ?");
  
    // If the user clicks "Cancel" in the confirmation box
    if (result === false) {
      // Cancel the default link behavior
      event.preventDefault();
    }
  }