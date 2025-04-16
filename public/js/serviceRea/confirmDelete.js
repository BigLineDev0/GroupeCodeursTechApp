document.addEventListener('DOMContentLoaded',function(){
    const btnDeleteElements = document.querySelectorAll('.btn-delete');
    btnDeleteElements.forEach((btnDeleteElement) => {
        btnDeleteElement.addEventListener('click', function(event){
            event.preventDefault();
    
            const serviceReaId = this.getAttribute('data-id');
            const nameserviceRea = this.getAttribute('name-serviceRea');
    
            Swal.fire({
                title: `Êtes-vous sûr de vouloir supprimer ${nameserviceRea} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la suppression',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `serviceReaMainController?id=${serviceReaId}&action=delete`;
                }
            })
        });
    });
});