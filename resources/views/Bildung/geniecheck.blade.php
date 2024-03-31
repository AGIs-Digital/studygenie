<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head')
@section('title', 'GenieCheck')
</head>

<body class="MainContainer backimage">
	@include('includes.header')
	<section class="GenieBrain_sec">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<div class="leftCon" style="cursor: pointer">
						<img id="closeIcon" onclick="window.history.back()"
							src="{{ asset('asset/images/ic_close.png')}}" alt="closeIcon">

						<svg xmlns="http://www.w3.org/2000/svg" width="134" height="113"
							viewBox="0 0 245 167" fill="none">
                            <g filter="url(#filter0_d_168_754)">
                                <path
								d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
								fill="#F8F8F8"></path>
                                <svg xmlns="http://www.w3.org/2000/svg"
								width="184" height="109" viewBox="0 0 184 109" x="30" y="30">
                                <rect width="100%" height="100%"
									fill="none"></rect>
                                <path
									d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
									fill="#F3922A"></path>
                                <text class="textStyle" x="30" y="65"
									font-family: 'Milonga', cursive; font-size="24" fill="#FFFFFF"
									font-weight="400">GenieCheck</text>
                                </svg>



                            </g>
                            <defs>
                                <filter id="filter0_d_168_754" x="0"
								y="0" width="244.92" height="166.98"
								filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0"
								result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha"
								type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
								result="hardAlpha"></feColorMatrix>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="8.5"></feGaussianBlur>
                                <feComposite in2="hardAlpha"
								operator="out"></feComposite>
                                <feColorMatrix type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                <feBlend mode="normal"
								in2="BackgroundImageFix" result="effect1_dropShadow_168_754"></feBlend>
                                <feBlend mode="normal"
								in="SourceGraphic" in2="effect1_dropShadow_168_754"
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
							<div class="content-written left">
                                <div class="left_scroll">
                                    <div class="group-box">
                                        <span>Text zum Prüfen: <strong type="button" class=""
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Welchen Text möchtest du geprüft haben?"> <img
                                                src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="">
                                        </strong>
                                        </span>
                                        <textarea name="text1" id="field1" cols="30" rows="10" required></textarea>
                                    </div>

                                    <div class="group-box">
                                        <span>Zitierweise: <strong type="button" class=""
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Prüfe zusätzlich die Zitation"> <img
                                                src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="">
                                        </strong>
                                        </span>
                                        <div class="custom-select">
                                            <select name="citation">
                                                <option value="0">Zitierweise auswählen</option>
                                                <option value="Deutsche Zitierweise">Deutsche Zitierweise</option>
                                                <option value="APA">APA</option>
                                                <option value="MLA">MLA</option>
                                                <option value="Chicago">Chicago</option>
                                                <option value="Harvard">Harvard</option>
                                                <option value="Vancouver">Vancouver</option>
                                                <option value="ISO 690">ISO 690</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

							</div>

							<button type="button" class="send_button" id="submitForm">Prüfen</button>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<div class="written-green-board">

						<div class="content-written right" id="checkcontent_box">
							<div class="typing-container">
								<div id="typed-text"></div>
							</div>
						</div>
                        <div class="save_folder center" id="save_folder" data-bs-toggle="modal"
                            data-bs-target="#saveModal">
                            <img src="{{ asset('asset/images/savefolder.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Speichern" width="40"
                            height="40" alt="">
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="saveModal" tabindex="-1"
		aria-labelledby="saveModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="save_data">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="saveModalLabel">Antwort speichern</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Name:</label>
							<input type="text" class="form-control" id="save_name"
								name="name" placeholder="Speichername eingeben">
						</div>
						<input type="hidden" name="save_val" id="save_val"> <input
							type="hidden" name="tooltype" value="GenieCheck"> <input
							type="hidden" name="type" value="Bildung" id="Bildung">



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
							data-bs-dismiss="modal">Schließen</button>
						<button type="button" class="btn btn-primary" id="saveForm">Speichern</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
        let textToType = "";
        let textarray = [];

        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
          selElmnt = x[i].getElementsByTagName("select")[0];
          ll = selElmnt.length;
          /*for each element, create a new DIV that will act as the selected item:*/
          a = document.createElement("DIV");
          a.setAttribute("class", "select-selected");
          a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
          x[i].appendChild(a);
          /*for each element, create a new DIV that will contain the option list:*/
          b = document.createElement("DIV");
          b.setAttribute("class", "select-items select-hide");
          for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                  if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                      y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                  }
                }
                h.click();
            });
            b.appendChild(c);
          }
          x[i].appendChild(b);
          a.addEventListener("click", function(e) {
              e.stopPropagation();
              closeAllSelect(this);
              this.nextSibling.classList.toggle("select-hide");
              this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {/
          var x, y, i, xl, yl, arrNo = [];
          x = document.getElementsByClassName("select-items");
          y = document.getElementsByClassName("select-selected");
          xl = x.length;
          yl = y.length;
          for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
              arrNo.push(i)
            } else {
              y[i].classList.remove("select-arrow-active");
            }
          }
          for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
            }
          }
        }

        document.addEventListener("click", closeAllSelect);

        $(document).ready(function () {
            $("#submitForm").click(function () {
                var form = document.getElementById("myForm");
                var formData = new FormData(form);
                // document.getElementById('typed-text').style.height = 'auto';
                $.ajax({
                    url: "{{ route('GenieCheck') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $("#submitForm").text("lädt...");
                    },
                    success: function (data) {
                        $("#submitForm").text("Senden");
                        // textToType = data.choices[0]['message']['content'];
                        textToType = data.choices[0]['message']['content'].replace(/\n/g, " <br> ");
                        document.getElementById('typed-text').innerHTML = '';
                        let checks = data.choices[0]['message']['content'].split('\n');
                        textarray = checks;
                        // document.getElementById('typed-text').innerHTML = textToType+" <br> <br> ";
                        // typeText();
                        $("#save_folder").css('display','block');
                        document.getElementById("save_val").value = textToType+" <br> <br> ";
                        typeFun();
                       console.log(data.choices[0]['message']['content']);
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                    }
                });
            });

            $("#saveForm").click(function () {
                var form = document.getElementById("save_data");
                var formData = new FormData(form);

                $.ajax({
                    url: "{{ route('save.data') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                       $("#save_name").val('');
                       $("#saveModal").modal('hide');
                       // Zeige eine Toast-Nachricht an
    				showToast(document.title + " Gespeichert!");
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                    }
                });
            });

/**
 * Erstellt und zeigt eine Toast-Nachricht mit einer gegebenen Nachricht an.
 * @param {string} message - Die Nachricht, die im Toast angezeigt werden soll.
 */
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
    setTimeout(() => document.body.removeChild(toast), 500); // Warte auf das Ende der Opacity-Transition
  }, 3000);
}


            $('#field1').on('keyup', function() {
                // Get the typed text from field1
                var typedText = $(this).val();

                // Disable other fields (field2 and field3)
                $('#field2').prop('disabled', true);
                $("#type").val('first');
                // Enable them again when text is cleared in field1
                if (typedText === '') {
                    $("#type").val('first');
                    $('#field2').prop('disabled', false);
                }
            });

            $('#field2').on('keyup', function() {
                // Get the typed text from field1
                var typedText = $(this).val();

                // Disable other fields (field2 and field3)
                $('#field1').prop('disabled', true);
                $("#type").val('second');
                // Enable them again when text is cleared in field1
                if (typedText === '') {
                    $("#type").val('first');
                    $('#field1').prop('disabled', false);
                }
            });
        });



        const typedTextElement = document.getElementById('typed-text');
        let currentChar = 0;
        let curloop = 0;
        let alltext = '';

        function typeText() {
            if (currentChar < textToType.length) {
                typedTextElement.innerHTML += textToType.charAt(currentChar);
                currentChar++;
                // $('#checkcontent_box').animate({
                //             scrollTop: $('#checkcontent_box').get(0).scrollHeight
                //         }, 2000);
                setTimeout(typeText, 10); // Adjust the typing speed (in milliseconds)
                typedTextElement.scrollTop = typedTextElement.scrollHeight;

            }else {
                alltext +=textToType+" <br> ";
                typedTextElement.innerHTML = alltext;
                currentChar = 0;
                curloop++;
                typeFun();
            }
        }

        function typeFun(){
            if(curloop < textarray.length){
                textToType = textarray[curloop];
                typeText();
            }else {
                alltext = '';
                textToType= [];
                curloop = 0;
            }
        }
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        </script>
</body>

</html>
