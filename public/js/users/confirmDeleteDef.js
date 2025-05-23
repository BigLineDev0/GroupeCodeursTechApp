document.addEventListener('DOMContentLoaded',function(){
    const btnDeleteDefElements = document.querySelectorAll('.btn-delete-definitive-user');
    btnDeleteDefElements.forEach((btnDeleteDefElement) => {
        btnDeleteDefElement.addEventListener('click', function(event){
            event.preventDefault();
    
            const userId = this.getAttribute('data-id-user');
            const userName = this.getAttribute('data-nom-user');
    
            Swal.fire({
                title: `Êtes-vous bien sûr de Suppimer definitivement ${userName} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la suppression définitive',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `userMainController?id=${userId}&action=delelteDef`;
                }
            })
        });
    });
});