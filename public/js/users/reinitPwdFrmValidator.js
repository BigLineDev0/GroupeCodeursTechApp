    // Récuperation des champs du formulaire
    const newPasswordReinit = document.getElementById('new_password_reinit');
    const confirmPasswordReinit = document.getElementById('confirm_password_reinit');
    const btnSubmitReinit = document.getElementById('btnSubmitReinit');

    // Désactiver le bouton
    // btnSubmitReinit.disabled = true;

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

    // Validation du nouveau mot de passe
    newPasswordReinit.addEventListener('input', () => {
        const newPasswordReinitValue = newPasswordReinit.value.trim();
        const newPasswordReinitValidator = Validator.passwordValidator("Le nouveau mot de passe", newPasswordReinitValue, 8);

        if (newPasswordReinitValidator) 
        {
            showError(newPasswordReinit, newPasswordReinitValidator.message);
            
        } else 
        {
            showError(newPasswordReinit, "");
        }
    });

    // Validation du mot de passe de confirmation
    confirmPasswordReinit.addEventListener('input', () => {
        const confirmPasswordReinitValue = confirmPasswordReinit.value.trim();
        const confirmPasswordReinitValidator = Validator.passwordValidator("Le mot de passe de confirmation", confirmPasswordReinitValue, 8);

        if (confirmPasswordReinitValidator) 
        {
            showError(confirmPasswordReinit, confirmPasswordReinitValidator.message);
            
        } 
        else if (confirmPasswordReinitValue != newPasswordReinit.value.trim()) 
        {
            showError(confirmPasswordReinit, "Les deux mot de passe ne sont pas conformes.");
            
        } else 
        {
            showError(confirmPasswordReinit, "");
        }
    });


    // Activer le bouton Se Connecter si les deux champs sont valides
    function checkFormValidaty()
    {
        const newPasswordReinitValue = newPasswordReinit.value.trim();
        const confirmPasswordReinitValue = confirmPasswordReinit.value.trim();

       const newPasswordReinitValidator = Validator.passwordValidator("Le nouveau mot de passe", newPasswordReinitValue, 8);
       const confirmPasswordReinitValidator = Validator.passwordValidator("Le mot de passe de confirmation", confirmPasswordReinitValue, 8);
        
        if (!newPasswordReinitValidator && !confirmPasswordReinitValidator) {
            btnSubmitReinit.disabled = false;
        } else {
            btnSubmitReinit.disabled = true;
        }
    }