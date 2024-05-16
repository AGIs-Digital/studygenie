// Text Tippen Funktion
export function typeText(text, container, currentChar, callback) {
    // Überprüfen, ob der aktuelle Charakter kleiner als die Textlänge ist
    if (currentChar < text.length) {
        // Finden des nächsten Vorkommens von <br>
        const nextBreak = text.indexOf('<br>', currentChar);

        if (nextBreak !== -1 && nextBreak === currentChar) {
            // Wenn der aktuelle Charakter ein <br> ist, füge einen Zeilenumbruch hinzu
            container.innerHTML += '<br>';
            currentChar += 4; // Länge von <br> ist 4
        } else {
            // Füge den aktuellen Charakter zum Container hinzu
            container.innerHTML += text.charAt(currentChar);
            currentChar++;
        }

        // Timeout für den nächsten Charakter
        setTimeout(() => typeText(text, container, currentChar, callback), 10);
    } else {
        // Wenn der gesamte Text getippt wurde, rufe den Callback auf
        if (callback) {
            callback();
        }
    }
}

// Funktionsaufruf für das Tippen des gesamten Textes
export function typeFun(text, containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        // Rufe die Funktion typeText auf, um den Text zu tippen
        typeText(text, container, 0);
    } else {
        console.error(`Container mit ID ${containerId} nicht gefunden`);
    }
}

export function addChatBubble(message, container, params = {typeFun: true})
{
    if(message.role === 'user') {
        // Neues Benutzer-Nachrichtenfeld erstellen und hinzufügen
        const userMessage = document.createElement('div');
        userMessage.classList.add('left_box');
        userMessage.innerHTML = `
            <span>${message.content}</span>
            <span><img src="../asset/images/illustrations/chatuser.png" width="35" height="35" alt="logoContainer"></span>
        `;
        container.appendChild(userMessage);

    } else if (message.role === 'assistant') {
        console.log('message:', message)

        // Neues Bot-Nachrichtenfeld erstellen und hinzufügen
        const botMessage = document.createElement('div');
        botMessage.classList.add('right_box');
        botMessage.classList.add('message_assistant');
        const imageSpan = document.createElement('span');
        const image = document.createElement('img');
        image.src = '../asset/images/chatgeni.svg';
        image.width = 25;
        image.height = 35;
        image.alt = 'logoContainer';
        imageSpan.appendChild(image);
        botMessage.appendChild(imageSpan);

        // count all messages with class message_assistant
        let count = document.querySelectorAll('.message_assistant').length;

        const textSpan = document.createElement('span');
        textSpan.id = `chatbot_${++count}`;
        botMessage.appendChild(textSpan);
        container.appendChild(botMessage);

        // Tippen des Textes
        if (params.typeFun)
            typeFun(message.content, textSpan.id);
        else
            textSpan.innerHTML = message.content;
    }
}
