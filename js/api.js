const apiKey = '35b019402563467249cba614c2e4ee5e9e982cc7ebba2c981a598d3fb0198914';
// Función para codificar la URL en base64
function encodeUrl(url) {
    return btoa(url);  // Codifica la URL en base64
}

// Función principal que se llama al presionar el botón
async function verifyUrl() {
    const url = document.getElementById('urlInput').value.trim();
    if (url) {
        await checkUrl(url);
    } else {
        alert('Por favor ingresa una URL válida.');
    }
}

// Función que realiza la solicitud a VirusTotal API
async function checkUrl(url) {
    const endpoint = `https://www.virustotal.com/api/v3/urls`;

    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'x-apikey': apiKey,  // Encabezado con la API key
                accept: 'application/json',
                'content-type': 'application/x-www-form-urlencoded'
                
            },
            body: new URLSearchParams({url})
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        const data = await response.json();
        // displayResults(data);  // Muestra los resultados en la interfaz

        getAnalisisUrl(data.data.id);

    } catch (error) {
        console.error('Error en la solicitud a VirusTotal:', error);
        alert('Hubo un problema al verificar la URL.');
    }
}

//Se hace la segunda peticion porque en la API se tienen que hacer 2 llamadas
async function getAnalisisUrl(urlId){
    const analisisEndpoint = `https://www.virustotal.com/api/v3/analyses/${urlId}`;
    try{
        const response = await fetch(analisisEndpoint, {
            method: 'GET',
            headers: {
                'x-apikey': apiKey,  // Encabezado con la API key
                accept: 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        const data = await response.json();
        displayResults(data);
    }catch(error){
        console.error(error);
        alert('Hubo un problema al verificar el id url.');

    }
}

// Función para obtener y mostrar los resultados
function displayResults(data) {
    const resultContainer = document.getElementById('resultContainer');
    const analysisResults = data.data.attributes.results;

    // Limpiar resultados previos
    resultContainer.innerHTML = `
        <p><strong>Fecha del análisis:</strong> ${new Date(
  data.data.attributes.last_analysis_date ? data.data.attributes.last_analysis_date * 1000 : Date.now()
).toLocaleString()}</p>

    `;

    // Mostrar los resultados de cada motor de análisis
    const motorsContainer = document.createElement('div');
    motorsContainer.innerHTML = '<h4>Resultados por motor de detección:</h4>';

    // Recorre todos los resultados de los motores
    for (let motor in analysisResults) {
        const result = analysisResults[motor];
        const motorName = motor;
        const verdict = result.category;  // El resultado del motor (malicious, harmless, etc.)
        const engineVersion = result.engine_version || 'N/A'; // Versión del motor (si está disponible)
        const engineName = result.engine_name; // Nombre del motor
        const lastSeen = result.last_modification_date ? new Date(result.last_modification_date * 1000).toLocaleString() : 'N/A'; // Fecha de última modificación

        // Determina el color o estado para el motor
        let status = '';
        let color = '';
        let colorClass = '';
        if (verdict === 'malicious') {
            status = 'Malicioso';
            color = 'red';
            colorClass = 'malicioso';
        } else if (verdict === 'harmless') {
            status = 'Inofensivo';
            color = 'green';
             colorClass = 'inofensivo';
        } else if (verdict === 'suspicious') {
            status = 'Sospechoso';
            color = 'orange';
            colorClass = 'sospechoso';
        } else {
            status = 'No detectado';
            color = 'gray';
            colorClass = 'no-detectado';
        }

        motorsContainer.innerHTML += `
            <div class="result ${colorClass}" data-category="${verdict}">
                <strong>${motorName}</strong>: 
                <span style="color: ${color};">${status}</span><br>
                <strong>Versión del motor:</strong> ${engineVersion}<br>
                <strong>Última modificación:</strong> ${lastSeen}<br>
                <strong>Nombre del motor:</strong> ${engineName}
            </div>
            <hr>
        `;
    }

    resultContainer.appendChild(motorsContainer);
}

