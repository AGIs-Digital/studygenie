<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Tutor')
    @include('components.head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('asset/css/chatbot.css') }}">
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')

    <div class="page-container tutor-layout">
        <!-- Left column (1/4 width) -->
        <div class="left-column">
            <!-- Back button -->
            <div class="leftCon" style="cursor: pointer">
                <img id="closeIcon" onclick="window.location.href='/bildung'" 
                     src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Tutor" 
                        bg-color="#E09E50"
                        text-color="#FFFFFF"
                    />
                </svg>
            </div>

            <!-- Steuerung Section -->
            <div class="control-section">
                <div class="group-box">
                    <span>Steuerung
                        <strong type="button" data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Gib zuerst dein Bildungslevel und das Thema ein">
                            <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                 width="16" alt="" loading="lazy">
                        </strong>
                    </span>
                    <input type="text" id="level_input" name="level" 
                           placeholder="z.B. 9. Klasse Gymnasium" required>
                    <input type="text" id="thema_input" name="thema" 
                           placeholder="z.B. Satz des Pythagoras" required>
                </div>
                <br />

                <div class="radio-group">
                    <span style="font-weight: 600;">Modus
                        <strong type="button" data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Wähle einen Modus">
                            <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                 width="16" alt="" loading="lazy">
                        </strong>
                    </span>
                    <label class="radio-button" data-value="/Tutor">
                        <input type="radio" name="mode" value="tutor">
                        <span class="radio-label">Tutor
                            <strong type="button" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Lerne einfach und effektiv">
                                <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                     width="16" alt="" loading="lazy">
                            </strong>
                        </span>
                    </label>

                    <label class="radio-button" data-value="/Sokrates">
                        <input type="radio" name="mode" value="sokrates">
                        <span class="radio-label">Sokrates
                            <strong type="button" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Denke selbstständig">
                                <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                     width="16" alt="" loading="lazy">
                            </strong>
                        </span>
                    </label>

                    <label class="radio-button" data-value="/MC-Test">
                        <input type="radio" name="mode" value="mc">
                        <span class="radio-label">Multiple Choice
                            <strong type="button" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Schnelle Wissensabfrage">
                                <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                     width="16" alt="" loading="lazy">
                            </strong>
                        </span>
                    </label>

                    <label class="radio-button" data-value="/Test">
                        <input type="radio" name="mode" value="test">
                        <span class="radio-label">Probeklausur
                            <strong type="button" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Teste deinen Lernstand">
                                <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                     width="16" alt="" loading="lazy">
                            </strong>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Right column (3/4 width) -->
        <div class="right-column">
            <div class="chat-container">
                <img src="{{ asset('asset/images/ab3.svg') }}" class="ab1" alt="" loading="lazy">
                <img src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt="" loading="lazy">
                <img src="{{ asset('asset/images/ab3.svg') }}" class="ab1" alt="" loading="lazy">
                <img src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="" loading="lazy">
                <img src="{{ asset('asset/images/toolsImage.svg') }}" class="ab5" alt="" loading="lazy">
                <div class="message-area" id="all_content">
                    <!-- Chat messages will be inserted here -->
                </div>
                <div class="input-line">
                    <form id="form_user_input" class="chat-form">
                        @csrf
                        <button type="submit" id="button_submit" class="send-button">Senden</button>
                        <textarea type="text" id="user_input" name="text1" required 
                                  placeholder="Sende eine Nachricht an StudyGenie"
                                  style="min-height: 40px; max-height: 200px; overflow-y: hidden;"
                                  oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, 200) + 'px'"></textarea>
                        <button type="button" class="archive-button" id="showSaveModal" data-bs-toggle="modal" data-bs-target="#saveModal">
                            <img src="{{ asset('asset/images/savefolder.svg') }}" 
                                 data-bs-toggle="tooltip" data-bs-placement="top" 
                                 title="Speichern" width="30" height="30" 
                                 alt="" loading="lazy">
                        </button>
                    </form>
                </div>
            </div>
            <p class="info-text">
                StudyGenie kann Fehler machen. Überprüfe wichtige Informationen.
            </p>
        </div>
    </div>

    @include('components.save_modal')
    @include('components.mathjax')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toolIdentifier = 'tutor';

            const userInput = document.getElementById('user_input');
            const formSubmitButton = document.getElementById('button_submit');
            const messageContainer = document.getElementById('all_content');
            const conversationForm = document.getElementById('form_user_input');
            const saveFormButton = document.getElementById('saveFormButton');
            let conversation = {};

            // Load an existing or create a new conversation
            (async () => {
                window.fns.showLoadingChat(true)
                const response = await window.fns.loadConversation(toolIdentifier);
                conversation = response.data;

                // add a chatbubble for each message
                conversation.messages.forEach(message => {
                    window.fns.addChatBubble(message, messageContainer, { typeFun: false });
                });

                messageContainer.scrollTop = messageContainer.scrollHeight;
                userInput.focus();

                // MathJax-Formatierung auf alle Nachrichten anwenden
                MathJax.typesetPromise([messageContainer]);
            })();

            conversationForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const levelInput = document.getElementById('level_input').value.trim();

                if (!levelInput) {
                    showToast('Bitte gib dein Level an', 'error');
                    return;
                }

                // Bestehender Code bleibt unverändert
                userInput.disabled = true;
                conversationForm.classList.add('disabled');
                userInput.blur();

                const userValue = userInput.value.trim();

                if (!userValue) {
                    showToast('Gib bitte einen Text ein', 'error');
                    return;
                }

                userMessage = {
                    content: userValue,
                    role: 'user'
                }

                window.fns.addChatBubble(userMessage, messageContainer);

                formSubmitButton.textContent = 'lädt...';
                formSubmitButton.disabled = true;

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Unsere Server brauchen gerade etwas länger. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                try {
                    // Erstelle eine leere Bot-Nachricht mit Lade-Indikator
                    const botMessageId = window.fns.addChatBubble({ 
                        role: 'assistant', 
                        content: 'hmmm...' 
                    }, messageContainer);

                    const data = await window.fns.sendMessage(userValue, conversation.id);

                    clearTimeout(toastTimer);

                    // Warte auf das nächste Frame bevor Update
                    requestAnimationFrame(() => {
                        window.fns.updateChatBubble(botMessageId, data.data.content, messageContainer);
                        
                        // Scroll zum Ende der Nachricht
                        messageContainer.scrollTop = messageContainer.scrollHeight;
                        
                        // Warte auf MathJax-Rendering
                        MathJax.typesetPromise([messageContainer]).then(() => {
                            // Nochmal scrollen nach MathJax-Rendering
                            messageContainer.scrollTop = messageContainer.scrollHeight;
                        });
                    });

                    formSubmitButton.textContent = 'Senden';
                    formSubmitButton.disabled = false;

                    userInput.value = '';
                    userInput.disabled = false;
                    userInput.focus();
                    conversationForm.classList.remove('disabled');

                    document.getElementById('save_val').value = messageContainer.innerHTML;

                    // Render MathJax content
                    MathJax.typesetPromise([messageContainer]);
                } catch (error) {

                    clearTimeout(toastTimer); // Timer löschen

                    console.log(error);
                    formSubmitButton.textContent = 'Senden';
                    formSubmitButton.disabled = false;
                    userInput.disabled = false;
                    conversationForm.classList.remove('disabled');
                }
            });

            // Speichern des Chatverlaufs
            saveFormButton.addEventListener('click', async () => {
                await window.fns.saveToArchive(
                    conversation.id,
                    $("#save_name").val(),
                    "tutor",
                    "Bildung",
                );

                document.getElementById('save_val').value = '';

                $("#saveModal").modal('hide');

                showToast(document.title + " wurde im Archiv gespeichert");
            });

            function setInputValue(value) {
                const userInput = document.getElementById('user_input');
                const levelInput = document.getElementById('level_input').value.trim();
                const themaInput = document.getElementById('thema_input').value.trim();

                if (levelInput) {
                    userInput.value = `${value} Level: ${levelInput} Thema: ${themaInput}`;
                } else {
                    userInput.value = value;
                }
            }

            // Event-Listener für die Radio-Buttons
            document.querySelectorAll('.radio-button input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const value = this.closest('.radio-button').getAttribute('data-value');
                    setInputValue(value);
                    
                    const event = new Event('submit', {
                        'bubbles': true,
                        'cancelable': true
                    });
                    document.getElementById('form_user_input').dispatchEvent(event);
                });
            });
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        function sendInput(value) {
            fetch('/submit-input', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        input: value
                    })
                })
                .then(response => response.json());
        }

        function autoResize(textarea) {
            textarea.style.height = '';
            textarea.style.height = Math.min(textarea.scrollHeight, 200) + 'px';
            
            // Scroll zum Ende des Textareas wenn maximale Höhe erreicht
            if (textarea.scrollHeight > 200) {
                textarea.scrollTop = textarea.scrollHeight;
            }
        }
    </script>
</body>
</html>
