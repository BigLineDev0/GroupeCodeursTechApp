// Selectionner les champs du formulaire
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const btnSubmit = document.getElementById('btnSubmit');

// Désactiver le bouton
btnSubmit.disabled = true;

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
emailInput.addEventListener("input", () => {
    const email = emailInput.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);
   
    if (emailValidator) 
    {
        showError(emailInput, emailValidator.message);
        checkFormValidaty();
    } else 
    {
        showError(emailInput, "");
        checkFormValidaty();
    }
});

// Validation du mot de passe saisi
passwordInput.addEventListener('input', () => {
    const password = passwordInput.value.trim();
    const passwordValidator = Validator.passwordValidator("Le mot de passe", password, 8);

    if (passwordValidator) 
    {
        showError(passwordInput, passwordValidator.message);
        checkFormValidaty();
    } else 
    {
        showError(passwordInput, "");
        checkFormValidaty();
    }
});

// Activer le bouton Se Connecter si les deux champs sont valides
function checkFormValidaty()
{
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    const emailValidator = Validator.emailValidator("L'email", email);
    const passwordValidator = Validator.passwordValidator("Le mot de passe", password, 8);

    if (!emailValidator && !passwordValidator) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
}

// Afficher le message réussie avant redirection
// document.getElementById('loginForm').addEventListener('submit', (event) => {
//     event.preventDefault();

//     Swal.fire({
//         title: "Succès",
//         text: "Connexion réussie",
//         icon: "success",
//         timer: 1000,
//         timerProgressBar: true,
//     }).then(() => {
//         setTimeout(() => { document.getElementById('loginForm').submit(); }, 100);
//     });
// });