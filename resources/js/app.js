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
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            credentials: "include",
            body: JSON.stringify({
                content: message,
            }),
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
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').then(registration => {
            console.log('ServiceWorker registration successful');
        }).catch(err => {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}
