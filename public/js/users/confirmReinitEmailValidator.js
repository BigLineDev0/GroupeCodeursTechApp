// Selectionner les champs du formulaire
const emailInputReinit = document.getElementById('confirmEmailReinit');
const btnSubmitEmailReinit = document.getElementById('btnSubmitConfirmEmailReinit');

// Désactiver le bouton
btnSubmitEmailReinit.disabled = true;

// Permet d'afficher ou masquer le message d'erreur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    // console.log(baliseP);
    if (message) {
        baliseP.textContent = message;
        input.classList.add('is-invalid');
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove('is-invalid');
    }
} 

// Validation de l'email saisi
emailInputReinit.addEventListener("input", () => {
    const email = emailInputReinit.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);
   
    if (emailValidator) 
    {
        showError(emailInputReinit, emailValidator.message);
        checkFormValidaty();
    } else 
    {
        showError(emailInputReinit, "");
        checkFormValidaty();
    }
});


// Activer le bouton Se Connecter si les deux champs sont valides
function checkFormValidaty()
{
    const email = emailInputReinit.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);
    
    if (!emailValidator) {
        btnSubmitEmailReinit.disabled = false;
    } else {
        btnSubmitEmailReinit.disabled = true;
    }
}