<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'genieTutor')
    @include('includes.head')
    @include('components.mathjax')
</head>

<body class="MainContainer">
    @include('includes.header')
    <section class="TextInspiration_sec">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-md-2">
                    <div class="leftCon" style="cursor: pointer">
                        <img id="closeIcon" onclick="window.location.href='/bildung'" src="{{ asset('asset/images/ic_close.png') }}"
                            alt="closeIcon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167"
                            fill="none">
                            <g filter="url(#filter0_d_168_754)">
                                <path
                                    d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
                                    fill="#F8F8F8"></path>
                                <g transform="translate(30,30)">
                                    <rect width="184" height="109" fill="none"></rect>
                                    <path
                                        d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
                                        fill="#E09E50"></path>
                                    <text class="textStyle" x="92" y="60" dominant-baseline="middle"
                                        text-anchor="middle" font-size="24" fill="#FFFFFF"
                                        font-weight="400">GenieTutor</text>
                                </g>
                            </g>
                            <defs>
                                <filter id="filter0_d_168_754" x="0" y="0" width="244.92" height="166.98"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                    </feColorMatrix>
                                    <feOffset></feOffset>
                                    <feGaussianBlur stdDeviation="8.5"></feGaussianBlur>
                                    <feComposite in2="hardAlpha" operator="out"></feComposite>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                    </feColorMatrix>
                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                        result="effect1_dropShadow_168_754"></feBlend>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_168_754"
                                        result="shape"></feBlend>
                                </filter>
                            </defs>
                        </svg>
                    </div>
                    <div class="legende">
                        <h3>Steuerung<button type="button" class="btn" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Gib zuerst dein Bildungslevel und das Thema ein, wähle anschließend einen Modus">
                                <img src="{{ asset('asset/images/info-tools.svg') }}" width="25" alt="">
                            </button></h3>
                        <br />
                        <div class="form-group">
                            <label for="level">Level:</label>
                            <input type="text" id="level_input" name="level"
                                placeholder="z.B. 9. Klasse Gymnasium">
                        </div>

                        <div class="form-group">
                            <label for="thema">Thema:</label>
                            <input type="text" id="thema_input" name="thema"
                                placeholder="z.B. Satz des Pythagoras">
                        </div>
                        <br /> <br />

                        <div class="steuerungcontainer">
                            <div onclick="setInputValue('/tutor')" class="steuerung">
                                <div class="shop-now">Tutor</div>
                                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Lerne einfach und effektiv">
                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="steuerungcontainer">
                            <div onclick="setInputValue('/Sokrates')" class="steuerung">
                                <div class="shop-now">Sokrates</div>
                                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Denke selbstständig">
                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="steuerungcontainer">
                            <div onclick="setInputValue('/mc')" class="steuerung">
                                <div class="shop-now">Multiple Choice</div>
                                <button type="button" class="btn" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Schnelle Wissensabfrage">
                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                        alt="">
                                </button>
                            </div>
                        </div>
                        <div class="steuerungcontainer">
                            <div onclick="setInputValue('/test')" class="steuerung">
                                <div class="shop-now">Probeklausur</div>
                                <button type="button" class="btn" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Teste deinen Lernstand">
                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                        alt="">
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="written-green-board">
                        <div class="content-written message">
                            <img src="{{ asset('asset/images/ab3.svg') }}" class="ab1" alt=""> <img
                                src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt=""> <img
                                src="{{ asset('asset/images/ab3.svg') }}" class="ab1" alt=""> <img
                                src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="">
                            <img src="{{ asset('asset/images/ToolsImage.png') }}" class="ab5" alt="">
                            <div class="typing-container d-block">
                                <div class="all_content" id="all_content">

                                </div>

                            </div>
                            <div class="user_input_form">
                                <form id="form_user_input" style="display: flex; align-items: center; gap: 10px;">
                                    @csrf
                                    <div class="save_folder left" id="save_folder" style="display: block"
                                        data-bs-toggle="modal" data-bs-target="#saveModal">
                                        <img src="{{ asset('asset/images/savefolder.svg') }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                            data-bs-original-title="Speichern" width="40" height="40"
                                            alt="">
                                    </div>
                                    <input type="text" id="user_input" name="user" required placeholder="Sende eine Nachricht an StudyGenie" style="flex: 1;">
                                    <button type="submit" id="button_submit" style="background-color:#E09E50; flex-shrink: 0;">Senden</button>
                                </form>
                            </div>
                        </div>
                        <p style="font-size: 12px; color: gray; text-align: center;">StudyGenie kann Fehler machen. Überprüfe wichtige Informationen.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="saveModalLabel">Speichern</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="save_data">
                        @csrf
                        <div class="mb-3">
                            <label for="save_name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="save_name" name="name"
                                placeholder="Speichername eingeben">
                        </div>
                        <input type="hidden" name="save_val" id="save_val"> <input type="hidden" name="tooltype"
                            value="genieTutor"> <input type="hidden" name="type" value="Bildung"
                            id="text">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" id="saveForm">Speichern</button>
                </div>

            </div>
        </div>
    </div>
    @include('includes.footer')
    <script src="{{ asset('asset/js/toast.js') }}"></script>
    <script>
        // Initialisierung bei DOMContentLoaded
        document.addEventListener('DOMContentLoaded', () => {
            const toolIdentifier = 'genie_tutor';

            const userInput = document.getElementById('user_input');
            const formSubmitButton = document.getElementById('button_submit');
            const messageContainer = document.getElementById('all_content');
            const conversationForm = document.getElementById('form_user_input');
            const saveForm = document.getElementById('saveForm');
            let conversation = {};

            // Load an existing or create a new conversation
            (async () => {
                window.fns.showLoadingChat(true)
                const response = await window.fns.loadConversation(toolIdentifier);
                conversation = response.data;

                // add a chatbubble for each message
                conversation.messages.forEach(message => {
                    window.fns.addChatBubble(message, messageContainer, {
                        typeFun: false
                    })
                });

                messageContainer.scrollTop = messageContainer.scrollHeight;
                userInput.focus();

                // MathJax-Formatierung auf alle Nachrichten anwenden
                MathJax.typesetPromise([messageContainer]);
            })();

            conversationForm.addEventListener('submit', async (event) => {

                // prevent default form submission
                event.preventDefault();

                // disable the user input form
                userInput.disabled = true;
                // add class "disabled" to the form
                conversationForm.classList.add('disabled');
                // remove focus
                userInput.blur();

                const userValue = userInput.value.trim();

                if (!userValue) {
                    alert('Bitte geben Sie einen Text ein');
                    return;
                }

                userMessage = {
                    content: userValue,
                    role: 'user'
                }

                window.fns.addChatBubble(userMessage, messageContainer);

                formSubmitButton.textContent = 'lädt...';

                try {
                    // create an empty bot message
                    const botMessageId = window.fns.addChatBubble({
                        role: 'assistant',
                        'content': ''
                    }, messageContainer);

                    const data = await window.fns.sendMessage(userValue, conversation.id);

                    window.fns.updateChatBubble(botMessageId, data.data.content, messageContainer);

                    formSubmitButton.textContent = 'Senden';

                    userInput.value = '';
                    userInput.disabled = false;
                    userInput.focus();
                    conversationForm.classList.remove('disabled');


                    document.getElementById('save_val').value = messageContainer.innerHTML;

                    // Render MathJax content
                    MathJax.typesetPromise([messageContainer]);
                } catch (error) {
                    console.log(error)
                    formSubmitButton.textContent = 'Senden';
                }
            });

            // Speichern des Chatverlaufs
            saveForm.addEventListener('click', async () => {
                await window.fns.saveToArchive(
                    conversation.id,
                    $("#save_name").val(),
                    "genieTutor",
                    "Bildung",
                );

                document.getElementById('save_val').value = '';

                $("#saveModal").modal('hide');


                showToast(document.title + " Gespeichert!");
            });
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        /**
         * Setzt den Wert des Eingabefeldes und löst das Absenden des Formulars aus.
         * @param {string} value - Der Wert, der gesetzt werden soll.
         */
        function setInputValue(value) {
            const userInput = document.getElementById('user_input');
            const levelInput = document.getElementById('level_input').value.trim();
            const themaInput = document.getElementById('thema_input').value.trim();

            if (levelInput) {
                userInput.value = `${value} Level: ${levelInput} Thema: ${themaInput}`;
            } else {
                userInput.value = value;
            }

            // Trigger the submit event programmatically
            const event = new Event('submit', {
                'bubbles': true,
                'cancelable': true
            });
            document.getElementById('form_user_input').dispatchEvent(event);
        }

        /**
         * Sendet den Wert an den Server.
         * @param {string} value - Der Wert, der gesendet werden soll.
         */
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
    </script>
</body>

</html>
