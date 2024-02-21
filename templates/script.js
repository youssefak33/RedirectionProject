  function validateForm() {
    var password = document.getElementById("motDePasse").value;
    var confirmPassword = document.getElementById("confirmerMotDePasse").value;
    var errorMessage = document.getElementById("error-message");

    if (password !== confirmPassword) {
      errorMessage.innerHTML = "Les mots de passe ne correspondent pas.";
      return false;
    } else {
      errorMessage.innerHTML = "";
      return true;
    }
  }