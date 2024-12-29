document.addEventListener('DOMContentLoaded', function() {
    // Comprobar si el usuario es admin
    const isAdmin = localStorage.getItem('isAdmin');

    if (isAdmin !== '1') {
        // Redirigir al usuario a la página 404 si no es admin
        window.location.href = '../templates/404.html';
        return;
    }

    // Función para cargar usuarios


    // Llamar a la función para cargar los usuarios al cargar la página
    cargarRespuestas();
});

async function mostrarRespuestas() {
    try {
        const response = await fetch('../src/controladores/respuestasAdmin.php?action=listaRespuestas');
        if (!response.ok) {
            throw new Error('Error al cargar los usuarios');
        }
        const respuestas = await response.json();
        const tbody = document.getElementById("respuestasTbody");
        tbody.innerHTML = '';

        respuestas.forEach(respuesta => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${respuesta.id}</td>
                    <td>${respuesta.post_id}</td>
                    <td>${respuesta.user_id}</td>
                    <td>${respuesta.content}</td>
                    <td>${new Date(respuesta.fecha).toLocaleDateString()}</td>
                    <td><button class='btn btn-danger' onclick='eliminarRespuesta(${respuesta.id})'>Eliminar</button></td>
                    <td><button class='btn btn-primary' onclick='editarRespuesta(${respuesta.id})'>Editar</button></td>
            `;
            tbody.appendChild(fila);
        });
    } catch (error) {
        console.error('Error al mostrar los posts:', error);
    }
}


    async function cargarRespuestas() {
        try {
            // Realizar la petición con fetch y await
            const response = await fetch('../src/controladores/respuestasAdmin.php?action=listaRespuestas');
            console.log(response);
            // Verificar si la respuesta es correcta
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }

            // Convertir la respuesta a JSON
            const data = await response.json();
            console.log(data);

            // Obtener el tbody de la tabla
            const tbody = document.querySelector('#respuestasTable tbody');
            tbody.innerHTML = ''; // Limpiar el contenido del tbody

            // Verificar si no hay usuarios
            if (data.length === 0) {
                const fila = document.createElement('tr');
                fila.innerHTML = `<td colspan="6">No hay respuestas disponibles.</td>`;
                tbody.appendChild(fila);
                return;
            }
            // Recorrer los usuarios y agregarlos a la tabla
            data.forEach(respuesta => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${respuesta.id}</td>
                    <td>${respuesta.post_id}</td>
                    <td>${respuesta.user_id}</td>
                    <td>${respuesta.content}</td>
                    <td>${new Date(respuesta.fecha).toLocaleDateString()}</td>
                    <td><button class='btn btn-danger' onclick='eliminarRespuesta(${respuesta.id})'>Eliminar</button></td>
                    <td><button class='btn btn-primary' onclick='editarRespuesta(${respuesta.id})'>Editar</button></td>
                `;
                tbody.appendChild(fila);
            });
        } catch (error) {
            console.error('Error al cargar los usuarios:', error);

            // Mostrar mensaje de error en la tabla
            const tbody = document.querySelector('#usuariosTable tbody');
            tbody.innerHTML = '';
            const fila = document.createElement('tr');
            fila.innerHTML = `<td colspan="6">Error al cargar las respuestas.</td>`;
            tbody.appendChild(fila);
        }
    }

//Funciona pero tengo que ver el metodo para llamar al mostrar usuarios
async function eliminarRespuesta(respuestaId) {
    // Mostrar el diálogo de confirmación
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar esta respuesta después de eliminarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    // Si el usuario confirma, procede a eliminar el usuario
    if (result.isConfirmed) {
        try {
            const response = await fetch('../src/controladores/respuestasAdmin.php?action=eliminarRespuesta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: respuestaId })
            });

            const result = await response.json();
            if (result.success) {
                // Mostrar mensaje de éxito
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "success",
                    title: "Respuesta eliminada"
                  });
                // Actualiza la lista de posts
                mostrarRespuestas(); // Asume que tienes una función para recargar los posts
            } else {
                // Mostrar mensaje de error
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "info",
                    title: "Hubo un error al eliminar la respuesta "
                  });
            }
        } catch (error) {
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "info",
                title: "Hubo un error al eliminar la respuesta"
              });
        }
    }
}


async function editarRespuesta(id) {
    try {
        // Obtener los datos de la respuesta seleccionada
        const response = await fetch(`../src/controladores/respuestasAdmin.php?action=obtenerRespuesta&id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos de la respuesta');
        }
        const respuesta = await response.json();

        // Rellenar los campos del formulario en el modal con los datos de la respuesta
        document.getElementById('editId').value = respuesta.id;
        document.getElementById('editIdPost').value = respuesta.post_id;
        document.getElementById('editIdUsuario').value = respuesta.user_id;
        document.getElementById("editRespuesta").value = respuesta.content;

        // Formatear la fecha correctamente
        const fecha = new Date(respuesta.fecha);
        const formattedDate = `${fecha.getFullYear()}-${(fecha.getMonth() + 1).toString().padStart(2, '0')}-${fecha.getDate().toString().padStart(2, '0')}`;
        document.getElementById('editFecha').value = formattedDate;

        // Mostrar el modal
        const editRespuestaModal = new bootstrap.Modal(document.getElementById('editRespuestaModal'));
        editRespuestaModal.show();
    } catch (error) {
        console.error('Error al cargar los datos de la respuesta:', error);
        alert('Error al cargar los datos de la respuesta.');
    }
}

// Configurar el modal
const myModal = new bootstrap.Modal(document.getElementById('editRespuestaModal'));

// Evento para guardar cambios al hacer clic en el botón "Guardar Cambios"
document.getElementById('saveChanges').addEventListener('click', async function () {
    const id = document.getElementById('editId').value;
    const post_id = document.getElementById('editIdPost').value;
    const user_id = document.getElementById('editIdUsuario').value;
    const respuesta = document.getElementById("editRespuesta").value;
    const fecha = document.getElementById("editFecha").value;

    // Preparar datos a enviar
    const datos = {
        id,
        post_id,
        user_id,
        respuesta,
        fecha
    };

    try {
        // Enviar los datos actualizados al servidor
        const response = await fetch('../src/controladores/respuestasAdmin.php?action=actualizarRespuesta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const result = await response.json();
       
        if (result.success) {
            document.querySelector('button#cerrar').click();            
            const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "success",
            title: "El post ha sido editado"
          });
            // myModal.hide();
            const postModal = new bootstrap.Modal(document.getElementById('editPostModal'));

            mostrarRespuestas(); // Recarga la lista de posts
        } else {
            Swal.fire({
                title: "Error al actualizar la respuesta",
                text: result.message || "Ocurrió un problema desconocido",
                icon: "error"
            });
        }
    } catch (error) {
        console.error('Error al actualizar la respuesta:', error);
        Swal.fire({
            title: "Error en el servidor",
            text: "Intente nuevamente más tarde",
            icon: "error"
        });
    }
});

