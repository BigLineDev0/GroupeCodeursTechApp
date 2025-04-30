document.addEventListener('DOMContentLoaded',function(){
    const btnDeleteDefElements = document.querySelectorAll('.btn-delete-definitive');
    btnDeleteDefElements.forEach((btnDeleteDefElement) => {
        btnDeleteDefElement.addEventListener('click', function(event){
            event.preventDefault();
    
            const serviceReaId = this.getAttribute('data-id');
            const nameserviceRea = this.getAttribute('name-serviceRea');
    
            Swal.fire({
                title: `Êtes-vous bien sûr de Suppimer definitivement ${nameserviceRea} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la suppression définitive',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `serviceReaMainController?id=${serviceReaId}&action=delelteDef`;
                }
            })
        });
    });
});