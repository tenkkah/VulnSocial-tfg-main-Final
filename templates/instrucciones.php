<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | VulnSocial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-2">
                <nav class="nav flex-column">
                    <a class="nav-link" href="../index.php"><img src="../img/logo.svg" alt="logo" class="mb-3" width="40" height="40"></a>
                    <a class="nav-link" href="../index.php">Home</a>
                    <?php if (isset($_SESSION['username'])): ?>
                        <p>Logueado como <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php else: ?>
                        <a class="nav-link" href="./login.html">Login</a>
                        <a class="nav-link" href="./register.html">Register</a>
                    <?php endif; ?>
                </nav>
            </div>
                    <!--XSS <a href="" onmousedown="var name = '&#39;;alert(1)//'; alert('smthg')">Link</a>-->
                    <!--SQL Injection 'or '1'='1 en username y pwd-->
                    <!---->
                    <!---->

            <div class="col-9">
                <!-- Contenedor principal -->
                <div class="container mt-5">
                    <!-- Descripción del proyecto -->
                    <div class="text-center mb-5">
                        <h1>Instrucciones del Proyecto</h1>
                        <p>Este proyecto tiene como objetivo mostrar vulnerabilidades web comunes para educar sobre ciberseguridad. Explora cada vulnerabilidad para comprender sus riesgos y cómo mitigarlas.</p>
                    </div>


                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card h-100 shadow w-100">
                                <div class="card-body">
                                    <h5 class="card-title">Instrucciones del Proyecto</h5>
                                    <p class="card-text">
                                        A continuación, se detallan los pasos y características de la aplicación que debes completar para el proyecto. 
                                        Sigue estas instrucciones cuidadosamente para cumplir con los objetivos establecidos.
                                    </p>
                                    <ul>
                                        <li>Implementar la autenticación con vulnerabilidades controladas.</li>
                                        <li>Diseñar el CRUD de usuarios y publicaciones.</li>
                                        <li>Integrar dashboards estadísticos utilizando Chart.js.</li>
                                        <li>Probar y documentar las vulnerabilidades web.</li>
                                    </ul>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalInstrucciones">Ver instrucciones</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Cards de vulnerabilidades -->
                    <div class="row">
                        <!-- Card de Inyección SQL -->
                        <div class="col-6 col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">1. Inyección SQL</h5>
                                    <p class="card-text">Explora cómo los ataques de inyección SQL afectan a las aplicaciones web.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalSQL">Ver detalles</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card de CSRF -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">2. CSRF</h5>
                                    <p class="card-text">Descubre cómo los ataques CSRF pueden engañar a los usuarios para realizar acciones no deseadas sin su consentimiento.</p>
                                    <button class="btn btn-primary btnVerDetalles " data-bs-toggle="modal" data-bs-target="#modalCSRF">Ver detalles</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card de SSRF -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">3. SSRF</h5>
                                    <p class="card-text">Analiza cómo los ataques SSRF permiten a los atacantes interactuar con recursos internos de la red a través de solicitudes maliciosas.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalSSRF">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de XXE-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">4. Inyección de entidad externa XML (XXE)</h5>
                                    <p class="card-text">Explora cómo los ataques XXE pueden comprometer datos internos al incluir entidades externas en archivos XML mal formateados.</p>  
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalXXE">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de XSS-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">5. XSS</h5>
                                    <p class="card-text">Conoce cómo los ataques XSS inyectan scripts maliciosos en páginas web para afectar a los usuarios finales y robar información.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalXSS">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de JWT Attacks-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">6. JWT Attacks</h5>
                                    <p class="card-text">Aprende cómo los ataques de Open Redirect pueden redirigir a los usuarios a sitios maliciosos sin su conocimiento.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalJWT">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de OS Command Injection-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">7. OS Command Injection</h5>
                                    <p class="card-text">Descubre cómo los ataques de OS Command Injection permiten a los atacantes ejecutar comandos del sistema en el servidor.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalCommandInjection">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de Path Traversal-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">8. Path Traversal</h5>
                                    <p class="card-text">Entiende cómo los ataques de Path Traversal permiten a los atacantes acceder a archivos sensibles en el servidor mediante rutas manipuladas.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalPathTraversal">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                        <!--Card de File Upload-->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">9. File Upload</h5>
                                    <p class="card-text">Examina cómo la carga de archivos maliciosos puede comprometer la seguridad de una aplicación y facilitar el acceso no autorizado.</p>
                                    <button class="btn btn-primary btnVerDetalles" data-bs-toggle="modal" data-bs-target="#modalFileUpload">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals de vulnerabilidades -->
    <div class="modal fade" id="modalSQL" tabindex="-1" aria-labelledby="modalSQLLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalSQLLabel">Inyección SQL</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-padding">
                <p>En esta sección, explicamos:</p>
                    <ul>
                        <li>Qué es la inyección SQL (SQLi).</li>
                        <li>Cómo encontrar y explotar distintos tipos de vulnerabilidades de SQLi.</li>
                        <li>Cómo prevenir la SQLi.</li>
                    </ul>

                    <img src="../img/sql-injection.svg" alt="Ejemplo de Inyección SQL" class="img-fluid mb-3">


                    <!-- Imagen dentro del modal -->
                     <h3>¿Qué es la inyección SQL (SQLi)?</h3>
                    <p>La inyección SQL (SQLi) es una vulnerabilidad de seguridad web que permite a un atacante interferir en las consultas que una aplicación realiza a su base de datos.
                        Esto puede permitir a un atacante ver datos que normalmente no puede recuperar. Esto puede incluir datos que pertenecen a otros usuarios, o cualquier otro dato al que la aplicación pueda acceder. En muchos casos, un atacante puede modificar o borrar estos datos, causando cambios persistentes en el contenido o comportamiento de la aplicación.
                        En algunas situaciones, un atacante puede escalar un ataque de inyección SQL para comprometer el servidor subyacente u otra infraestructura back-end. También puede permitirles realizar ataques de denegación de servicio.</p>
                        
                    <h3>¿Cuál es el impacto de un ataque de inyección SQL exitoso?</h3>
                    <p>Un ataque de inyección SQL exitoso puede resultar en el acceso no autorizado a datos sensibles, tales como:</p>
                    <ul>
                        <li>Contraseñas.</li>
                        <li>Detalles de tarjetas de crédito.</li>
                        <li>Información personal del usuario.</li>
                    </ul>    
                    <p>Los ataques de inyección SQL se han utilizado en muchas violaciones de datos de alto perfil a lo largo de los años. Éstas han causado daños a la reputación y multas reglamentarias.
                         En algunos casos, un atacante puede obtener una puerta trasera persistente en los sistemas de una organización, lo que conduce a un compromiso a largo plazo que puede pasar desapercibido durante un período prolongado.</p>
                    <h3>Cómo detectar vulnerabilidades de inyección SQL</h3>
                    <p>Puede detectar la inyección SQL manualmente utilizando un conjunto sistemático de pruebas contra cada punto de entrada de la aplicación. Para ello, lo normal sería enviar:</p>
                    <ul>
                        <li>El carácter de comilla simple ' y buscar errores u otras anomalías.</li>
                        <li>Alguna sintaxis específica de SQL que se evalúe al valor base (original) del punto de entrada y a un valor diferente, y buscar diferencias sistemáticas en las respuestas de la aplicación.</li>
                        <li>Condiciones booleanas como OR 1=1 y OR 1=2, y buscar diferencias en las respuestas de la aplicación.</li>
                        <li>Cargas útiles diseñadas para desencadenar retardos temporales cuando se ejecutan dentro de una consulta SQL, y buscar diferencias en el tiempo que tarda en responder.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal para las instrucciones -->
<div class="modal fade" id="modalInstrucciones" tabindex="-1" aria-labelledby="modalInstruccionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalInstruccionesLabel">Instrucciones de VulnSocial</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom-padding">
                <h2>Descripción del Proyecto</h2>
                <p>
                    <strong>VulnSocial</strong> es una aplicación web diseñada para demostrar cómo las vulnerabilidades pueden comprometer la seguridad de una red social. 
                    Este proyecto tiene como objetivo educar a los desarrolladores y usuarios sobre los riesgos asociados con malas prácticas de desarrollo y cómo mitigarlos.
                    La plataforma permite a los usuarios registrarse, iniciar sesión, publicar posts, responder a publicaciones y explorar interacciones en tiempo real. 
                    Sin embargo, incluye vulnerabilidades intencionales para propósitos educativos.
                </p>

                <h2>Objetivos del Proyecto</h2>
                <ul>
                    <li>Fomentar la conciencia sobre las vulnerabilidades comunes en aplicaciones web.</li>
                    <li>Proporcionar un entorno controlado para comprender y resolver problemas de seguridad.</li>
                    <li>Implementar buenas prácticas para mejorar la seguridad de la aplicación.</li>
                </ul>

                <h2>Vulnerabilidades y Cómo Resolverlas</h2>

                <h3>1. Inyección SQL (SQL Injection)</h3>
                <p>
                    En la página de inicio de sesión existe la posibilidad de realizar inyecciones SQL mediante entradas inseguras.
                </p>
                <ol>
                    <li><strong>Problema</strong>: Las consultas a la base de datos no están parametrizadas, lo que permite ejecutar comandos SQL maliciosos.</li>
                    <li><strong>Resolución</strong>:
                        <ul>
                            <li>Utiliza consultas preparadas en lugar de concatenar directamente las entradas del usuario.</li>
                            <li>Ejemplo con PHP y PDO:
                                <pre><code>
                                        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
                                        $stmt->bindParam(':username', $username);
                                        $stmt->bindParam(':password', $password);
                                        $stmt->execute();
                                </code></pre>
                            </li>
                        </ul>
                    </li>
                </ol>

                <p>Como podemos ver en el login podemos acceder mediante email y password</p>
                <img src="../img/sql1.png" class="img-fluid mb-3">
                <p>Vamos a intentar acceder con credenciales</p>
                <img src="../img/sql2.png" class="img-fluid mb-3"> <br> <br> <br>
                <p>En este caso nos da credenciales erróneas.</p>
                <p>Vamos a ver que lenguaje se proceso en el backend con una extensión, en este caso se está usando PHP</p>
                <img src="../img/wappa.png" class="img-fluid mb-3"> <br> <br> <br>
                <p>En este caso vamos a intentar acceder como administrador con un SQL Injection de nivel 1.
                Lo que quiere decir que en una query todos los parámetros que vengan después de el email o username será valido sin saber la password, quedaría la query así:
                </p>

                <pre><code>
                    SELECT * FROM users WHERE email = '' OR '1'='1' AND password = '';
                </code></pre>
                <p>Vamos a introducir 'OR '1'='1' tanto en el campo de email como el de la password</p> <br>
                <img src="../img/sql3.png" class="img-fluid mb-3">
                
                <p>Una vez introducido, accedemos como admin, ya que normalmente en las aplicaciones. Por defecto el admin suele ser el primer ID asignado en un usuario, sino se cambia</p>
                <img src="../img/sql4.png" class="img-fluid mb-3">


                <br>
                <br>
                <h3>2. Cross-Site Scripting (XSS)</h3>
    <p>
        La funcionalidad de publicaciones en VulnSocial es vulnerable a ataques XSS debido a una falta de validación y sanitización de las entradas del usuario.
    </p>
    <ol>
        <li><strong>Problema</strong>: Los inputs de los usuarios no son validados ni limpiados antes de ser renderizados en el navegador, lo que permite inyectar código JavaScript malicioso.</li>
        <li><strong>Resolución</strong>:
            <ul>
                <li>Escapar correctamente el contenido dinámico al renderizar en el frontend para evitar la ejecución de código no deseado.</li>
                <li>Ejemplo en PHP:
                    <pre><code>
                        // Escapar salida para prevenir XSS
                        echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');
                    </code></pre>
                </li>
                <li>Usar una lista blanca de entradas aceptadas y rechazar las que contengan caracteres sospechosos.</li>
                <li>Implementar un Web Application Firewall (WAF) para detectar y bloquear ataques comunes.</li>
            </ul>
        </li>
    </ol>

    <h3>Demostración de la vulnerabilidad</h3>
    <p>En este ejemplo, usaremos la sección de publicaciones para inyectar un script malicioso.</p>
    <p>Primero, accedemos al formulario para crear un nuevo post:</p>
    <img src="../img/xss1.png" alt="Formulario de creación de post" class="img-fluid mb-3">
    <p>Introducimos el siguiente payload en el campo de texto:</p>
    <pre><code>
        &lt;script&gt;alert(1);&lt;/script&gt;
    </code></pre>
    <p>Después de enviar el formulario, observamos cómo se ejecuta el código en la página:</p>
    <img src="../img/xss2.png" alt="Ejecución del XSS" class="img-fluid mb-3">
    <p>El script inyectado genera una alerta en el navegador, lo que demuestra que el sistema no está protegiendo adecuadamente contra XSS. En este caso vamos a parsear el código para poder renderizarlo en la web y poder hacer uso del XSS</p>
    <img src="../img/xss3.png" alt="Ejecución del XSS" class="img-fluid mb-3">
    <h3>Mitigación</h3>
    <p>Para resolver esta vulnerabilidad, se deben implementar las siguientes medidas:</p>
    <ul>
        <li>Sanitizar las entradas del usuario antes de procesarlas o almacenarlas en la base de datos.</li>
        <li>Escapar cualquier dato dinámico antes de mostrarlo en el navegador utilizando funciones específicas para ello.</li>
        <li>Evitar directamente la renderización de código HTML o JavaScript proveniente del usuario sin una validación previa.</li>
    </ul>

    <h3>Implementación Segura</h3>
    <p>En PHP, podríamos modificar el código de la siguiente manera para prevenir XSS:</p>
    <pre><code>
        // Escapar salida antes de renderizar en HTML
        echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    </code></pre>
    <p>Además, se recomienda usar librerías de validación como <strong>HTMLPurifier</strong> para garantizar que el contenido sea seguro.</p>

    <p>Siguiendo estas buenas prácticas, podemos prevenir los ataques XSS y proteger mejor la aplicación y a los usuarios.</p>
                <h3>4. Subida de Archivos Inseguros</h3>
                <p>
                    La funcionalidad de subida de imágenes no verifica correctamente los archivos, lo que permite cargar scripts ejecutables.
                </p>
                <ol>
                    <li><strong>Problema</strong>: No hay validación de tipo o extensión de archivo.</li>
                    <li><strong>Resolución</strong>:
                        <ul>
                            <li>Valida la extensión del archivo y su tipo MIME.</li>
                            <li>Sube los archivos a directorios fuera de la raíz pública del servidor.</li>
                            <li>Ejemplo con PHP:
                                <pre><code>
                                    if (isset($_FILES['imagen']) && $_FILES['imagen']['type'] === 'image/jpeg') {
                                        move_uploaded_file($_FILES['imagen']['tmp_name'], '/uploads/' . basename($_FILES['imagen']['name']));
                                    }
                                </code></pre>
                            </li>
                        </ul>
                     <h3>Demostración de la vulnerabilidad</h3>
                            <p>En este caso al no validar los datos de la subida de ficheros, se va a subir un fichero .php donde se pueda ejecutar código y a su vez escalar esa vulnerabilidad a un Open Redirect. Esta vulnerabilidad consiste en poder redirigir a un usuario de una web, a una web fraudulenta que esté fuera de la red de la propia página como puede ser una web de phishing. 
                            Para ver si podemos escalar a un Open Redirect, vamos a intentar subir un fichero que no sea en formato foto, se ha creado un script donde se redirigirá al usuario una vez se pueda ejecutar el script. Para ello, se subirá la imagen en el servidor, donde se tendrá que acceder a la ruta para acceder. 
                            </p>
                            <img src="../img/lf1.png" width="1200px" height="600px"> <br> <br>

                            <p>Vamos a un post donde se haya subido una imagen para poder visualizar la ruta donde se alojan las imágenes. En este caso se va a intentar acceder a esa ruta, cambiando los rutas de la url, de la página.</p>
                            <img src="../img/lf2.png" width="1200px" height="600px"> <br> <br>

                            <p>En este caso, tenemos la ruta del inicio, donde se muestran las posts principalmente, como hemos visto anteriormente la ruta donde se alojan las imágenes está en la ruta uploads/. </p>
                            <img src="../img/lf3.png" width="1200px" height="600px">
                            
                            <p>Como se puede ver, se está en un entorno local. Si fuera en un entorno de producción. Se tendría que restringir para los usuarios esta misma ruta para que no se pueda acceder a datos sensibles de otros usuarios, 
                                o a recursos internos de la propia aplicación. Se va a ejecutar el archivo malicioso que se ha subido en PHP y ver qué sucede. Se ejecuta un alert donde nos está avisando que es un archivo malicioso, tras aceptar el alert,
                                 nos redirecciona a la página que hemos creado y tras esperar unos segundos nos redirecciona a una página que se ha puesto de ejemplo en este caso, pero que podría haber sido una página de phishing.</p>
                                 <img src="../img/lf4.png" width="1000px" height="900px"> <br><br><br><br>
                            
                                 <img src="../img/lf5.png" width="1600px" height="400px"><br><br>
                                 <img src="../img/lf6.png" width="1600px" height="400px"><br><br>
                                 <img src="../img/lf7.png" width="1600px" height="800px"><br><br>

                                 <p>Para poder ver mejor como funciona este script, se va a adjuntar el código que se ha planteado: </p>
                                 <p>En este caso para poder subir este código está en la carpeta de <strong>/uploads</strong> para poder subirlo y ver de qué manera funciona.</p>
                                 <img src="../img/lf8.png" width="700px" height="700px"><br><br>

                            <p>Para evitar estas vulnerabilidades mencionadas anteriormente vamos a mejorar este código:</p>
                            <p>1. Validación y sanitización de las rutas en Local File Inclusion (LFI):</p>
                                    <ul>
                                        <li>Se usa realpath() para obtener la ruta absoluta del archivo y se verifica que esté dentro del directorio permitido. Esto previene que un atacante manipule la ruta para incluir archivos fuera de los límites permitidos.</li>
                                        <li>Solo se permiten nombres de archivos predefinidos que cumplen con un patrón específico. </li>
                                    </ul>
                            <p>2. Validación de URLs para evitar Open Redirect: </p>   
                                    <ul>
                                        <li>Se valida que las rutas de redirección sean internas o correspondan a un conjunto de URLs predefinidas. </li>
                                        <li>En lugar aceptar cualquier entrada del usuario, se utiliza un sistema de mapeo seguro para las rutas válidas. </li>
                                    </ul>

                                 



                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal para CSRF -->
<div class="modal fade" id="modalCSRF" tabindex="-1" aria-labelledby="modalCSRFLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalCSRFLabel">CSRF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-padding">
                   <h3>Falsificación de solicitud entre sitios (CSRF)</h3>
                   <p>En esta sección, explicaremos qué es la falsificación de solicitud entre sitios, describiremos algunos ejemplos de vulnerabilidades CSRF comunes y explicaremos cómo prevenir ataques CSRF.</p>
                   <h3>¿Qué es CSRF?</h3>
                   <p>La falsificación de solicitud entre sitios (también conocida como CSRF) es una vulnerabilidad de seguridad web que permite a un atacante inducir a los usuarios a realizar acciones que no tienen intención de realizar. Permite a un atacante eludir parcialmente la política de mismo origen, que está diseñada para evitar que diferentes sitios web interfieran entre sí.</p>
                   <img src="../img/cross-site request forgery.svg" alt="">
                   <h3>¿Cuál es el impacto de un ataque CSRF?</h3>
                   <p>En un ataque CSRF exitoso, el atacante hace que el usuario víctima realice una acción de forma no intencionada. Por ejemplo, puede ser cambiar la dirección de correo electrónico de su cuenta, cambiar su contraseña o realizar una transferencia de fondos. Según la naturaleza de la acción, el atacante podría obtener el control total de la cuenta del usuario. Si el usuario afectado tiene un rol privilegiado dentro de la aplicación, el atacante podría obtener el control total de todos los datos y funciones de la aplicación.</p>
                   <h3>¿Cómo funciona CSRF?</h3>
                   <p>Para que sea posible un ataque CSRF, deben cumplirse tres condiciones clave:</p>
                   <ul>
                        <li><strong>Una acción relevante.</strong> Hay una acción dentro de la aplicación que el atacante tiene motivos para inducir. Puede ser una acción privilegiada (como modificar los permisos de otros usuarios) o cualquier acción sobre datos específicos del usuario (como cambiar la contraseña del usuario).</li>
                        <li><strong>Manejo de sesiones basado en cookies.</strong> Para realizar la acción se deben emitir una o más solicitudes HTTP y la aplicación se basa únicamente en las cookies de sesión para identificar al usuario que realizó las solicitudes. No existe ningún otro mecanismo para realizar el seguimiento de las sesiones o validar las solicitudes de los usuarios.</li>
                        <li><strong>Sin parámetros de solicitud impredecibles.</strong> Las solicitudes que realizan la acción no contienen ningún parámetro cuyos valores el atacante no pueda determinar o adivinar. Por ejemplo, al hacer que un usuario cambie su contraseña, la función no es vulnerable si un atacante necesita saber el valor de la contraseña existente.</li>
                   </ul>
                   <p>Por ejemplo, supongamos que una aplicación contiene una función que permite al usuario cambiar la dirección de correo electrónico de su cuenta. Cuando un usuario realiza esta acción, realiza una solicitud HTTP como la siguiente:</p>
                   <code>POST /email/change HTTP/1.1 <br>
                    Host: vulnerable-website.com <br>
                    Content-Type: application/x-www-form-urlencoded <br>
                    Content-Length: 30 <br>
                    Cookie: session=yvthwsztyeQkAPzeQ5gHgTvlyxHfsAfE <br>
                    email=wiener@normal-user.com</code><br>

                    <p>Esto cumple las condiciones requeridas para CSRF:</p>
                    <ul>
                        <li>La acción de cambiar la dirección de correo electrónico de la cuenta de un usuario es de interés para un atacante. Después de esta acción, el atacante normalmente podrá activar un restablecimiento de contraseña y tomar el control total de la cuenta del usuario.</li>
                        <li>La aplicación utiliza una cookie de sesión para identificar qué usuario realizó la solicitud. No existen otros tokens ni mecanismos para realizar un seguimiento de las sesiones de los usuarios.</li>
                        <li>El atacante puede determinar fácilmente los valores de los parámetros de solicitud que se necesitan para realizar la acción.</li>
                    </ul>
                    <p>Con estas condiciones establecidas, el atacante puede construir una página web que contenga el siguiente HTML: <strong>https://vulnerable-website.com/email/change</strong></p>
                    <p>Si un usuario víctima visita la página web del atacante, sucederá lo siguiente:</p>
                    <ul>
                        <li>La página del atacante activará una solicitud HTTP al sitio web vulnerable.</li>
                        <li>Si el usuario inicia sesión en el sitio web vulnerable, su navegador incluirá automáticamente su cookie de sesión en la solicitud (suponiendo que no se estén utilizando cookies de SameSite).</li>
                        <li>El sitio web vulnerable procesará la solicitud de la forma habitual, la tratará como si hubiera sido realizada por el usuario víctima y cambiará su dirección de correo electrónico.</li>
                    </ul>
                    <h3>Cómo entregar un exploit CSRF</h3>
                    <p>Los mecanismos de entrega para los ataques de falsificación de solicitudes entre sitios son esencialmente los mismos que para el XSS reflejado. Normalmente, el atacante colocará el HTML malicioso en un sitio web que controla y luego inducirá a las víctimas a visitar ese sitio web. Esto se puede hacer proporcionando al usuario un enlace al sitio web, a través de un correo electrónico o un mensaje de redes sociales. O si el ataque se realiza en un sitio web popular (por ejemplo, en un comentario de un usuario), es posible que simplemente esperen a que los usuarios visiten el sitio web.

                        Tenga en cuenta que algunos exploits CSRF simples emplean el método GET y pueden ser completamente autónomos con una única URL en el sitio web vulnerable. En esta situación, es posible que el atacante no necesite emplear un sitio externo y puede enviar directamente a las víctimas una URL maliciosa en el dominio vulnerable. En el ejemplo anterior, si la solicitud para cambiar la dirección de correo electrónico se puede realizar con el método GET, entonces un ataque autónomo se vería así:</p>
                        <code>&lt;img src="https://vulnerable-website.com/email/change?email=pwned@evil-user.net"&gt;</code>
                    <h3>Defensas comunes contra CSRF</h3>
                    <p>Hoy en día, encontrar y explotar con éxito las vulnerabilidades CSRF a menudo implica eludir las medidas anti-CSRF implementadas por el sitio web de destino, el navegador de la víctima o ambos. Las defensas más comunes que encontrará son las siguientes:</p>
                    <ul>
                        <li><strong>Tokens CSRF:</strong> un token CSRF es un valor único, secreto e impredecible que genera la aplicación del lado del servidor y se comparte con el cliente. Al intentar realizar una acción confidencial, como enviar un formulario, el cliente debe incluir el token CSRF correcto en la solicitud. Esto hace que sea muy difícil para un atacante elaborar una solicitud válida en nombre de la víctima.</li>
                        <li><strong>Cookies de SameSite:</strong> SameSite es un mecanismo de seguridad del navegador que determina cuándo las cookies de un sitio web se incluyen en las solicitudes que se originan en otros sitios web. Como las solicitudes para realizar acciones confidenciales generalmente requieren una cookie de sesión autenticada, las restricciones apropiadas de SameSite pueden impedir que un atacante active estas acciones entre sitios. Desde 2021, Chrome aplica restricciones Lax SameSite de forma predeterminada. Como este es el estándar propuesto, esperamos que otros navegadores importantes adopten este comportamiento en el futuro.</li>
                        <li><strong>Validación basada en referente:</strong> algunas aplicaciones utilizan el encabezado HTTP Referer para intentar defenderse contra ataques CSRF, normalmente verificando que la solicitud se originó en el propio dominio de la aplicación. Generalmente, esto es menos efectivo que la validación de tokens CSRF.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para SSRF -->
    <div class="modal fade" id="modalSSRF" tabindex="-1" aria-labelledby="modalSSRFLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalSSRFLabel">SSRF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-padding">
                    <h3>Falsificación de solicitudes del lado del servidor (SSRF)</h3>
                    <p>En esta sección explicamos qué es la falsificación de solicitudes del lado del servidor (SSRF) y describimos algunos ejemplos comunes. También le mostramos cómo encontrar y explotar las vulnerabilidades de la SSRF.</p>
                    <h3>¿Qué es SSRF?</h3>
                    <p>La falsificación de solicitudes del lado del servidor es una vulnerabilidad de seguridad web que permite a un atacante hacer que la aplicación del lado del servidor realice solicitudes a una ubicación no deseada.
                    En un ataque SSRF típico, el atacante podría hacer que el servidor realice una conexión a servicios solo internos dentro de la infraestructura de la organización. En otros casos, pueden forzar al servidor a conectarse a sistemas externos arbitrarios. 
                    Esto podría filtrar datos confidenciales, como credenciales de autorización.</p>
                    <img src="../img/server-side request forgery.svg" alt="">
                    <h3>¿Cuál es el impacto de los ataques de la SSRF?</h3>
                    <p>Un ataque SSRF exitoso a menudo puede resultar en acciones no autorizadas o acceso a datos dentro de la organización. Esto puede ser en la aplicación vulnerable o en otros sistemas de back-end con los que la aplicación puede comunicarse. En algunas situaciones, la vulnerabilidad SSRF podría permitir que un atacante realice la ejecución de comandos arbitrarios.
                    Un exploit SSRF que causa conexiones a sistemas externos de terceros puede provocar ataques maliciosos. Estos pueden parecer originarios de la organización que aloja la aplicación vulnerable.</p>
                    <h3>Ataques comunes de la SSRF</h3>
                    <p>Los ataques de la SSRF a menudo explotan las relaciones de confianza para escalar un ataque desde la aplicación vulnerable y realizar acciones no autorizadas. Estas relaciones de confianza pueden existir en relación con el servidor, o en relación con otros sistemas de back-end dentro de la misma organización.</p>
                    <h4>ataques SSRF contra el servidor</h4>
                    <p>En un ataque SSRF contra el servidor, el atacante hace que la aplicación realice una solicitud HTTP al servidor que aloja la aplicación, a través de su interfaz de red de bucle invertido. Esto generalmente implica suministrar una URL con un nombre de host como 127.0.0.1 (una dirección IP reservada que apunta al adaptador de bucle invertido) o localhost (un nombre comúnmente utilizado para el mismo adaptador).
                    Por ejemplo, imagine una aplicación de compras que le permita al usuario ver si un artículo está en stock en una tienda en particular. Para proporcionar la información de stock, la aplicación debe consultar varias API REST de back-end. Lo hace pasando la URL al punto final de la API de back-end relevante a través de una solicitud HTTP de front-end. Cuando un usuario ve el estado del stock de un artículo, su navegador realiza la siguiente solicitud:</p>
                    <code>POST /product/stock HTTP/1.0 <br>
                    Content-Type: application/x-www-form-urlencoded <br>
                    Content-Length: 118 <br>
                    stockApi=http://stock.weliketoshop.net:8080/product/stock/check%3FproductId%3D6%26storeId%3D1</code> <br>
                    <p>Esto hace que el servidor realice una solicitud a la URL especificada, recupere el estado del stock y lo devuelva al usuario. En este ejemplo, un atacante puede modificar la solicitud para especificar una URL local en el servidor:</p>
                    <code>
                    POST /product/stock HTTP/1.0 <br>
                    Content-Type: application/x-www-form-urlencoded <br>
                    Content-Length: 118 <br>
                    stockApi=http://localhost/admin <br>
                    </code>
                    <p>El servidor obtiene el contenido de la /admin URL y lo devuelve al usuario.
                    Un atacante puede visitar el /admin URL, pero la funcionalidad administrativa normalmente solo es accesible para usuarios autenticados. Esto significa que un atacante no verá nada de interés. 
                    Sin embargo, si la solicitud a la /admin La URL proviene de la máquina local, 
                    los controles de acceso normales se omiten. La solicitud otorga acceso completo a la funcionalidad administrativa, ya que la solicitud parece originarse desde una ubicación confiable.</p>
                    <h4>ataques SSRF contra otros sistemas back-end</h4>
                    <p>En algunos casos, el servidor de aplicaciones puede interactuar con sistemas de back-end que los usuarios no pueden acceder directamente. Estos sistemas a menudo tienen direcciones IP privadas no enrutables. Los sistemas de back-end normalmente están protegidos por la topología de red, por lo que a menudo tienen una postura de seguridad más débil. En muchos casos, los sistemas internos de back-end contienen funcionalidades sensibles a las que cualquier persona que pueda interactuar con los sistemas puede acceder sin autenticación.
                    En el ejemplo anterior, imagine que hay una interfaz administrativa en la URL de back-end https://192.168.0.68/admin. Un atacante puede enviar la siguiente solicitud para explotar la vulnerabilidad SSRF y acceder a la interfaz administrativa:</p>
                    <code>POST /product/stock HTTP/1.0 <br>
                    Content-Type: application/x-www-form-urlencoded <br>
                    Content-Length: 118 <br>
                    stockApi=http://192.168.0.68/admin</code> <br>
                    <h4>SSRF con filtros de entrada basados en lista negra</h4>
                    <p>Algunas aplicaciones bloquean la entrada que contiene nombres de host como 127.0.0.1 y localhost, o URL sensibles como /admin. En esta situación, a menudo puede eludir el filtro utilizando las siguientes técnicas:</p>
                    <ul>
                        <li>Utilice una representación IP alternativa de 127.0.0.1, como 2130706433, 017700000001, o 127.1.</li>
                        <li>Registre su propio nombre de dominio que resuelve 127.0.0.1. Puedes usar spoofed.burpcollaborator.net para este propósito.</li>
                        <li>Obfuscar cadenas bloqueadas usando codificación URL o variación de casos.</li>
                        <li>Proporcione una URL que controle, que redirige a la URL de destino. Intente usar diferentes códigos de redirección, así como diferentes protocolos para la URL de destino. Por ejemplo, cambiar de un http: a https: Se ha demostrado que la URL durante la redirección omite algunos filtros anti-SSRF.</li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal para XXE -->
        <div class="modal fade" id="modalXXE" tabindex="-1" aria-labelledby="modalXXELabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalXXELabel">XXE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <h3>Inyección de entidad externa XML (XXE)</h3>
                        <p>En esta sección, explicaremos qué es la inyección de entidad externa XML, describiremos algunos ejemplos comunes, explicaremos cómo encontrar y explotar varios tipos de inyección XXE y 
                            resumir cómo prevenir los ataques de inyección XXE.</p>
                        <h3> ¿Qué es la inyección de entidad externa XML?</h3>
                        <p> 
                            La inyección de entidad externa XML (también conocida como XXE) es una vulnerabilidad de seguridad web que permite a un atacante interferir con el procesamiento de datos XML de una aplicación. 
                            A menudo permite a un atacante ver archivos en el sistema de archivos del servidor de aplicaciones e interactuar con cualquier sistema back-end o externo al que la propia aplicación pueda acceder.
                            En algunas situaciones, un atacante puede intensificar un ataque XXE para comprometer el servidor subyacente u otra infraestructura de back-end, aprovechando
                             la vulnerabilidad XXE para realizar ataques de falsificación de solicitudes del lado del servidor (SSRF).</p>
                        <img src="../img/xxe-injection.svg" alt="">
                        <h3>¿Cómo surgen las vulnerabilidades XXE?</h3>
                        <p> 
                            Algunas aplicaciones utilizan el formato XML para transmitir datos entre el navegador y el servidor. Las aplicaciones que hacen esto prácticamente siempre utilizan una biblioteca estándar o una plataforma API para procesar los datos XML en el servidor. Las vulnerabilidades XXE surgen porque la especificación XML contiene varias características potencialmente peligrosas
                             y los analizadores estándar admiten estas características incluso si la aplicación no las utiliza normalmente.</p>
                        <h3>¿Cuáles son los tipos de ataques XXE?</h3>
                        <p>Existen varios tipos de ataques XXE:</p>
                            <ul>
                                <li>Explotar XXE para recuperar archivos, donde se define una entidad externa que contiene el contenido de un archivo y se devuelve en la respuesta de la aplicación.</li>
                                <li>Explotar XXE para realizar ataques SSRF, donde se define una entidad externa en función de una URL a un sistema back-end.</li>
                                <li> La explotación ciega de XXE extrae datos fuera de banda, donde los datos confidenciales se transmiten desde el servidor de aplicaciones a un sistema que controla el atacante.</li>
                                <li>Explotar Blind XXE para recuperar datos a través de mensajes de error, donde el atacante puede activar un mensaje de error de análisis que contiene datos confidenciales.</li>
                            </ul>
                        <h3>Explotando XXE para recuperar archivos</h3>
                        <p>Para realizar un ataque de inyección XXE que recupere un archivo arbitrario del sistema de archivos del servidor, debe modificar el XML enviado de dos maneras:</p>
                        <ul>
                            <li>Introduzca (o edite) un elemento DOCTYPE que defina una entidad externa que contenga la ruta al archivo.</li>
                            <li>xEdite un valor de datos en el XML que se devuelve en la respuesta de la aplicación, para hacer uso de la entidad externa definida.</li>
                        </ul>
                        <p>Por ejemplo, supongamos que una aplicación de compras verifica el nivel de existencias de un producto enviando el siguiente XML al servidor:</p>
                        <code class="code-scrollable">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
                            &lt;stockCheck&gt;&lt;productId&gt;381&lt;/productId&gt;&lt;/stockCheck&gt;</code>

                        <p>The application performs no particular defenses against XXE attacks, so you can exploit the XXE vulnerability to retrieve the /etc/passwd file by submitting the following XXE payload:</p>
                        <code class="code-scrollable">&lt;?xml version="1.0" encoding="UTF-8"?&gt; <br>
                            &lt;!DOCTYPE foo [ &lt;!ENTITY xxe SYSTEM "file:///etc/passwd"&gt; ]&gt; <br>
                            &lt;stockCheck&gt;&lt;productId&gt;&amp;xxe;&lt;/productId&gt;&lt;/stockCheck&gt;</code> <br>

                        <p>This XXE payload defines an external entity &xxe; whose value is the contents of the /etc/passwd file and uses the entity within the productId value. This causes the application's response to include the contents of the file:</p>
                        <code class="code-scrollable">Invalid product ID: root:x:0:0:root:/root:/bin/bash <br>
                            daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin <br>
                            bin:x:2:2:bin:/bin:/usr/sbin/nologin <br>
                            ...</code> <br>
                        <h3>Cómo prevenir las vulnerabilidades XXE</h3>
                        <p> Prácticamente todas las vulnerabilidades de XXE surgen porque la biblioteca de análisis XML de la aplicación admite funciones XML potencialmente peligrosas que la aplicación no necesita ni pretende utilizar. La forma más sencilla y eficaz de prevenir ataques XXE es desactivar esas funciones.
                            Generalmente, es suficiente deshabilitar la resolución de entidades externas y deshabilitar la compatibilidad con XInclude. Por lo general, esto se puede hacer mediante opciones de configuración o anulando mediante programación el comportamiento predeterminado.
                            Consulte la documentación de su biblioteca de análisis XML o API para obtener detalles sobre cómo deshabilitar capacidades innecesarias.</p>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para XXE -->
        <div class="modal fade" id="modalXSS" tabindex="-1" aria-labelledby="modalXSSLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalXSSLabel">XSS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <p> 
                            En esta sección, explicaremos qué son las secuencias de comandos entre sitios, describiremos las diferentes 
                            variedades de vulnerabilidades de las secuencias de comandos entre sitios y explicaremos cómo encontrar y prevenir las secuencias de comandos entre sitios.</p>
                        <h3>¿Qué son las secuencias de comandos entre sitios (XSS)?</h3>
                        <p>Las secuencias de comandos entre sitios (también conocidas como XSS) son una vulnerabilidad de seguridad web que permite a un atacante comprometer las interacciones que los usuarios tienen con una aplicación vulnerable. Permite a un atacante eludir la misma política de origen, que está diseñada para segregar diferentes sitios web entre sí. Las vulnerabilidades de secuencias de comandos entre sitios normalmente permiten a un atacante hacerse pasar por un usuario víctima, llevar a cabo cualquier acción que el usuario pueda realizar y acceder a cualquiera de sus datos.
                        Si el usuario víctima tiene acceso privilegiado dentro de la aplicación, entonces el atacante podría obtener control total sobre todas las funciones y datos de la aplicación.</p>
                        <h3> ¿Cómo funciona un XSS?</h3>
                        <p>Las secuencias de comandos entre sitios funcionan manipulando un sitio web vulnerable para
                        que devuelva JavaScript malicioso a los usuarios. Cuando el código malicioso se ejecuta dentro del navegador de la víctima, el atacante puede comprometer completamente su interacción con la aplicación.</p>
                        <img src="../img/cross-site-scripting.svg" alt="">
                        
                        <h3>Prueba de concepto XSS</h3>
                        <p> 
                            Puede confirmar la mayoría de los tipos de vulnerabilidad XSS inyectando una carga útil que haga que su propio navegador ejecute algún JavaScript arbitrario. Durante mucho tiempo ha sido una práctica común utilizar la función alert() para este propósito porque es breve, inofensiva y bastante difícil de pasar por alto cuando se llama correctamente. De hecho, la mayoría de nuestras prácticas de laboratorio XSS se resuelven invocando alert() en el navegador de una víctima simulada.
                            Desafortunadamente, hay un pequeño problema si usas Chrome. A partir de la versión 92 (20 de julio de 2021), los iframes de origen cruzado no pueden llamar a alert(). Como se utilizan para construir algunos de los ataques XSS más avanzados, en ocasiones necesitarás utilizar una carga útil PoC alternativa. En este escenario, recomendamos la función print(). Si está interesado en obtener más información sobre este cambio y por qué nos gusta print(), consulte nuestra publicación de blog sobre el tema.
                            Como la víctima simulada en nuestros laboratorios usa Chrome, modificamos los laboratorios afectados para que también puedan resolverse usando print(). Lo hemos indicado en las instrucciones siempre que sea relevante.</p>
                        <h3>¿Cuáles son los tipos de ataques XSS?</h3>
                        <p>Hay tres tipos principales de ataques XSS. Estos son:</p>
                        <ul>
                            <li>XSS reflejado, donde el script malicioso proviene de la solicitud HTTP actual.</li>
                            <li>XSS almacenado, de donde proviene el script malicioso de la base de datos del sitio web.</li>
                            <li>XSS basado en DOM, donde la vulnerabilidad existe en el código del lado del cliente en lugar del código del lado del servidor.</li>
                        </ul>
                        <h3>Scripts entre sitios reflejados</h3>
                        <p>XSS reflejado es la variedad más simple de secuencias de comandos de sitios cruzados. Surge cuando una aplicación recibe datos en una solicitud HTTP e incluye esos datos dentro de la respuesta inmediata de manera insegura.
                            Aquí hay un ejemplo simple de una vulnerabilidad XSS reflejada:</p>
                        <code>https://insecure-website.com/status?message=All+is+well.
                            <p>Status: All is well.</p></code>
                        <p>La aplicación no realiza ningún otro procesamiento de los datos, por lo que un atacante puede fácilmente construir un ataque como este:</p>
                        <code>https://insecure-website.com/status?message=<script>/*+Bad+stuff+here...+*/</script>
                            <p>Status: <script>/* Bad stuff here... */</script></p></code>
                        <p> 
                            Si el usuario visita la URL construida por el atacante, entonces el script del atacante se ejecuta en el navegador del usuario,
                            en el contexto de la sesión de ese usuario con la aplicación. En ese punto, el script puede realizar cualquier acción y recuperar cualquier dato al que el usuario tenga acceso.</p>
                        <h3>Secuencias de comandos entre sitios almacenadas</h3>
                        <p>Stored XSS (also known as persistent or second-order XSS) arises when an application receives data from an untrusted source and includes that data within its later HTTP responses in an unsafe way.
                            The data in question might be submitted to the application via HTTP requests; for example, comments on a blog post, user nicknames in a chat room, or contact details on a customer order. In other cases, the data might arrive from other untrusted sources; for example, a webmail application displaying messages received over SMTP, a marketing application displaying social media posts, or a network monitoring application displaying packet data from network traffic.
                            Here is a simple example of a stored XSS vulnerability. A message board application lets users submit messages, which are displayed to other users:</p>   
                        <code><p>Hello, this is my message!</p></code>
                        <p>La aplicación no realiza ningún otro procesamiento de los datos, por lo que un atacante puede enviar fácilmente un mensaje que ataque a otros usuarios:</p>
                        <code><p><script>/* Bad stuff here... */</script></p></code>
                        <h3>DOM-based cross-site scripting</h3>
                        <p> 
                            El XSS basado en DOM (también conocido como DOM XSS) surge cuando una aplicación contiene JavaScript del lado del cliente que procesa datos de una fuente que no es de confianza de forma insegura, normalmente escribiendo los datos en el DOM.
                            En el siguiente ejemplo, una aplicación utiliza algo de JavaScript para leer el valor de un campo de entrada y escribir ese valor en un elemento dentro del HTML:</p>
                        <code>var search = document.getElementById('search').value;
                            var results = document.getElementById('results');
                            results.innerHTML = 'You searched for: ' + search;</code>
                        <p>Si el atacante puede controlar el valor del campo de entrada, puede construir fácilmente un valor malicioso que haga que se ejecute su propio script:</p>
                        <code>You searched for: <img src=1 onerror='/* Bad stuff here... */'></code>
                        <p>
                            En un caso típico, el campo de entrada se poblaría a partir de parte de la solicitud HTTP, como un parámetro de cadena de consulta de URL, lo que permite al atacante entregar un ataque usando una URL maliciosa, de la misma manera que XSS reflejado.</p>
                        <h3>Cómo prevenir ataques XSS</h3>
                        <p>Prevenir las secuencias de comandos entre sitios es trivial en algunos casos, pero puede ser mucho más difícil dependiendo de la complejidad de la aplicación y la forma en que maneja los datos controlables por el usuario.

                            En general, es probable que prevenir eficazmente las vulnerabilidades XSS implique una combinación de las siguientes medidas:</p>
                        <ul>
                            <li><strong>Filtrar la entrada a la llegada.</strong>En el punto donde se recibe la entrada del usuario, filtre lo más estrictamente posible en función de lo que se espera o de la entrada válida.</li>
                            <li><strong>Codificar datos en la salida.</strong> En el punto donde se generan datos controlables por el usuario en respuestas HTTP, codifique la salida para evitar que se interprete como contenido activo. Dependiendo del contexto de salida, esto podría requerir la aplicación de combinaciones de codificación HTML, URL, JavaScript y CSS.</li>
                            <li><strong>Política de seguridad de contenido (CSP).</strong> Como última línea de defensa, puede utilizar la Política de seguridad de contenido (CSP) para reducir la gravedad de cualquier vulnerabilidad XSS que aún ocurra.</li>
                        </ul>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para JWT Attacks -->
        <div class="modal fade" id="modalJWT" tabindex="-1" aria-labelledby="modalJWTLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalJWTLabel">JWT Attacks</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <p>En esta sección, veremos cómo los problemas de diseño y el manejo defectuoso de los tokens web JSON (JWT) pueden dejar a los sitios web vulnerables a una variedad de ataques de alta gravedad. Como los JWT se usan más comúnmente en los mecanismos de autenticación, administración de sesiones y control de acceso, estas vulnerabilidades pueden comprometer todo el sitio web y sus usuarios.
                        No se preocupe si no está familiarizado con los JWT y cómo funcionan, cubriremos todos los detalles relevantes a medida que avanzamos. También hemos proporcionado una serie de laboratorios deliberadamente vulnerables para que pueda practicar la explotación de estas vulnerabilidades de forma segura contra objetivos realistas.</p>
                        <img src="../img/jwt-infographic.jpg" alt=""> <br> <br>
                        <h3>¿Qué son los JWT?</h3>
                        <p>Los tokens web JSON (JWT) son un formato estandarizado para enviar datos JSON firmados criptográficamente entre sistemas. Teóricamente, pueden contener cualquier tipo de datos, pero se usan más comúnmente para enviar información ("reclamaciones") sobre los usuarios como parte de la autenticación, el manejo de sesiones y los mecanismos de control de acceso.
                        A diferencia de los tokens de sesión clásicos, todos los datos que necesita un servidor se almacenan en el lado del cliente dentro del propio JWT.
                        Esto hace que los JWT sean una opción popular para sitios web altamente distribuidos donde los usuarios necesitan interactuar sin problemas con múltiples servidores de back-end.</p>
                        <h3>Formato JWT</h3>
                        <p>Un JWT consta de 3 partes: a encabezado, a carga útily a firma. Estos están separados por un punto, como se muestra en el siguiente ejemplo:</p>
                        <code>eyJraWQiOiI5MTM2ZGRiMy1jYjBhLTRhMTktYTA3ZS1lYWRmNWE0NGM4YjUiLCJhbGciOiJSUzI1NiJ9 <br>
                            .eyJpc3MiOiJwb3J0c3dpZ2dlciIsImV4cCI6MTY0ODAzNzE2NCwibmFtZSI6IkNhcmxvcyBNb250b3lhIiwic3ViIjoiY2Fy<br>
                            bG9zIiwicm9sZSI6ImJsb2dfYXV0aG9yIiwiZW1haWwiOiJjYXJsb3NAY2FybG9zLW1vbnRveWEubmV0IiwiaWF0<br>
                            IjoxNTE2MjM5MDIyfQ.SYZBPIBg2CRjXAJ8vCER0LA_ENjII1JakvNQoP-Hw6GG1zfl4JyngsZReIfqRvIAEi5L4HV0q7_9qGhQZvy<br>
                            9ZdxEJbwTxRs_6Lb-fZTDpW6lKYNdMyjw45_alSCZ1fypsMWz_2mTpQzil0lOtps5Ei_z7mM7M8gCwe_AGpI53JxduQOaB5HkT5gVr<br>
                            v9cKu9CsW5MS6ZbqYXpGyOG5ehoxqm8DL5tFYaW3lB50ELxi0KsuTKEbD0t5BCl0aCR2MBJWAbN-xeLwEenaqBiwPVvKixYleeDQiBEIylFdNNIMviKRgXiYuAvMziVPbwSgkZVHeEdF5MQP1Oe2Spac-6IfA</code><br>
                            <p>Las partes de encabezado y carga útil de un JWT son solo objetos JSON codificados en base64url. El encabezado contiene metadatos sobre el token en sí, mientras que la carga útil contiene las "reclamaciones" reales sobre el usuario. Por ejemplo, puede decodificar la carga útil del token anterior para revelar las siguientes afirmaciones:</p>
                            <code>{ <br>
                                    "iss": "portswigger", <br>
                                    "exp": 1648037164, <br>
                                    "name": "Carlos Montoya", <br>
                                    "sub": "carlos", <br>
                                    "role": "blog_author", <br>
                                    "email": "carlos@carlos-montoya.net", <br>
                                    "iat": 1516239022 <br>
                                }</code>
                            <p>En la mayoría de los casos, estos datos pueden ser fácilmente leídos o modificados por cualquier persona con acceso al token. Por lo tanto, la seguridad de cualquier mecanismo basado en JWT depende en gran medida de la firma criptográfica.</p>
                            <h3>Firma JWT</h3>
                            <p>El servidor que emite el token generalmente genera la firma al hash del encabezado y la carga útil. En algunos casos, también cifran el hash resultante. De cualquier manera, este proceso implica una clave de firma secreta. 
                                Este mecanismo proporciona una forma para que los servidores verifiquen que ninguno de los datos dentro del token ha sido manipulado desde que se emitió:</p>
                            <ul>
                                <li>Como la firma se deriva directamente del resto del token, cambiar un solo byte del encabezado o la carga útil da como resultado una firma no coincidente.</li>
                                <li>Sin conocer la clave de firma secreta del servidor, no debería ser posible generar la firma correcta para un encabezado o carga útil determinada.</li>
                            </ul>
                            <h3>JWT vs JWS vs JWE</h3>
                            <p>La especificación JWT es en realidad muy limitada. Solo define un formato para representar información ("reclamaciones") como un objeto JSON que se puede transferir entre dos partes. En la práctica, 
                                los JWT no se utilizan realmente como una entidad independiente. La especificación JWT se amplía tanto por las especificaciones JSON Web Signature (JWS) como por JSON Web Encryption (JWE), que definen formas concretas de implementar JWT.</p>
                            <img src="../img/jwt-jws-jwe.jpg" alt=""> <br>
                            <p>En otras palabras, un JWT suele ser un token JWS o JWE. Cuando las personas usan el término "JWT", casi siempre significan un token JWS. 
                                Los JWE son muy similares, excepto que el contenido real del token está encriptado en lugar de solo codificado.</p>
                            <h3>¿Qué son los ataques JWT?</h3>
                            <p>Los ataques JWT implican que un usuario envíe JWT modificados al servidor para lograr un objetivo malicioso. 
                            Por lo general, este objetivo es eludir los controles de autenticación y acceso haciéndose pasar por otro usuario que ya ha sido autenticado.</p>
                            <h3>¿Cuál es el impacto de los ataques JWT?</h3>
                            <p>El impacto de los ataques JWT suele ser grave. Si un atacante puede crear sus propios tokens válidos con valores arbitrarios, puede escalar sus propios privilegios o hacerse pasar por otros usuarios, tomando el control total de sus cuentas.</p>
                            <h3>¿Cómo surgen las vulnerabilidades a los ataques JWT?</h3>
                            <p>Las vulnerabilidades de JWT generalmente surgen debido al manejo defectuoso de JWT dentro de la propia aplicación. El varias especificaciones los JWT relacionados con ellos son relativamente flexibles por diseño, lo que permite a los desarrolladores de sitios web decidir muchos detalles de implementación por sí mismos. Esto puede hacer que introduzcan vulnerabilidades accidentalmente incluso cuando se usan bibliotecas endurecidas por la batalla.
                            Estas fallas de implementación generalmente significan que la firma del JWT no se verifica correctamente. Esto permite a un atacante alterar los valores pasados a la aplicación a través de la carga útil del token. Incluso si la firma se verifica de manera sólida, si realmente se puede confiar depende en gran medida de que la clave secreta del servidor siga siendo un secreto. Si esta clave se filtra de alguna manera, 
                            o se puede adivinar o forzar brutamente, un atacante puede generar una firma válida para cualquier token arbitrario, comprometiendo todo el mecanismo.</p>
                            <h3>Explotar la verificación de firma JWT defectuosa</h3>
                            <p>Por diseño, los servidores generalmente no almacenan ninguna información sobre los JWT que emiten. En cambio, cada token es una entidad totalmente autónoma. Esto tiene varias ventajas, pero también introduce un problema fundamental: el servidor en realidad no sabe nada sobre el contenido original del token, o incluso cuál era la firma original. Por lo tanto, si el servidor no verifica la firma correctamente, no hay nada que impida que un atacante realice cambios arbitrarios en el resto del token.</p>
                            <p>Por ejemplo, considere un JWT que contiene las siguientes reivindicaciones:</p>
                            <code>
                            { <br>
                                "username": "carlos", <br>
                                "isAdmin": false <br>
                            } <br>
                            </code>
                            <p>Si el servidor identifica la sesión en base a esto username, modificar su valor podría permitir que un atacante se haga pasar por otros usuarios registrados. Del mismo modo, si el isAdmin el valor se utiliza para el control de acceso, esto podría proporcionar un vector simple para la escalada de privilegios.
                            En el primer par de laboratorios, verá algunos ejemplos de cómo podrían verse estas vulnerabilidades en las aplicaciones del mundo real.</p>
                            <h3>Cómo prevenir ataques JWT</h3>
                            <p>Puede proteger sus propios sitios web contra muchos de los ataques que hemos cubierto tomando las siguientes medidas de alto nivel:</p>
                            <ul>
                                <li>Use una biblioteca actualizada para manejar JWT y asegúrese de que sus desarrolladores entiendan completamente cómo funciona, junto con cualquier implicación de seguridad. Las bibliotecas modernas hacen que sea más difícil para usted implementarlas inadvertidamente de manera insegura, pero esto no es infalible debido a la flexibilidad inherente de las especificaciones relacionadas.</li>
                                <li>Asegúrese de realizar una verificación de firma sólida en cualquier JWT que reciba y tenga en cuenta casos de borde como JWT firmados utilizando algoritmos inesperados.</li>
                                <li>Hacer cumplir una lista blanca estricta de hosts permitidos para el jku encabezado.</li>
                                <li>Asegúrese de no ser vulnerable al recorrido de la ruta o a la inyección SQL a través del kid parámetro de encabezado.</li>
                            </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para OS Command Injection -->
        <div class="modal fade" id="modalCommandInjection" tabindex="-1" aria-labelledby="modalCommandInjectionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalCommandInjectionLabel">OS Command Injection</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <p>En esta sección, explicamos qué es la inyección de comandos del SO y describimos cómo se pueden detectar y explotar las vulnerabilidades. También le mostramos algunos comandos y técnicas útiles para diferentes sistemas operativos, y describimos cómo prevenir la inyección de comandos del SO.</p>
                        <img src="../img/os-command-injection.svg" alt="">
                        <h3>¿Qué es la inyección de comandos OS?</h3>
                        <p>La inyección de comandos OS también se conoce como inyección de shell. Permite a un atacante ejecutar comandos del sistema operativo (OS) en el servidor que ejecuta una aplicación y, por lo general, compromete completamente la aplicación y sus datos. A menudo, un atacante puede aprovechar una vulnerabilidad de inyección de comandos del SO para comprometer otras partes de la infraestructura de alojamiento y explotar las relaciones de confianza para dirigir el ataque a otros sistemas dentro de la organización.</p>
                        <h3>Inyección de comandos OS</h3>
                        <p>En este ejemplo, una aplicación de compra permite al usuario ver si un artículo está en stock en una tienda en particular. Se accede a esta información a través de una URL:</p>
                        <code>https://insecure-website.com/stockStatus?productID=381&storeID=29</code> <br> <br>
                        <p>Para proporcionar la información de stock, la aplicación debe consultar varios sistemas heredados. Por razones históricas, la funcionalidad se implementa llamando a un comando de shell con el producto y los ID de la tienda como argumentos:</p>
                        <code>stockreport.pl 381 29</code> <br> <br>
                        <p>Este comando emite el estado de stock para el elemento especificado, que se devuelve al usuario.
                        La aplicación no implementa defensas contra la inyección de comandos del SO, por lo que un atacante puede enviar la siguiente entrada para ejecutar un comando arbitrario:</p>
                        <code>& echo aiwefwlguh &</code> <br> <br>
                        <p>Si esta entrada se envía en el productID parámetro, el comando ejecutado por la aplicación es:</p>
                        <code>stockreport.pl & echo aiwefwlguh & 29</code> <br> <br>
                        <p>El echo el comando hace que la cadena suministrada se haga eco en la salida. Esta es una forma útil de probar algunos tipos de inyección de comandos OS. El & character es un separador de comandos de shell. En este ejemplo, hace que se ejecuten tres comandos separados, uno tras otro. La salida devuelta al usuario es:</p>
                        <code>Error - productID was not provided <br>
                        aiwefwlguh <br>
                        29: command not found</code> <br>
                        <p>Las tres líneas de salida demuestran que:</p>
                        <ul>
                            <li>El original stockreport.pl el comando se ejecutó sin sus argumentos esperados, por lo que devolvió un mensaje de error.</li>
                            <li>El inyectado echo se ejecutó el comando y la cadena suministrada se hizo eco en la salida.</li>
                            <li>El argumento original 29 se ejecutó como un comando, lo que causó un error.</li>
                        </ul>
                        <p>Colocación del separador de comandos adicional & después del comando inyectado es útil porque separa el comando inyectado de lo que sigue al punto de inyección.
                            Esto reduce la posibilidad de que lo que sigue impida que se ejecute el comando inyectado.</p>
                        <h3>Comandos útiles</h3>
                        <p>Después de identificar una vulnerabilidad de inyección de comandos del SO, es útil ejecutar algunos comandos iniciales para obtener información sobre el sistema. A continuación se muestra un resumen de algunos comandos que son útiles en plataformas Linux y Windows:</p>
                        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Propósito del comando</th>
                                    <th>Linux</th>
                                    <th>Windows</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nombre del usuario actual</td>
                                    <td>whoami</td>
                                    <td>whoami</td>
                                </tr>
                                <tr>
                                    <td>Sistema operativo</td>
                                    <td>uname -a</td>
                                    <td>ver</td>
                                </tr>
                                <tr>
                                    <td>Configuración de red</td>
                                    <td>ifconfig</td>
                                    <td>ipconfig /all</td>
                                </tr>
                                <tr>
                                    <td>Conexiones de red</td>
                                    <td>netstat -an</td>
                                    <td>netstat -an</td>
                                </tr>
                                <tr>
                                    <td>Ejecución de procesos</td>
                                    <td>ps -ef</td>
                                    <td>tasklist</td>
                                </tr>
                            </tbody>
                        </table> <br>
                        <h3>Cómo prevenir ataques de inyección de comandos OS</h3>
                        <p>La forma más efectiva de prevenir las vulnerabilidades de inyección de comandos del OS es nunca llamar a los comandos del OS desde el código de la capa de aplicación. 
                        En casi todos los casos, hay diferentes formas de implementar la funcionalidad requerida utilizando API de plataforma más seguras.
                        Si tiene que llamar a los comandos del SO con la entrada suministrada por el usuario, debe realizar una validación de entrada sólida. Algunos ejemplos de validación efectiva incluyen:</p>
                        <ul>
                            <li>Validación contra una lista blanca de valores permitidos.</li>
                            <li>Validar que la entrada es un número.</li>
                            <li>Validar que la entrada contiene solo caracteres alfanuméricos, ninguna otra sintaxis o espacio en blanco.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Path Traversal -->
        <div class="modal fade" id="modalPathTraversal" tabindex="-1" aria-labelledby="modalPathTraversalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalPathTraversalLabel">Path Traversal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <p>En esta sección, explicamos:</p>
                        <ul>
                            <li>Qué es el camino transversal.</li>
                            <li>Cómo llevar a cabo ataques de recorrido de caminos y eludir obstáculos comunes.</li>
                            <li>Cómo prevenir vulnerabilidades de recorrido de ruta.</li>
                        </ul>
                            <img src="../img/directory-traversal.svg" alt="">
                        <h3>¿Qué es el path traversal?</h3>
                        <p>El recorrido de ruta también se conoce como recorrido de directorio. Estas vulnerabilidades permiten a un atacante leer archivos arbitrarios en el servidor que ejecuta una aplicación. Esto podría incluir:</p>
                        <ul>
                            <li>Código y datos de la aplicación.</li>
                            <li>Credenciales para sistemas back-end.</li>
                            <li>Archivos sensibles del sistema operativo.</li>
                        </ul>
                        <p>En algunos casos, un atacante podría escribir en archivos arbitrarios en el servidor, lo que les permite modificar los datos o el comportamiento de la aplicación y, en última instancia, tomar el control total del servidor.</p>
                        <h3>Lectura de archivos arbitrarios a través del recorrido de rutas</h3>
                         <p>Imagine una aplicación de compras que muestra imágenes de artículos a la venta. Esto podría cargar una imagen usando el siguiente HTML:</p>
                         <code><img src="/loadImage?filename=218.png"></code> <br>
                         <p>El loadImage URL toma un filename parámetro y devuelve el contenido del archivo especificado. Los archivos de imagen se almacenan en el disco en la ubicación /var/www/images/. Para devolver una imagen, la aplicación 
                            añade el nombre de archivo solicitado a este directorio base y utiliza una API del sistema de archivos para leer el contenido del archivo. En otras palabras, la aplicación lee desde la siguiente ruta de archivo:</p>
                        <code>/var/www/images/218.png</code> <br>
                        <p>Esta aplicación no implementa defensas contra ataques de recorrido de ruta. Como resultado, un atacante puede solicitar la siguiente URL para recuperar el /etc/passwd archivo del sistema de archivos del servidor:</p>
                        <code>https://insecure-website.com/loadImage?filename=../../../etc/passwd</code> <br>
                        <p>Esto hace que la aplicación lea desde la siguiente ruta de archivo:</p>
                        <code>/var/www/images/../../../etc/passwd</code>
                        <p>La secuencia ../ es válido dentro de una ruta de archivo y significa aumentar un nivel en la estructura del directorio. Los tres consecutivos ../ las secuencias se intensifican desde /var/www/images/ a la raíz del sistema de archivos, por lo que el archivo que se lee realmente es:</p>
                        <code>/etc/passwd</code> <br>
                        <p>En los sistemas operativos basados en Unix, este es un archivo estándar que contiene detalles de los usuarios que están registrados en el servidor, pero un atacante podría recuperar otros archivos arbitrarios utilizando la misma técnica.
                        En Windows, ambos ../ y ..\ son secuencias de salto de directorio válidas. El siguiente es un ejemplo de un ataque equivalente contra un servidor basado en Windows:</p>
                        <code>https://insecure-website.com/loadImage?filename=..\..\..\windows\win.ini</code>
                        <h3>Obstáculos comunes para explotar las vulnerabilidades de paso de ruta</h3>
                        <p>Muchas aplicaciones que colocan la entrada del usuario en rutas de archivos implementan defensas contra ataques de recorrido de ruta. Estos a menudo se pueden pasar por alto.
                        Si una aplicación elimina o bloquea secuencias de salto de directorio del nombre de archivo suministrado por el usuario, podría ser posible eludir la defensa utilizando una variedad de técnicas.
                        Es posible que pueda usar una ruta absoluta desde la raíz del sistema de archivos, como filename=/etc/passwd, para hacer referencia directamente a un archivo sin usar ninguna secuencia transversal.</p>
                        <h3>Cómo prevenir un ataque de recorrido de ruta</h3>
                        <p>La forma más efectiva de evitar vulnerabilidades de recorrido de ruta es evitar pasar la entrada suministrada por el usuario a las API del sistema de archivos por completo. Muchas funciones de aplicación que hacen esto se pueden reescribir para ofrecer el mismo comportamiento de una manera más segura.
                        Si no puede evitar pasar la entrada suministrada por el usuario a las API del sistema de archivos, le recomendamos que utilice dos capas de defensa para evitar ataques:</p>
                        <ul>
                            <li>Valide la entrada del usuario antes de procesarla. Idealmente, compare la entrada del usuario con una lista blanca de valores permitidos. Si eso no es posible, verifique que la entrada contenga solo contenido permitido, como solo caracteres alfanuméricos.</li>
                            <li>Después de validar la entrada suministrada, agregue la entrada al directorio base y use una API del sistema de archivos de la plataforma para canonizar la ruta. Verifique que la ruta canonicalizada comience con el directorio base esperado.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para File Upload -->
        <div class="modal fade" id="modalFileUpload" tabindex="-1" aria-labelledby="modalFileUploadLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalFileUploadLabel">File Upload</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-padding">
                        <p>En esta sección, aprenderá cómo las funciones simples de carga de archivos se pueden usar como un poderoso vector para una serie de ataques de alta gravedad. Le mostraremos cómo omitir los mecanismos de defensa comunes para cargar un shell web,
                             lo que le permitirá tomar el control total de un servidor web vulnerable. Dado lo comunes que son las funciones de carga de archivos, saber cómo probarlas correctamente es un conocimiento esencial.</p> 
                             <img src="../img/file-upload-vulnerabilities.jpg" alt=""> <br> <br>
                        <h3>¿Cuáles son las vulnerabilidades de carga de archivos?</h3>
                        <p>Las vulnerabilidades de carga de archivos son cuando un servidor web permite a los usuarios cargar archivos en su sistema de archivos sin validar suficientemente cosas como su nombre, tipo, contenido o tamaño. No hacer cumplir adecuadamente las restricciones sobre estos podría significar que incluso una función básica de carga de imágenes se puede utilizar para cargar archivos arbitrarios y potencialmente peligrosos. Esto podría incluso incluir archivos de script del lado del servidor que permiten la ejecución remota de código.
                        En algunos casos, el acto de cargar el archivo es en sí mismo suficiente para causar daños. Otros ataques pueden implicar una solicitud HTTP de seguimiento para el archivo, generalmente para activar su ejecución por parte del servidor.</p>
                        <h3>¿Cuál es el impacto de las vulnerabilidades de carga de archivos?</h3>
                        <p>El impacto de las vulnerabilidades de carga de archivos generalmente depende de dos factores clave:</p>
                        <ul>
                            <li>Qué aspecto del archivo el sitio web no se valida correctamente, ya sea su tamaño, tipo, contenido, etc.</li>
                            <li>Qué restricciones se imponen en el archivo una vez que se ha cargado con éxito.</li>
                        </ul>
                        <p>En el peor de los casos, el tipo de archivo no se valida correctamente y la configuración del servidor permite ciertos tipos de archivo (como .php y .jsp) para ser ejecutado como código. 
                            En este caso, un atacante podría cargar un archivo de código del lado del servidor que funcione como un shell web, otorgándoles efectivamente un control total sobre el servidor.</p>
                            <h3>¿Cómo surgen las vulnerabilidades de carga de archivos?</h3>
                            <p>Dados los peligros bastante obvios, es raro que los sitios web en la naturaleza no tengan restricciones en absoluto sobre los archivos que los usuarios pueden cargar. Más comúnmente, los desarrolladores implementan lo que creen que es una validación robusta que es inherentemente defectuosa o puede ser fácilmente omitida.
                            Por ejemplo, pueden intentar incluir en la lista negra tipos de archivos peligrosos, pero no tienen en cuenta las discrepancias de análisis al verificar las extensiones de archivo. Al igual que con cualquier lista negra, también es fácil omitir accidentalmente tipos de archivos más oscuros que aún pueden ser peligrosos.
                            En otros casos, el sitio web puede intentar verificar el tipo de archivo verificando las propiedades que un atacante puede manipular fácilmente utilizando herramientas como Burp Proxy o Repeater.
                            En última instancia, incluso las medidas de validación sólidas pueden aplicarse de manera inconsistente a través de la red de hosts y directorios que forman el sitio web, lo que resulta en discrepancias que pueden explotarse.</p>
                            <h3>¿Cómo manejan los servidores web las solicitudes de archivos estáticos?</h3>
                            <p>Antes de ver cómo explotar las vulnerabilidades de carga de archivos, es importante que tenga una comprensión básica de cómo los servidores manejan las solicitudes de archivos estáticos.
                            Históricamente, los sitios web consistían casi en su totalidad en archivos estáticos que se servirían a los usuarios cuando se solicitaran. Como resultado, la ruta de cada solicitud podría asignarse 1:1 con la jerarquía de directorios y archivos en el sistema de archivos del servidor. Hoy en día, los sitios web son cada vez más dinámicos y la ruta de una solicitud a menudo no tiene 
                            ninguna relación directa con el sistema de archivos. Sin embargo, los servidores web aún se ocupan de las solicitudes de algunos archivos estáticos, incluidas hojas de estilo, imágenes, etc.
                            El proceso para manejar estos archivos estáticos sigue siendo en gran medida el mismo. En algún momento, el servidor analiza la ruta en la solicitud para identificar la extensión de archivo. Luego utiliza esto para determinar el tipo de archivo que se solicita, generalmente comparándolo con una lista de asignaciones preconfiguradas entre extensiones y tipos MIME. Lo que sucede a continuación depende del tipo de archivo y la configuración del servidor. </p>
                            <ul>
                                <li>Si este tipo de archivo no es ejecutable, como una imagen o una página HTML estática, el servidor puede enviar el contenido del archivo al cliente en una respuesta HTTP.</li>
                                <li>Si el tipo de archivo es ejecutable, como un archivo PHP, y el servidor está configurado para ejecutar archivos de este tipo, asignará variables basadas en los encabezados y parámetros en la solicitud HTTP antes de ejecutar el script. La salida resultante se puede enviar al cliente en una respuesta HTTP.</li>
                                <li>Si el tipo de archivo es ejecutable, pero el servidor no lo es configurado para ejecutar archivos de este tipo, generalmente responderá con un error. Sin embargo, en algunos casos, el contenido del archivo todavía puede ser servido al cliente como texto sin formato. Dichas configuraciones erróneas pueden explotarse ocasionalmente para filtrar el código fuente y otra información confidencial. Puedes ver un ejemplo de esto en nuestros materiales de aprendizaje de divulgación de información.</li>
                            </ul>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



 
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
