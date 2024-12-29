// Posts por usuario
new Chart(document.getElementById('postsPorUsuarioChart'), {
    type: 'bar',
    data: {
        labels: postsPorUsuario.map(data => data.username),
        datasets: [{
            label: 'Total de Posts',
            data: postsPorUsuario.map(data => data.total_posts),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    }
});

// Publicaciones por día
new Chart(document.getElementById('publicacionesPorDiaChart'), {
    type: 'line',
    data: {
        labels: publicacionesPorDia.map(data => data.fecha),
        datasets: [{
            label: 'Publicaciones por Día',
            data: publicacionesPorDia.map(data => data.publicaciones_por_dia),
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1,
            tension: 0.3
        }]
    }
});

// Usuarios más activos
new Chart(document.getElementById('usuariosMasActivosChart'), {
    type: 'bar',
    data: {
        labels: usuariosMasActivos.map(data => data.username),
        datasets: [{
            label: 'Cantidad de Posts',
            data: usuariosMasActivos.map(data => data.cantidad_posts),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    }
});

// Promedio de posts por usuario
new Chart(document.getElementById('promedioPostsPorUsuarioChart'), {
    type: 'doughnut',
    data: {
        labels: ['Promedio de Posts por Usuario'],
        datasets: [{
            data: [promedioPostsPorUsuario],
            backgroundColor: ['rgba(54, 162, 235, 0.2)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        }]
    }
});

// Posts por mes
new Chart(document.getElementById('postsPorMesChart'), {
    type: 'line',
    data: {
        labels: postsPorMes.map(data => data.mes),
        datasets: [{
            label: 'Posts por Mes',
            data: postsPorMes.map(data => data.cantidad_posts),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1,
            tension: 0.3
        }]
    }
});

new Chart(document.getElementById('topUsuariosRecientesChart'), {
    type: 'bar',
    data: {
        labels: topUsuariosRecientes.map(data => data.username),
        datasets: [{
            label: 'Posts en los Últimos 30 Días',
            data: topUsuariosRecientes.map(data => data.posts_recientes),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                enabled: true
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Usuarios'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Posts'
                },
                beginAtZero: true
            }
        }
    }
});


// Mensajes enviados y recibidos
new Chart(document.getElementById('mensajesEnviadosYRecibidosChart'), {
    type: 'bar',
    data: {
        labels: mensajesEnviadosYRecibidos.map(data => data.username),
        datasets: [{
            label: 'Mensajes Enviados',
            data: mensajesEnviadosYRecibidos.map(data => data.total_messages_sent),
            backgroundColor: 'rgba(255, 205, 86, 0.2)',
            borderColor: 'rgba(255, 205, 86, 1)',
            borderWidth: 1
        }]
    }
});

// Mensajes recibidos por usuario
new Chart(document.getElementById('mensajesRecibidosPorUsuarioChart'), {
    type: 'bar',
    data: {
        labels: mensajesRecibidosPorUsuario.map(data => data.username),
        datasets: [{
            label: 'Mensajes Recibidos',
            data: mensajesRecibidosPorUsuario.map(data => data.total_messages_received),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    }
});

// Respuestas por post
new Chart(document.getElementById('respuestasPorPostChart'), {
    type: 'bar',
    data: {
        labels: respuestasPorPost.map(data => `Post ${data.id}`),
        datasets: [{
            label: 'Total de Respuestas',
            data: respuestasPorPost.map(data => data.total_responses),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    }
});


// Promedio de respuestas por post
new Chart(document.getElementById('promedioRespuestasPorPostChart'), {
    type: 'doughnut',
    data: {
        labels: ['Promedio de Respuestas por Post'],
        datasets: [{
            data: [promedioRespuestasPorPost[0]?.promedio_respuestas_por_post || 0],
            backgroundColor: ['rgba(255, 159, 64, 0.2)'],
            borderColor: ['rgba(255, 159, 64, 1)'],
            borderWidth: 1
        }]
    }
});

// Posts recientes
new Chart(document.getElementById('postsRecientesChart'), {
    type: 'bar',
    data: {
        labels: postsRecientes.map(data => data.username),
        datasets: [{
            label: 'Posts Recientes',
            data: postsRecientes.map(data => data.posts_recientes),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    }
});


// Likes por usuario
new Chart(document.getElementById('likesPorUsuarioChart'), {
    type: 'bar',
    data: {
        labels: likesPorUsuario.map(data => data.username),
        datasets: [{
            label: 'Likes Recibidos',
            data: likesPorUsuario.map(data => data.total_likes),
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Likes Recibidos por Usuario' }
        }
    }
});


// Top posts por likes
new Chart(document.getElementById('topPostsLikesChart'), {
    type: 'pie',
    data: {
        labels: topPostsLikes.map(data => data.content),
        datasets: [{
            label: 'Total de Likes',
            data: topPostsLikes.map(data => data.total_likes),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Top Posts por Likes' }
        }
    }
});

// Promedio de likes por post
new Chart(document.getElementById('promedioLikesPorPostChart'), {
    type: 'bar',
    data: {
        labels: ['Promedio'],
        datasets: [{
            label: 'Promedio de Likes',
            data: [promedioLikesPorPost],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Promedio de Likes por Post' }
        }
    }
});

// Mensajes enviados por usuario
new Chart(document.getElementById('mensajesEnviadosChart'), {
    type: 'bar',
    data: {
        labels: mensajesEnviados.map(data => data.username),
        datasets: [{
            label: 'Mensajes Enviados',
            data: mensajesEnviados.map(data => data.total_messages_sent),
            backgroundColor: 'rgba(255, 205, 86, 0.2)',
            borderColor: 'rgba(255, 205, 86, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Mensajes Enviados por Usuario' }
        }
    }
});

// Mensajes recibidos por usuario
new Chart(document.getElementById('mensajesRecibidosChart'), {
    type: 'bar',
    data: {
        labels: mensajesRecibidos.map(data => data.username),
        datasets: [{
            label: 'Mensajes Recibidos',
            data: mensajesRecibidos.map(data => data.total_messages_received),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Mensajes Recibidos por Usuario' }
        }
    }
});