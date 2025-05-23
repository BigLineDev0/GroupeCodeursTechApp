// Récupeartion des elements
const tableListeUser = document.getElementById('table-liste-user');
const tableCorbeilleUser = document.getElementById('corbeille-liste-user');
const btnShowListeUser = document.getElementById('btn-show-liste-user');
const btnShowCorbeilleUser = document.getElementById('btn-show-corbeille-user');

// Masquer le bouton afficher liste et la liste corbeille 
btnShowListeUser.setAttribute('hidden', 'hidden'); 
tableCorbeilleUser.setAttribute('hidden', 'hidden');

// cliquer sur afficher corbeille masquer la liste et afficher corbeille
btnShowCorbeilleUser.addEventListener('click', function () {
    this.setAttribute('hidden', 'hidden'); // Permet de masquer
    btnShowListeUser.removeAttribute('hidden'); // Permet d'afficher

    tableListeUser.setAttribute('hidden', 'hidden');
    tableCorbeilleUser.removeAttribute('hidden');

});

// cliquer sur afficher corbeille masquer la liste et afficher corbeille
btnShowListeUser.addEventListener('click', function () {
    this.setAttribute('hidden', 'hidden'); // Permet de masquer
    btnShowCorbeilleUser.removeAttribute('hidden'); // Permet d'afficher

    tableCorbeilleUser.setAttribute('hidden', 'hidden');
    tableListeUser.removeAttribute('hidden');

});