
    const btnRestaurerElements = document.querySelectorAll('.btn-restaurer-user');
    btnRestaurerElements.forEach((btnRestaurerElement) => {
        btnRestaurerElement.addEventListener('click', function(event){
            event.preventDefault();
    
            const userId = this.getAttribute('data-id-user');
            const userName = this.getAttribute('data-nom-user');
    
            Swal.fire({
                title: `Êtes-vous sûr de vouloir restaurer ${userName} ?`,	
                text: 'Cette action est irréversible.',
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la restauration',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, Restaurer',  
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `userMainController?id=${userId}&action=restaurer`;
                }
            })
        });
    });
