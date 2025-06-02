
    // Récuperation des champs du formulaire
    const nomInput = document.getElementById('nom');
    const emailInput = document.getElementById('email');
    const sujetInput = document.getElementById('sujet');
    const messageInput = document.getElementById('message');
    const frmContact = document.getElementById('contactForm');
    const btnSubmit = frmContact.querySelector('button[type="submit"]');

    // Désactiver le bouton Ajouter
    btnSubmit.disabled = true;

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

    // Validation du champ nom à la saisie
    nomInput.addEventListener('input', () => {
        const nom = nomInput.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

        if (nomValidator) 
        {
            showError(nomInput, nomValidator.message);
            
        } else 
        {
            showError(nomInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ email à la saisie
    emailInput.addEventListener('input', () => {
        const email = emailInput.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) 
        {
            showError(emailInput, emailValidator.message);
            
        } else 
        {
            showError(emailInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ sujet à la saisie
    sujetInput.addEventListener('input', () => {
        const sujet = sujetInput.value.trim();
        const sujetValidator = Validator.nameValidator("Le sujet", 5, 30, sujet);

        if (sujetValidator) 
        {
            showError(sujetInput, sujetValidator.message);
            
        } else 
        {
            showError(sujetInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ message à la saisie
    messageInput.addEventListener('input', () => {
        const message = messageInput.value.trim();
        const messageValidator = Validator.nameValidator("Le message", 5, 500, message);

        if (messageValidator) 
        {
            showError(messageInput, messageValidator.message);
            
        } else 
        {
            showError(messageInput, "");
        }

        checkFormValidaty();
    });
    
    // Activer le bouton Ajouter si les champs sont valides
    function checkFormValidaty()
    {
        const nom = nomInput.value.trim();
        const email = emailInput.value.trim();
        const sujet = sujetInput.value.trim();
        const message = messageInput.value.trim();
       
        const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
        const isEmailValid = Validator.emailValidator("L'email", email) == null;
        const isSujetValid = Validator.nameValidator("Le sujet", 5, 30, sujet) == null;
        const isMessageValid = Validator.nameValidator("Le message", 5, 500, message) == null;

        if(isNameValid && isEmailValid && isSujetValid && isMessageValid){
            btnSubmit.removeAttribute("disabled");
        }
        
    }
