async function obtenerPerfilYPosts(userId) {
    try {
        const userResponse = await fetch(`../src/controladores/chat.php?id=${userId}`);
        if (!userResponse.ok) {
            throw new Error("Error al obtener los datos del usuario.");
        }

        const user = await userResponse.json();

        if (user.error) {
            document.getElementById('userInfo').innerHTML = `<p>${user.error}</p>`;
            return;
        }

        const userInfoHtml = `
            <img src="../avatar/${user.avatar}" class="profile-pic" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-bottom: 10px;">
            <h1>${user.username}</h1>
            <p>Correo: ${user.email}</p>
        `;
        document.getElementById('userInfo').innerHTML = userInfoHtml;

        const postsResponse = await fetch(`../src/controladores/chat.php?action=obtenerPosts&id=${userId}`);
        if (!postsResponse.ok) {
            throw new Error("Error al obtener los posts del usuario.");
        }

        const posts = await postsResponse.json();

        const postsContainer = document.getElementById('userPosts'); 
        postsContainer.innerHTML = ''; 

        // Verificar si no hay posts
        if (posts.length === 0) {
            postsContainer.innerHTML = `
                <div class="alert alert-info mt-3" role="alert">
                    Este usuario aún no tiene publicaciones.
                </div>
            `;
            return;
        }

        // Recorrer los posts obtenidos
        posts.forEach(post => {
            // Determinar si el post tiene medios (imagen o video)
            let mediaHtml = '';
            if (post.media_path && post.media_path.trim() !== '') {
                const extension = post.media_path.split('.').pop().toLowerCase(); // Obtener la extensión del archivo

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

            // Crear el HTML de cada post
            const postCard = `
                <div class="card rounded mt-3 post-card" id="post_${post.id}">
                    <div class="card-body">
                        <h5 class="card-title">${post.fecha}</h5>
                        <p class="card-text">${post.content}</p>
                        
                        <!-- Mostrar la media (imagen o video) -->
                        ${mediaHtml}

                        <!-- Mostrar hashtags -->
                        <div class="hashtags-container">
                            ${hashtagsHtml}
                        </div>
                    </div>
                </div>
            `;

            // Añadir el post al contenedor
            postsContainer.innerHTML += postCard;
        });

    } catch (error) {
        console.error("Error al cargar el perfil y los posts:", error);
        document.getElementById('userInfo').innerHTML = `<p>Error: ${error.message}</p>`;
    }
}

// Obtener el userId de la URL
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id');
    if (userId) {
        obtenerPerfilYPosts(userId);
    } else {
        document.getElementById('userInfo').innerHTML = `<p>ID de usuario no válido.</p>`;
    }
});
