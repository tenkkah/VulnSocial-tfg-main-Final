const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value !== "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
};

sendBtn.onclick = async () => {
    const formData = new FormData(form);

    try {
        const response = await fetch("../src/controladores/agregar-chat.php", {
            method: "POST",
            body: formData,
        });

        if (response.ok) {
            inputField.value = "";
            scrollToBottom();
        } else {
            console.error("Error al enviar el mensaje");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
};

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

setInterval(async () => {
    try {
        const response = await fetch("../src/controladores/get-chat.php?action=obtenerMensajes", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `incoming_id=${encodeURIComponent(incoming_id)}`,
        });

        if (response.ok) {
            const data = await response.text();
            chatBox.innerHTML = data;

            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        } else {
            console.error("Error al obtener el chat");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
