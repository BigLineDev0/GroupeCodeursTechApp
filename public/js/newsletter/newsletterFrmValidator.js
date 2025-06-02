
    // Récuperation des champs du formulaire
    const emailNewsletterInput = document.getElementById('email-newsletter');
    const frmNewsletter = document.getElementById('newsletterForm');
    const btnNewsletterSubmit = frmNewsletter.querySelector('button[type="submit"]');

    // Désactiver le bouton Ajouter
    btnNewsletterSubmit.disabled = true;

    // Permet d'afficher ou masquer le message d'erreur
    function showError(input, message)
    {
        const baliseP = input.nextElementSibling;
        // console.log(baliseP);
        if (message) {
            baliseP.textContent = message;
            input.classList.add('is-invalid');
            baliseP.style.color = 'brown';
            baliseP.style.fontWeight = 'bold';
        }
        else
        {
            baliseP.textContent = "";
            input.classList.remove('is-invalid');
        }
    } 

    

    // Validation du champ email à la saisie
    emailNewsletterInput.addEventListener('input', () => {
        const emailNewsletter = emailNewsletterInput.value.trim();
        const emailNewsletterValidator = Validator.emailValidator("L'email", emailNewsletter);

        if (emailNewsletterValidator) 
        {
            showError(emailNewsletterInput, emailNewsletterValidator.message);
            
        } else 
        {
            showError(emailNewsletterInput, "");
        }

        checkFormValidaty();
    });

    // Activer le bouton si les champs sont valides
    function checkFormValidaty()
    {
      
        const emailNewsletter = emailNewsletterInput.value.trim();
        const isEmailNewsletterValid = Validator.emailValidator("L'email", emailNewsletter) == null;
        
        if(isEmailNewsletterValid){
            btnNewsletterSubmit.removeAttribute("disabled");
        }
        
    }
