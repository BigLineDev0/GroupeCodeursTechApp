// Récuperation des champs du formulaire
const nomInput = document.getElementById('nom');
const descriptionInput = document.getElementById('description');
const photoInput = document.getElementById('photo');
const typeInput = document.getElementById('type');
const frmServiceRea = document.getElementById('formAddServiceRea');
const btnSubmit = frmServiceRea.querySelector('button[type=submit]');

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

// Validation du champ description à la saisie
descriptionInput.addEventListener('input', () => {
    const desciption = descriptionInput.value.trim();
    const desciptionValidator = Validator.nameValidator("La description", 5, 200, desciption);

    if (desciptionValidator) 
    {
        showError(descriptionInput, desciptionValidator.message);
        
    } else 
    {
        showError(descriptionInput, "");
    }

    checkFormValidaty();
});

// Validation du champ photo à la selection
photoInput.addEventListener('change', () => {
    const photo = photoInput.files[0];
    
    if (!photo) 
    {
        showError(photoInput, 'La photo est obligatoire.');
        
    } else if (!photo.type.startsWith('image/')) {
        showError(photoInput, 'Le fichier doit être une image.');
    } else 
    {
        showError(photoInput, "");
    }

    checkFormValidaty();
});

// Validation du champ type à la selection
typeInput.addEventListener('change', () => {
    
    if (typeInput.value === "") 
    {
        showError(typeInput, 'Veuillez selectionner un type.');
    } else 
    {
        showError(typeInput, "");
    }
    checkFormValidaty();
});

// Activer le bouton Ajouter si les champs sont valides
function checkFormValidaty()
{
    const nom = nomInput.value.trim();
    const description = descriptionInput.value.trim();
    const photo = photoInput.files[0];
    const type = typeInput.value.trim();

    const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
    const isDescriptionValid = Validator.nameValidator("La description", 5, 200, description) == null;
    const isphotoValid = photo && photo.type.startsWith('image/');
    const isTypeValid = type !== "";

    btnSubmit.disabled = !(isNameValid && isDescriptionValid && isphotoValid && isTypeValid);
}

// Desactiver le bouton ajouter apres cliquer sur annuler
frmServiceRea.addEventListener('reset', () => {
    btnSubmit.disabled = true;
});