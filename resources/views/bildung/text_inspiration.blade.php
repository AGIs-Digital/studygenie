<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'TextInspiration')
    @include('includes.head')

    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [
                    ['$', '$'],
                    ['\\(', '\\)']
                ],
                displayMath: [
                    ['$$', '$$'],
                    ['\\[', '\\]']
                ]
            },
            svg: {
                fontCache: 'global'
            }
        };
    </script>
    <style>
        .loading-button {
            position: relative;
            padding-right: 30px;
        }

        .loading-button::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            transform: translateY(-50%);
        }

        @keyframes spin {
            0% {
                transform: translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateY(-50%) rotate(360deg);
            }
        }
    </style>
</head>

<body class="MainContainer backimage">
    @include('includes.header')
    <section class="TextInspiration_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="leftCon" style="cursor: pointer">
                        <img id="closeIcon" onclick="window.history.back()" src="{{ asset('asset/images/ic_close.png') }}"
                            alt="closeIcon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167"
                            fill="none">
                            <g filter="url(#filter0_d_168_754)">
                                <path
                                    d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
                                    fill="#F8F8F8"></path>
                                <svg xmlns="http://www.w3.org/2000/svg" width="184" height="109"
                                    viewBox="0 0 184 109" x="30" y="30">
                                    <rect width="100%" height="100%" fill="none"></rect>
                                    <path
                                        d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
                                        fill="#E09E50"></path>
                                    <text class="textStyle" x="50%" y="65" text-anchor="middle" font-family: 'Milonga' ,
                                        cursive; font-size="24" fill="#FFFFFF" font-weight="400">TextInspiration</text>
                                </svg>



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
                </div>
                <div class="col-md-4">
                    <form id="myForm">
                        @csrf
                        <div class="written-green-board">

                            <div class="content-written left brain">
                                <div class="left_scroll">
                                    <div class="group-box">
                                        <span class="small_text_font">Aufgabenart:
                                            <strong type="button" class="" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Aufsatz, Inhaltsangaben, Bachelorarbeit, etc."> <img
                                                    src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                                    alt="">
                                            </strong>
                                        </span> <input type="text" placeholder="" id="field_1" name="field1">
                                    </div>

                                    <div class="group-box">
                                        <span class="small_text_font">Level: <strong type="button" class=""
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="9. Klasse Realschule, Oberstufe, Studium, etc."> <img
                                                    src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                                    alt="">
                                            </strong>
                                        </span> <input type="text" placeholder="" id="field_2" name="field2">
                                    </div>

                                    <div class="group-box">
                                        <span class="small_text_font">Thema: <strong type="button" class=""
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Zu welchem Thema willst du etwas schreiben?"> <img
                                                    src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                                    alt="">
                                            </strong>
                                        </span> <input type="text" placeholder="" id="field_3" name="field3">
                                    </div>
                                    <div class="group-box">
                                        <span class="small_text_font">Besonderen Anforderungen/Interessen: <strong
                                                type="button" class="" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Wortanzahl, Text in einer anderen Sprache als deutsch, etc.">
                                                <img src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                                    alt="">
                                            </strong>
                                        </span> <input type="text" placeholder="" id="field_4" name="field4">
                                    </div>
                                    <div class="row radio_button_box">
                                        <div class="col-md-12">
                                            <label>Zu erstellender Text:
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label> <input type="radio" name="field5" value="Inhaltsverzeichnis">
                                                <i>Inhaltsverzeichnis</i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label> <input type="radio" name="field5" value="Einleitung">
                                                <i>Einleitung</i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label> <input type="radio" name="field5" value="Hauptteil">
                                                <i>Hauptteil</i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label> <input type="radio" name="field5" value="Schluss">
                                                <i>Schluss</i>
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="group-box">
                                        <span class="small_text_font">Bisheriger Text: <strong type="button"
                                                class="" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Gib deinen Text ein, um ihn weiterformulieren zu lassen."> <img
                                                    src="{{ asset('asset/images/info-tools.svg') }}" width="16"
                                                    alt="">
                                            </strong>
                                        </span>
                                        <textarea name="field6" id="field_6" rows="10" style="width:100%;"
                                            oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                                    </div>
                                    <br>
                                </div>
                                <button type="button" class="send_button" id="submitForm">Magie</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="written-green-board">
                        <div class="content-written right" id="checkcontent_box">
                            <div class="typing-container">
                                <!-- Ausgabefenster -->
                                <div id="typed-text"></div>
                            </div>
                        </div>
                        <div class="save_folder center" id="save_folder" data-bs-toggle="modal"
                            data-bs-target="#saveModal">
                            <img src="{{ asset('asset/images/savefolder.svg') }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="" data-bs-original-title="Speichern"
                                width="40" height="40" alt="">
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="save_data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="saveModalLabel">Speichern</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="save_name" class="form-label">Speichername
                            </label> <input type="text" class="form-control" id="save_name" name="name"
                                placeholder="Speichername">
                        </div>
                        <input type="hidden" name="save_val" id="save_val"> <input type="hidden" name="tooltype"
                            value="text_inspiration"> <input type="hidden" name="type" value="Bildung"
                            id="Bildung">



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                        <button type="button" class="btn btn-primary" id="saveForm">Speichern
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer')

    <script>
        let conversation_id = null
        document.addEventListener('DOMContentLoaded', () => {

            const saveForm = document.getElementById('save_data');
            const saveFormButton = document.getElementById('saveForm');

            // Speichern des Chatverlaufs
            saveFormButton.addEventListener('click', async () => {
                await window.fns.saveToArchive(
                    conversation_id,
                    $("#save_name").val(),
                    "text_inspiration",
                    "Bildung",
                );

                $("#save_name").val('');

                showToast(document.title + " Gespeichert!");
            });
        });
    </script>
    <script>
        let textToType = "";
        let textarray = [];
        const typedTextElement = document.getElementById('typed-text');
        let currentChar = 0;
        let curloop = 0;
        let alltext = '';
        const blockSize = 10; // Define blockSize here
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $(document).ready(function() {
            const saveForm = document.getElementById('save_data');
            const saveFormButton = document.getElementById('saveForm');

            $("#submitForm").on("click", function() {
                let form = $("#myForm")[0];
                let formData = new FormData(form);
                $("#save_data").val('x');
                //Ladezeichen anzeigen
                $("#submitForm").addClass('loading-button').text("Zaubert...");


                $.ajax({
                    url: route('bildung.textinspiration.store'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        conversation_id = response.message.conversation_id;
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Magie");
                        textToType = response.message.content.replace(/\n/g, " <br> ");
                        $('#typed-text').empty();
                        let checks = response.message.content.split('\n');
                        textarray = checks;
                        $("#save_val").val(textToType + " <br> <br> ");
                        typeFun();
                        $("#save_folder").show();
                    },
                    error: function(xhr, status, error) {
                        console.error("Ein Fehler ist aufgetreten: " + error);
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Magie");
                    }
                });
            });
        });

        function showToast(message) {
            // Erstelle das Toast-Element
            var toast = document.createElement('div');
            toast.textContent = message;
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.left = '50%';
            toast.style.transform = 'translateX(-50%)';
            toast.style.backgroundColor = 'black';
            toast.style.color = 'white';
            toast.style.padding = '10px';
            toast.style.borderRadius = '5px';
            toast.style.zIndex = '1000';
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.5s';

            // Füge das Toast-Element hinzu und fade es ein
            document.body.appendChild(toast);
            setTimeout(() => toast.style.opacity = '1', 100);

            // Entferne das Toast-Element nach einer gewissen Zeit
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => document.body.removeChild(toast),
                    500); // Warte auf das Ende der Opacity-Transition
            }, 3000);
        }

        async function typeText() {
            if (currentChar < textToType.length) {
                // Füge den nächsten Block von Zeichen hinzu
                let nextBlock = textToType.substring(currentChar, currentChar + blockSize);
                currentChar += blockSize;

                // Überprüfe, ob der Block ein HTML-Tag enthält
                if (nextBlock.includes('<')) {
                    let endTagIndex = textToType.indexOf('>', currentChar);
                    if (endTagIndex !== -1) {
                        nextBlock = textToType.substring(currentChar - blockSize, endTagIndex + 1);
                        currentChar = endTagIndex + 1;
                    }
                }

                typedTextElement.innerHTML += nextBlock;

                await MathJax.typesetPromise([typedTextElement]); // Render MathJax content after each block
                typedTextElement.scrollTop = typedTextElement.scrollHeight; // Scroll to the bottom
                setTimeout(typeText, 20); // Adjust the typing speed (in milliseconds)
            } else {
                // Füge den gesamten Text hinzu und formatiere ihn
                alltext += textToType + " ";
                typedTextElement.innerHTML = alltext;
                currentChar = 0;
                curloop++;
                await MathJax.typesetPromise([typedTextElement]); // Final render of MathJax content
                typedTextElement.scrollTop = typedTextElement.scrollHeight; // Ensure final scroll to the bottom
                typeFun();
            }
        }

        async function typeFun() {
            if (curloop < textarray.length) {
                textToType = textarray[curloop];
                typeText();
            } else {
                alltext = '';
                textToType = [];
                curloop = 0;
                await MathJax.typesetPromise([typedTextElement]); // Ensure final MathJax rendering
                typedTextElement.scrollTop = typedTextElement.scrollHeight; // Ensure final scroll to the bottom
            }
        }
    </script>
</body>

</html>
