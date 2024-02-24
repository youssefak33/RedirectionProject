function validateForm() {
var password = document.getElementById("signup_pass").value;
var confirmPassword = document.getElementById("confirm_signup_pass").value;
var errorMessage = document.getElementById("error-message");

if (password !== confirmPassword) {
    errorMessage.innerHTML = "Les mots de passe ne correspondent pas.";
    return false;
} else {
    errorMessage.innerHTML = "";
    return true;
}
}