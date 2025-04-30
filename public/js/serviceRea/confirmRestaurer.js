document.addEventListener('DOMContentLoaded',function(){
    const btnRestaurerElements = document.querySelectorAll('.btn-restaurer');
    btnRestaurerElements.forEach((btnRestaurerElement) => {
        btnRestaurerElement.addEventListener('click', function(event){
            event.preventDefault();
    
            const serviceReaId = this.getAttribute('data-id');
            const nameserviceRea = this.getAttribute('name-serviceRea');
    
            Swal.fire({
                title: `Êtes-vous sûr de vouloir restaurer ${nameserviceRea} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la restauration',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, Restaurer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `serviceReaMainController?id=${serviceReaId}&action=restaurer`;
                }
            })
        });
    });
});