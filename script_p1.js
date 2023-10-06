let btnLike = document.querySelectorAll(".btnLike");
let btnDislike = document.querySelectorAll(".btnDislike");

btnLike.forEach(button => {
    button.addEventListener("click", ()=> {
        const comentarioId = button.getAttribute("data-id");

        /* hacer peticion a servidor */
        fetch("http://localhost/xampp/scomentarios/likes.php", {
            method: 'POST',
            body: JSON.stringify({ comentarioId }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                console.log("Solicitud enviada con éxito");
                location.reload();
            }
        });
    });
});

btnDislike.forEach(button => {
    button.addEventListener("click", ()=> {
        const comentarioId = button.getAttribute("data-id");
        const video = button.getAttribute("video");

        /* hacer peticion a servidor */
        fetch("http://localhost/xampp/scomentarios/dislikes.php", {
            method: 'POST',
            body: JSON.stringify({ comentarioId, video }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                console.log("Solicitud enviada con éxito");
                location.reload();
            }
        });
    });
});