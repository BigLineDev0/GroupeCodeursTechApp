document.addEventListener("DOMContentLoaded", function () {
    // Récuperation des champs du formulaire
    const nomInputEdit = document.getElementById('edit-nom');
    const idInputEdit = document.getElementById('edit-id');
    const descriptionInputEdit = document.getElementById('edit-description');
    const photoInputEdit = document.getElementById('edit-photo');
    const typeInputEdit = document.getElementById('edit-type');
    const frmEditServiceRea = document.getElementById('formEditServiceRea');
    const btnSubmitEdit = frmEditServiceRea.querySelector('button[type=submit]');
    const photoPreview = document.getElementById('photo-preview');

    // Désactiver le bouton Ajouter
    btnSubmitEdit.disabled = true;

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
    nomInputEdit.addEventListener('input', () => {
        const nom = nomInputEdit.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

        if (nomValidator) 
        {
            showError(nomInputEdit, nomValidator.message);
            
        } else 
        {
            showError(nomInputEdit, "");
        }

        checkFormValidaty();
    });

    // Validation du champ description à la saisie
    descriptionInputEdit.addEventListener('input', () => {
        const desciption = descriptionInputEdit.value.trim();
        const desciptionValidator = Validator.textValidator("La description", 5, 500, desciption);

        if (desciptionValidator) 
        {
            showError(descriptionInputEdit, desciptionValidator.message);
            
        } else 
        {
            showError(descriptionInputEdit, "");
        }

        checkFormValidaty();
    });

    // Validation du champ photo à la selection
    photoInputEdit.addEventListener('change', () => {
        const photo = photoInputEdit.files[0];
        
        if (!photo && !photoPreview.src) 
        {
            showError(photoInputEdit, 'La photo est obligatoire.');
            
        } else if (photo && !photo.type.startsWith('image/')) {
            showError(photoInputEdit, 'Le fichier doit être une image.');
        } else 
        {
            showError(photoInputEdit, "");
        }

        checkFormValidaty();
    });

    // Validation du champ type à la selection
    typeInputEdit.addEventListener('change', () => {
        
        if (typeInputEdit.value === "") 
        {
            showError(typeInputEdit, 'Veuillez selectionner un type.');
        } else 
        {
            showError(typeInputEdit, "");
        }
        checkFormValidaty();
    });

    // Activer le bouton Ajouter si les champs sont valides
    function checkFormValidaty()
    {
        const nom = nomInputEdit.value.trim();
        const description = descriptionInputEdit.value.trim();
        const photo = photoInputEdit.files[0];
        const type = typeInputEdit.value.trim();

        const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
        const isDescriptionValid = Validator.textValidator("La description", 5, 500, description) == null;
        const isphotoValid = photo && photo.type.startsWith('image/');
        const isTypeValid = type !== "";

        btnSubmitEdit.disabled = !(isNameValid && isDescriptionValid && isphotoValid && isTypeValid);
    }


    const editButtons = document.querySelectorAll('.btn-edit');
        
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Récupération de la valeur des attributs data-* de la balise cliquée
            const id = button.getAttribute('data-id');
            const nom = button.getAttribute('data-nom');
            const description = button.getAttribute('data-description');
            const photo = button.getAttribute('data-photo');
            const type = button.getAttribute('data-type');

            // Remplir les champs du modal avec des données
            idInputEdit.value = id;
            nomInputEdit.value = nom;
            descriptionInputEdit.value = description;
            typeInputEdit.value = type;
            
            // Mettre à jour l'appercu de la photo
            if (photo) {
                photoPreview.src = `public/images/servicesRea/${photo}`;
            } else {
                photoPreview.src = `public/images/servicesRea/user-1.jpg`;
            }

            const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
            const isDescriptionValid = Validator.textValidator("La description", 5, 500, description) == null;
            const isphotoValid = photo != null;
            const isTypeValid = type !== "";

            btnSubmitEdit.disabled = !(isNameValid && isDescriptionValid && isphotoValid && isTypeValid);

        });
    });
});


