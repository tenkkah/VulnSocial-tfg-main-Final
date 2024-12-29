document.addEventListener("DOMContentLoaded", function () {
    let likedPostIds = []; // Array para almacenar los IDs de los posts que el usuario ha "likado"

    // Cargar los posts con "Me gusta"
    async function cargarLikesPosts() {
        try {
            const response = await fetch('../src/controladores/likes.php?likedPosts=true', {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' },
            });
            const result = await response.json();

            // Obtener los posts que el usuario ha "likado"
            likedPostIds = result.likedPosts.map(post => post.id);

            const likesContainer = document.getElementById('likesPostsContainer');
            likesContainer.innerHTML = '';

            if (!result.likedPosts || result.likedPosts.length === 0) {
                likesContainer.innerHTML = `
                    <div class="alert alert-info mt-3" role="alert">
                        No has dado "Me gusta" a ningún post aún.
                    </div>
                `;
                return;
            }

            result.likedPosts.forEach(post => {
                const userAvatar = post.avatar
                    ? `<img src="../avatar/${post.avatar}" alt="Avatar de ${post.username}" class="user-avatar" style="width: 50px; height: 50px; border-radius: 50%;">`
                    : `<img src="../img/default-avatar.png" alt="Avatar por defecto" class="user-avatar" style="width: 50px; height: 50px; border-radius: 50%;">`;

                // Aquí verificamos si el post está en likedPostIds para cambiar el color del corazón
                const likeButtonHtml = `
                    <button id="likeBtn_${post.id}" class="btn btn-outline-none like-btn" style="background: none; border: none; display: flex; align-items: center; gap: 5px;">
                        <i id="icon_${post.id}" class="fa${likedPostIds.includes(post.id) ? 's' : 'r'} fa-heart" style="font-size: 24px; color: ${likedPostIds.includes(post.id) ? 'red' : 'gray'};"></i>
                        <span id="likeCount_${post.id}" class="likes-count">${post.likes}</span>
                    </button>
                `;

                const mediaHtml = post.media_path ? generarMediaHtml(post.media_path) : '';
                const hashtagsHtml = (JSON.parse(post.hashtags || "[]"))
                    .map(hashtag => `<div class="hashtag-item">${hashtag}</div>`).join('');

                const postCard = `
                    <div class="card rounded mt-3 post-card" id="post_${post.id}">
                        <div class="card-body">
                            <h5 class="card-title">
                                ${userAvatar}
                                <p class="username-link" style="display: inline-block; margin-left: 10px;">${post.username}</p>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">${new Date(post.fecha).toLocaleString()}</h6>
                            <p class="card-text">${post.content}</p>
                            ${mediaHtml}
                            ${likeButtonHtml}
                            <div class="hashtags-container mt-2">${hashtagsHtml}</div>
                        </div>
                    </div>
                `;
                likesContainer.innerHTML += postCard;
            });

            asignarEventosLike();
        } catch (error) {
            console.error("Error al cargar los likes:", error);
        }
    }

    // Llamar a la función al cargar la página
    cargarLikesPosts();

    function generarMediaHtml(mediaPath) {
        // Suponiendo que el path es una URL de imagen o video
        const extension = mediaPath.split('.').pop().toLowerCase();
    
        if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            // Si el archivo es una imagen, genera un HTML para mostrarla
            return `<img src="../uploads/${mediaPath}" alt="Media" class="post-media" style="max-width: 100%; height: auto;">`;
        } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
            // Si el archivo es un video, genera un HTML para mostrarlo
            return `<video controls class="post-media" style="max-width: 100%; height: auto;">
                        <source src="../uploads/${mediaPath}" type="video/${extension}">
                        Your browser does not support the video tag.
                    </video>`;
        }
        // Si no es una imagen ni un video, simplemente no mostrar nada
        return '';
    }
    

    // Función para alternar "Me gusta" (igual que antes)
    async function toggleLike(postId) {
        try {
            const response = await fetch('../src/controladores/likes.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ postId })
            });
            const result = await response.json();

            if (result.success) {
                const likeIcon = document.getElementById(`icon_${postId}`);
                const likeCount = document.getElementById(`likeCount_${postId}`);

                const isLiked = likeIcon.classList.contains('fas');
                likeIcon.classList.toggle('fas', !isLiked);
                likeIcon.classList.toggle('far', isLiked);
                likeIcon.style.color = isLiked ? 'gray' : 'red';

                likeCount.textContent = parseInt(likeCount.textContent) + (isLiked ? -1 : 1);

                if (document.getElementById("likes-posts-tab").classList.contains("active")) {
                    cargarLikesPosts();
                }
            } else {
                console.error("Error al actualizar el like:", result.message);
            }
        } catch (error) {
            console.error("Error al alternar el like:", error);
        }
    }

    // Función para asignar los eventos de "Me gusta" a los botones
    function asignarEventosLike() {
        const likeButtons = document.querySelectorAll('.like-btn');
        likeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const postId = button.id.split('_')[1]; // Extraemos el ID del post del botón
                toggleLike(postId);
            });
        });
    }
});




// Función para obtener los posts del usuario
async function obtenerPostsUsuario() {
    try {
        const response = await fetch(`../src/controladores/getUserPosts.php`); 
        const data = await response.json();
    

        return data;
    } catch (error) {
        console.error('Error al obtener los posts:', error);
        return [];
    }
}

async function mostrarMisPosts() {
    // Obtener los posts del usuario desde el backend
    const posts = await obtenerPostsUsuario();
    const postsContainer = document.getElementById('misPostsContainer');  
    postsContainer.innerHTML = ''; 

    // Verificar si no hay posts
    if (posts.length === 0) {
        postsContainer.innerHTML = `
            <div class="alert alert-info mt-3" role="alert">
                No tienes ningún post aún. ¡Empieza a crear contenido ahora!
            </div>
        `;
        return;
    }
  
    // Recorrer los posts obtenidos
    posts.forEach(post => {
        const likesHtml = post.likes ? `<div class="likes mt-2">❤️ ${post.likes} Likes</div>` : '';
        
        // Determinar si el post tiene medios (imagen o video)
        let mediaHtml = '';
        if (post.media_path && post.media_path.trim() !== '') {
            const extension = post.media_path.split('.').pop().toLowerCase();  // Obtener la extensión del archivo
            
            if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                // Es una imagen
                mediaHtml = `<img src="../uploads/${post.media_path}" alt="Media del post" class="img-fluid mt-2" style="width: 100%; max-width: 400px; height: auto;">`;
            } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                // Es un video
                mediaHtml = `  
                    <video controls class="mt-2" style="width: 100%; max-width: 400px; height: auto;">
                        <source src="../uploads/${post.media_path}" type="video/${extension}">
                        Tu navegador no soporta la reproducción de video.
                    </video>`;
            }
        }

        // Manejo de hashtags
        const hashtags = JSON.parse(post.hashtags || "[]");
        const hashtagsHtml = hashtags.length > 0 ? `
            <div class="hashtags mt-2">
                ${hashtags.map(hashtag => `<div class="hashtag-item">${hashtag}</div>`).join('')}
            </div>
        ` : '';

        
        const postCard = `
            <div class="card rounded mt-3 post-card" id="post_${post.id}">
                <div class="card-body">
                    <h5 class="card-title">${post.fecha}</h5>
                    <p class="card-text">${post.content}</p>
                    
                    <!-- Mostrar la media (imagen o video) -->
                    ${mediaHtml}

                    <div class="hashtags-container">
                        ${likesHtml}
                    </div>

                    <!-- Mostrar hashtags -->
                    <div class="hashtags-container">
                        ${hashtagsHtml}
                    </div>

                    <!-- Botón de eliminar el post -->
                    <span class="delete-icon" onclick="eliminarPost(${post.id})">🗑️ Eliminar</span>

                </div>
            </div>
        `;
        
        // Añadir el post al contenedor
        postsContainer.innerHTML += postCard;
    });
}


// Función para eliminar un post
async function eliminarPost(postId) {
    // Mostrar el diálogo de confirmación
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar este post después de eliminarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    // Si el usuario confirma, procede a eliminar el post
    if (result.isConfirmed) {
        try {
            const response = await fetch('../src/controladores/deletePost.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: postId })
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
                    title: "El post ha sido eliminado"
                  });
                // Actualiza la lista de posts
                mostrarMisPosts(); 
            } else {
                // Mostrar mensaje de error
                Swal.fire(
                    'Error!',
                    result.message,
                    'error'
                );
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire(
                'Error!',
                'Ocurrió un error al intentar eliminar el post.',
                'error'
            );
        }
    }
}


document.addEventListener('DOMContentLoaded', mostrarMisPosts);
