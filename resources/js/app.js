import { addChatBubble, updateChatBubble } from './typing';  // Importiere typeFun richtig

async function loadConversation(toolIdentifier)
{
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fetch the conversation api endpoint with the tool identifier
    try {
        const response = await fetch(route('conversation.get', {
            toolIdentifier: toolIdentifier
        }), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'include' // Stellt sicher, dass Cookies mit dem Request gesendet werden
        });

        if (!response.ok) {
            if (response.status === 404) {
                await initConversation(toolIdentifier);
                return;
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error("Fehlerdetails:", error);
        throw error;
    }
}

async function initConversation(toolIdentifier, token)
{
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fetch the conversation api endpoint with the tool identifier
    try {
        const response = await fetch(route('conversation.get', {
            toolIdentifier: toolIdentifier
        }), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'include' // Stellt sicher, dass Cookies mit dem Request gesendet werden
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error("Fehlerdetails:", error);
        throw error;
    }

}

// Funktion zum Senden einer Chat-Nachricht des USers an den Chatbot
async function sendMessage(message, conversationId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    try {
        const response = await fetch(route('conversation.askAi', conversationId), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "text/event-stream",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                content: message,
            }),
        });

        const reader = response.body.getReader();
        const decoder = new TextDecoder();
        let content = '';

        while (true) {
            const {value, done} = await reader.read();
            if (done) break;
            
            const chunk = decoder.decode(value);
            const lines = chunk.split('\n');
            
            for (const line of lines) {
                if (line.startsWith('data: ')) {
                    const data = JSON.parse(line.slice(6));
                    content += data.content || '';
                    // Update UI progressiv
                    window.fns.updateChatBubble(botMessageId, content);
                }
            }
        }

        return {data: {content}};
    } catch (error) {
        console.error("Fehlerdetails:", error);
        throw error;
    }
}

async function saveToArchive(conversationId, save_name, tooltype, type) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(route('conversation.archive', conversationId), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                save_name: save_name,
                tooltype: tooltype,
                type: type,
            }),
            credentials: "include",
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error("Fehlerdetails:", error);
        throw error;
    }
}

function showLoadingChat(state) {
    const loadingChat = document.getElementById('chat_loading_indicator');
    if (loadingChat) {
        if (state) {
            loadingChat.style.display = 'flex';
        } else {
            loadingChat.style.display = 'none';
        }
    }
}

window.fns = {
    'loadConversation': loadConversation,
    'sendMessage': sendMessage,
    'addChatBubble': addChatBubble,
    'updateChatBubble': updateChatBubble,
    'saveToArchive': saveToArchive,
    'showLoadingChat': showLoadingChat,
}

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', async () => {
        try {
            const registration = await navigator.serviceWorker.register('/sw.js');
            console.log('ServiceWorker erfolgreich registriert');
        } catch (err) {
            console.error('ServiceWorker Registrierung fehlgeschlagen:', err);
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        if (this.url.indexOf('http') !== 0) {
            this.url = window.location.origin + this.url;
        }
    },
    error: function(xhr, status, error) {
        if (xhr.status === 419) { // CSRF token mismatch
            window.location.reload();
        }
    }
});

async function sendMessageWithRetry(message, conversationId, maxRetries = 3) {
    for (let i = 0; i < maxRetries; i++) {
        try {
            return await sendMessage(message, conversationId);
        } catch (error) {
            if (i === maxRetries - 1) throw error;
            await new Promise(resolve => setTimeout(resolve, 1000 * Math.pow(2, i)));
            
            // Fallback auf alternatives Modell bei Timeout
            if (error.message.includes('timeout') && i === maxRetries - 2) {
                return await sendMessage(message, conversationId, true); // true für fallback
            }
        }
    }
}
