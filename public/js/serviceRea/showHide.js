// Récupeartion des elements
const tableListe = document.getElementById('table-liste');
const tableCorbeille = document.getElementById('corbeille-liste');
const btnShowListe = document.getElementById('btn-show-liste');
const btnShowCorbeille = document.getElementById('btn-show-corbeille');

// Masquer le bouton afficher liste et la liste corbeille 
btnShowListe.setAttribute('hidden', 'hidden'); 
tableCorbeille.setAttribute('hidden', 'hidden');

// cliquer sur afficher corbeille masquer la liste et afficher corbeille
btnShowCorbeille.addEventListener('click', function () {
    this.setAttribute('hidden', 'hidden'); // Permet de masquer
    btnShowListe.removeAttribute('hidden'); // Permet d'afficher

    tableListe.setAttribute('hidden', 'hidden');
    tableCorbeille.removeAttribute('hidden');

});

// cliquer sur afficher corbeille masquer la liste et afficher corbeille
btnShowListe.addEventListener('click', function () {
    this.setAttribute('hidden', 'hidden'); // Permet de masquer
    btnShowCorbeille.removeAttribute('hidden'); // Permet d'afficher

    tableCorbeille.setAttribute('hidden', 'hidden');
    tableListe.removeAttribute('hidden');

});