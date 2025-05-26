// document.addEventListener("DOMContentLoaded", function () {
    // Récuperation des champs du formulaire
    const idEditInput = document.getElementById('edit-user-id');
    const nomEditInput = document.getElementById('edit-user-nom');
    const adresseEditInput = document.getElementById('edit-user-adresse');
    const telephoneEditInput = document.getElementById('edit-user-telephone');
    const emailEditInput = document.getElementById('edit-user-email');
    const photoEditInput = document.getElementById('edit-user-photo');
    const roleEditInput = document.getElementById('edit-user-role');
    const frmEditUser = document.getElementById('formEditUser');
    const btnEditSubmit = frmEditUser.querySelector('button[type=submit]');
    const photoEditPreview = document.getElementById('edit-photo-preview');

    // Désactiver le bouton Ajouter
    // btnEditSubmit.disabled = true;

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
    nomEditInput.addEventListener('input', () => {
        const nom = nomEditInput.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

        if (nomValidator) 
        {
            showError(nomEditInput, nomValidator.message);
            
        } else 
        {
            showError(nomEditInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ adresse à la saisie
    adresseEditInput.addEventListener('input', () => {
        const adresse = adresseEditInput.value.trim();
        const adresseValidator = Validator.addressValidator("L'adresse", 5, 50, adresse);

        if (adresseValidator) 
        {
            showError(adresseEditInput, adresseValidator.message);
            
        } else 
        {
            showError(adresseEditInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ telephone à la saisie
    telephoneEditInput.addEventListener('input', () => {
        const telephone = telephoneEditInput.value.trim();
        const telephoneValidator = Validator.phoneValidator("Le numéro de téléphone", 9, 17, telephone);

        if (telephoneValidator) 
        {
            showError(telephoneEditInput, telephoneValidator.message);
            
        } else 
        {
            showError(telephoneEditInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ email à la saisie
    emailEditInput.addEventListener('input', () => {
        const email = emailEditInput.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) 
        {
            showError(emailEditInput, emailValidator.message);
            
        } else 
        {
            showError(emailEditInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ photo à la selection
    photoEditInput.addEventListener('change', () => {
        const photo = photoEditInput.files[0];
        
        if (!photo && !photoEditPreview.src) 
        {
            showError(photoEditInput, 'La photo est obligatoire.');
            
        } else if (photo && !photo.type.startsWith('image/')) {
            showError(photoEditInput, 'Le fichier doit être une image.');
        } else 
        {
            showError(photoEditInput, "");
        }

        checkFormValidaty();
    });

    // Validation du champ role à la selection
    roleEditInput.addEventListener('change', () => {
        
        if (roleEditInput.value === "") 
        {
            showError(roleEditInput, 'Veuillez selectionner un role.');
        } else 
        {
            showError(roleEditInput, "");
        }
        checkFormValidaty();
    });

    // Activer le bouton Ajouter si les champs sont valides
    function checkFormValidaty()
    {
        const nom = nomEditInput.value.trim();
        const adresse = adresseEditInput.value.trim();
        const telephone = telephoneEditInput.value.trim();
        const email = emailEditInput.value.trim();
        const photo = photoEditInput.files[0];
        const role = roleEditInput.value.trim();

        const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
        const isAdresseValid = Validator.addressValidator("L'adresse", 5, 50, adresse) == null;
        const isTelephoneValid = Validator.phoneValidator("Le numéro de téléphone", 9, 17, telephone) == null;
        const isEmailValid = Validator.emailValidator("L'email", email) == null;
        const isphotoValid = photo && photo.type.startsWith('image/') || photoEditPreview.src !== "";
        const isRoleValid = role !== "";

        btnEditSubmit.disabled = !(isNameValid 
            && isAdresseValid 
            && isTelephoneValid 
            && isEmailValid
            && isphotoValid 
            && isRoleValid
        );
    }

    const editButtons = document.querySelectorAll('.btn-edit-user');
        
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Récupération de la valeur des attributs data-* de la balise cliquée
            const id = button.getAttribute('data-edit-id');
            const nom = button.getAttribute('data-edit-nom');
            const adresse = button.getAttribute('data-edit-adresse');
            const telephone = button.getAttribute('data-edit-telephone');
            const email = button.getAttribute('data-edit-email');
            const photo = button.getAttribute('data-edit-photo');
            const role = button.getAttribute('data-edit-role');

            // Remplir les champs du modal avec des données
            idEditInput.value = id;
            nomEditInput.value = nom;
            adresseEditInput.value = adresse;
            telephoneEditInput.value = telephone;
            emailEditInput.value = email;
            roleEditInput.value = role;
            
            // Mettre à jour l'appercu de la photo
            if (photo) {
                photoEditPreview.src = `public/images/users/${photo}`;
            } else {
                photoEditPreview.src = `public/images/users/user-1.jpg`;
            }

            const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
            const isAdresseValid = Validator.addressValidator("L'adresse", 5, 50, adresse) == null;
            const isTelephoneValid = Validator.phoneValidator("Le numéro de téléphone", 9, 17, telephone) == null;
            const isEmailValid = Validator.emailValidator("L'email", email) == null;
            const isphotoValid = photo && photo.type.startsWith('image/') || photoEditPreview.src !== "";
            const isRoleValid = role !== "";

            
            btnEditSubmit.disabled = !(isNameValid 
                && isAdresseValid 
                && isTelephoneValid 
                && isEmailValid
                && isphotoValid 
                && isRoleValid
            );

        });
    });
// });