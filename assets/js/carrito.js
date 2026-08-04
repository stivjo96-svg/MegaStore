document.addEventListener("DOMContentLoaded", function () {

    const botones = document.querySelectorAll(".agregarCarrito");

    botones.forEach(boton => {

        boton.addEventListener("click", function () {

            const id = this.dataset.id;

            fetch("/MegaStore/controllers/CarritoController.php", {

                method: "POST",

                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-Requested-With": "XMLHttpRequest"
                },

                body: "accion=agregar&producto_id=" + id

            })
                        .then(response => response.json())
            .then(data => {

                if(data.ok){

                    document.getElementById("contadorCarrito").textContent = data.cantidad;

                    Swal.fire({

                        icon: "success",

                        title: "Producto agregado",

                        text: "Se agregó correctamente al carrito.",

                        timer: 1500,

                        showConfirmButton: false

                    });
                }

                console.log(data);

            });

        });

    });

});