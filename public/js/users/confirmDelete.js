const btnDeleteElements = document.querySelectorAll('.btn-delete-user');
    btnDeleteElements.forEach((btnDeleteElement) => {
        btnDeleteElement.addEventListener('click', function(event){
            event.preventDefault();

            const userId = this.getAttribute('data-id-user');
            const userName = this.getAttribute('data-nom-user');

            Swal.fire({
                title: `Êtes-vous sûr de vouloir supprimer ${userName} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la suppression',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `userMainController?id=${userId}&action=delete`;
                }
            })
        });
});