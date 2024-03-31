<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head')
@section('title', 'Tools')
<link rel="stylesheet" href="{{ asset('asset/css/ToolsStyle.css') }}">
</head>

<body class="MainContainer">
	@include('includes.header')

	<main class="mainContainer">
		<img src="{{ asset('asset/images/ab1.svg') }}" class="ab1" alt=""> <img
			src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt=""> <img
			src="{{ asset('asset/images/ab3.svg') }}" class="ab3" alt=""> <img
			src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="">
		<div class="container">
			<div class="content text-center">
				<h1 class="primary-Heading">Wobei kann ich dir helfen?</h1><br />

				<img id="StudyGenieImage"
					src="{{ asset('asset/images/ToolsImage.png') }}"
					alt="StudyGenieImage">

				<div class="categoryClouds">
					<a href="/Bildung" class="BildungCloud"> <svg
							xmlns="http://www.w3.org/2000/svg" width="245" height="167"
							viewBox="0 0 245 167" fill="none">
                    <g filter="url(#filter0_d_168_754)">
                        <path
								d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
								fill="#F8F8F8" />
                        <svg xmlns="http://www.w3.org/2000/svg"
								width="184" height="109" viewBox="0 0 184 109" x="30" y="30">
                        <rect width="100%" height="100%" fill="none" />
                        <path
									d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
									fill="#F3922A" />
                        <text class="textStyle" x="60" y="65"
									font-family: 'Milonga', cursive; font-size="24" fill="black"
									font-weight="400">Bildung</text>
                        </svg>



                    </g>
                    <defs>
                        <filter id="filter0_d_168_754" x="0" y="0"
								width="244.92" height="166.98" filterUnits="userSpaceOnUse"
								color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0"
								result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
								result="hardAlpha" />
                        <feOffset />
                        <feGaussianBlur stdDeviation="8.5" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix"
								result="effect1_dropShadow_168_754" />
                        <feBlend mode="normal" in="SourceGraphic"
								in2="effect1_dropShadow_168_754" result="shape" />
                        </filter>
                    </defs>
                    </svg>
					</a> <a href="/Karriere" class="KarriereCloud"> <svg
							xmlns="http://www.w3.org/2000/svg" width="245" height="167"
							viewBox="0 0 245 167" fill="none">
                    <g filter="url(#filter0_d_168_754)">
                        <path
								d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
								fill="#F8F8F8" />
                        <svg xmlns="http://www.w3.org/2000/svg"
								width="184" height="109" viewBox="0 0 184 109" x="30" y="30">
                        <rect width="100%" height="100%" fill="none" />
                        <path
									d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
									fill="#2D3E4E" />
                        <text class="textStyle" x="60" y="65"
									font-family: 'Milonga', cursive; font-size="23" fill="#FFFFFF"
									font-weight="400">Karriere</text>
                        </svg>



                    </g>
                    <defs>
                        <filter id="filter0_d_168_754" x="0" y="0"
								width="244.92" height="166.98" filterUnits="userSpaceOnUse"
								color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0"
								result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
								result="hardAlpha" />
                        <feOffset />
                        <feGaussianBlur stdDeviation="8.5" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix"
								values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix"
								result="effect1_dropShadow_168_754" />
                        <feBlend mode="normal" in="SourceGraphic"
								in2="effect1_dropShadow_168_754" result="shape" />
                        </filter>
                    </defs>
                    </svg>

					</a>




				</div>
			</div>
		</div>

	</main>




	<div class="tutorial_sec">
		<div class="content_box">
			<div class="cross_tut" onclick="crosstut();">
				<img src="{{ asset('asset/images/crosstut.svg') }}" alt="">
			</div>
			<div class="image_box_first" id="first">
				<div class="first_img">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Wir haben für dich zwei besondere Bereiche geschaffen, um dich
						persönlich zu begleiten und zu unterstützen</p>
					<div class="svg_box" onclick="changeTime('second')">

						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
							viewBox="0 0 100.06 74">
                        <g id="Group_66" data-name="Group 66"
								transform="translate(-5793 -5816)">
                        <path id="Path_302" data-name="Path 302"
								d="M0,13,37,50,0,86.94q11.51-.07,23-.07L59.9,50,23.14,13.23q-9.29,0-18.58-.11h0C5,13.12,2.72,13.07,0,13Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                        <path id="Path_303" data-name="Path 303"
								d="M40.34,13.25,77.09,50,40.18,86.89q7.44,0,14.88.11c-1.1,0,3.86-.09,8,0l37-37L63.16,13.15C55.55,13.22,48,13.24,40.34,13.25Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                        </g>
                    </svg>
					</div>

					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
			</div>

			<div class="image_box_first sec" id="second">
				<div class="first_img">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Hier findest du alles rund um das Thema Lernen. Ich erkläre dir
						alle möglichen Themen oder erstelle gemeinsam mit dir
						Übungsaufgaben oder deinen persönlichen Lernplan. Alles was du
						brauchst, um in der Schule oder der Uni erfolgreich zu sein,
						wartet hier auf dich</p>
					<div class="svg_box" onclick="changeTime('third')">

						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
							viewBox="0 0 100.06 74">
                            <g id="Group_66" data-name="Group 66"
								transform="translate(-5793 -5816)">
                            <path id="Path_302" data-name="Path 302"
								d="M0,13,37,50,0,86.94q11.51-.07,23-.07L59.9,50,23.14,13.23q-9.29,0-18.58-.11h0C5,13.12,2.72,13.07,0,13Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            <path id="Path_303" data-name="Path 303"
								d="M40.34,13.25,77.09,50,40.18,86.89q7.44,0,14.88.11c-1.1,0,3.86-.09,8,0l37-37L63.16,13.15C55.55,13.22,48,13.24,40.34,13.25Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            </g>
                        </svg>
					</div>
					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
				<div class="four_img wow fadeInUp">
					<img src="{{ asset('asset/images/arrow_bottom.svg') }}" alt="">
				</div>
			</div>

			<div class="image_box_first thi" id="third">
				<div class="first_img">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img ">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Der Berufseinstieg kann überwältigend sein. In diesem Bereich
						schauen wir, welche Berufe wirklich zu deinen Fähigkeiten und
						Interessen passen. Ich helfe dir bei der Erstellung von
						Bewerbungsunterlagen und biete dir Tipps, um dich auf
						Vorstellungsgespräche vorzubereiten und in der Arbeitswelt
						durchzustarten.</p>
					<div class="svg_box" onclick="changeTime('four')">

						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
							viewBox="0 0 100.06 74">
                            <g id="Group_66" data-name="Group 66"
								transform="translate(-5793 -5816)">
                            <path id="Path_302" data-name="Path 302"
								d="M0,13,37,50,0,86.94q11.51-.07,23-.07L59.9,50,23.14,13.23q-9.29,0-18.58-.11h0C5,13.12,2.72,13.07,0,13Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            <path id="Path_303" data-name="Path 303"
								d="M40.34,13.25,77.09,50,40.18,86.89q7.44,0,14.88.11c-1.1,0,3.86-.09,8,0l37-37L63.16,13.15C55.55,13.22,48,13.24,40.34,13.25Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            </g>
                        </svg>
					</div>
					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
				<div class="four_img wow fadeInUp">
					<img src="{{ asset('asset/images/arrow2.svg') }}" alt="">
				</div>
			</div>
			<div class="image_box_first fou" id="four">
				<div class="first_img ">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Im 'Archiv' kannst du wertvolle Antworten und Tipps aus unseren
						Chats speichern. So hast du jederzeit schnellen Zugriff auf
						bereits besprochene Inhalte und kannst sicher sein, dass keine
						wichtige Information verloren geht. Denke daran, es als dein
						persönliches Wissensschatzkästchen zu nutzen!</p>
					<div class="svg_box" onclick="changeTime('five')">

						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
							viewBox="0 0 100.06 74">
                        <g id="Group_66" data-name="Group 66"
								transform="translate(-5793 -5816)">
                        <path id="Path_302" data-name="Path 302"
								d="M0,13,37,50,0,86.94q11.51-.07,23-.07L59.9,50,23.14,13.23q-9.29,0-18.58-.11h0C5,13.12,2.72,13.07,0,13Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                        <path id="Path_303" data-name="Path 303"
								d="M40.34,13.25,77.09,50,40.18,86.89q7.44,0,14.88.11c-1.1,0,3.86-.09,8,0l37-37L63.16,13.15C55.55,13.22,48,13.24,40.34,13.25Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                        </g>
                    </svg>
					</div>
					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
				<div class="four_img wow fadeInUp">
					<img src="{{ asset('asset/images/arrow2.svg') }}" alt="">
				</div>
			</div>

			<div class="image_box_first fou fiv" id="five">
				<div class="first_img ">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Im Bereich 'Profil' kannst du ganz bequem dein gewünschtes Abo
						auswählen und bei Bedarf dein Passwort ändern. Gestalte hier
						StudyGenie so, wie es am besten zu dir und deinen Bedürfnissen
						passt!</p>
					<div class="svg_box" onclick="changeTime('six')">

						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
							viewBox="0 0 100.06 74">
                            <g id="Group_66" data-name="Group 66"
								transform="translate(-5793 -5816)">
                            <path id="Path_302" data-name="Path 302"
								d="M0,13,37,50,0,86.94q11.51-.07,23-.07L59.9,50,23.14,13.23q-9.29,0-18.58-.11h0C5,13.12,2.72,13.07,0,13Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            <path id="Path_303" data-name="Path 303"
								d="M40.34,13.25,77.09,50,40.18,86.89q7.44,0,14.88.11c-1.1,0,3.86-.09,8,0l37-37L63.16,13.15C55.55,13.22,48,13.24,40.34,13.25Z"
								transform="translate(5793 5803)" fill="#f3922a" />
                            </g>
                        </svg>
					</div>
					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
				<div class="four_img wow fadeInUp">
					<img src="{{ asset('asset/images/arrow2.svg') }}" alt="">
				</div>
			</div>

			<div class="image_box_first six" id="six">
				<div class="first_img">
					<img src="{{ asset('asset/images/lamp.svg') }}" alt="">
				</div>
				<div class="second_img">
					<img src="{{ asset('asset/images/geni.svg') }}" alt="">
				</div>
				<div class="third_img wow fadeInRight">
					<p>Nun weißt du alles, damit wir zusammen durchstarten können.
						Gemeinsam nehmen wir den Druck aus dem Lernen und deinem
						Karriereweg. Und nun liegt es an dir, womit möchtest du starten?</p>
					<img src="{{ asset('asset/images/textimage.svg') }}" alt="">
				</div>
			</div>
		</div>

	</div>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
    new WOW().init();
    var checktrue = true;
        
        let firstPageTime = true;
        let secondPageTime = true;
        let thirdPageTime = true;
        let fourPageTime = true;
        let fivePageTime = true;
        let sixPageTime = true;

        $(window).on('resize', function(){
            var win = $(this); //this = window
            if (win.width() < 993) {
                checktrue = false;
            var tut =  document.querySelectorAll(".tutorial_sec");
            tut[0].style.display = 'none';

            document.body.style.overflow = 'auto';
            document.querySelectorAll(".BildungCloud")[0].classList.remove('active');
            document.querySelectorAll(".KarriereCloud")[0].classList.remove('active');
            document.querySelectorAll(".archive")[0].classList.remove('active');
            document.querySelectorAll(".profile_u")[0].classList.remove('active');
            }
        });
        function changeTime(varname){
            if(varname == 'second'){
                // alert('hello');

                    document.getElementById("first").style.display = 'none';
                        document.querySelectorAll(".BildungCloud")[0].classList.add('active');
                    var sec =  document.getElementById("second");
                    sec.style.display = 'block';
                    secondPageTime = false;

            }

            if(varname == 'third'){
                    document.getElementById("second").style.display = 'none';
                    document.querySelectorAll(".BildungCloud")[0].classList.remove('active');
                    document.querySelectorAll(".KarriereCloud")[0].classList.add('active');
                    var sec =  document.getElementById("third");
                    sec.style.display = 'block';
                    thirdPageTime = false;
            }

            if(varname == 'four'){
                document.getElementById("third").style.display = 'none';
                document.querySelectorAll(".KarriereCloud")[0].classList.remove('active');
                document.querySelectorAll(".archive")[0].classList.add('active');
                var sec =  document.getElementById("four");
                sec.style.display = 'block';

                    fivePageTime = false;
            }

            if(varname == 'five'){
                document.getElementById("four").style.display = 'none';
                document.querySelectorAll(".archive")[0].classList.remove('active');

                document.querySelectorAll(".profile_u")[0].classList.add('active');
                var sec =  document.getElementById("five");
                sec.style.display = 'block';

                fivePageTime = false;
            }

            if(varname == 'six'){
                document.getElementById("five").style.display = 'none';
                        document.querySelectorAll(".profile_u")[0].classList.remove('active');
                        var sec =  document.getElementById("six");
                        sec.style.display = 'block';

                sixPageTime = false;
            }
        }



        var w = window.innerWidth;
        var getCoookie=getCookie("user_about");
        if(!getCoookie){
            var tut =  document.querySelectorAll(".tutorial_sec");
            setTimeout(function(){
            if(w > 992){
            tut[0].style.display = 'block';
            }
            document.body.style.overflow = 'hidden';
            }, 2000);


            setTimeout(function(){
                if(checktrue){
                    if(secondPageTime){
                        document.getElementById("first").style.display = 'none';
                            document.querySelectorAll(".BildungCloud")[0].classList.add('active');
                        var sec =  document.getElementById("second");
                        sec.style.display = 'block';
                    }
                }


            }, 10000);

            setTimeout(function(){
                if(checktrue){
                    if(thirdPageTime){
                        document.getElementById("second").style.display = 'none';
                        document.querySelectorAll(".BildungCloud")[0].classList.remove('active');
                        document.querySelectorAll(".KarriereCloud")[0].classList.add('active');
                        var sec =  document.getElementById("third");
                        sec.style.display = 'block';
                    }
                }

            }, 22000);

            setTimeout(function(){
                if(checktrue){
                    if(fourPageTime){
                        document.getElementById("third").style.display = 'none';
                        document.querySelectorAll(".KarriereCloud")[0].classList.remove('active');
                        document.querySelectorAll(".archive")[0].classList.add('active');
                        var sec =  document.getElementById("four");
                        sec.style.display = 'block';
                    }
                }


            }, 32000);


            setTimeout(function(){
                if(checktrue){
                    if(fivePageTime){
                        document.getElementById("four").style.display = 'none';
                        document.querySelectorAll(".archive")[0].classList.remove('active');

                        document.querySelectorAll(".profile_u")[0].classList.add('active');
                        var sec =  document.getElementById("five");
                        sec.style.display = 'block';
                    }
                }

            }, 40000);


            setTimeout(function(){
                if(checktrue){
                    if(sixPageTime){
                        document.getElementById("five").style.display = 'none';
                        document.querySelectorAll(".profile_u")[0].classList.remove('active');
                        var sec =  document.getElementById("six");
                        sec.style.display = 'block';
                    }
                }
            }, 50000);

            function crosstut(){
                checktrue = false;
                var tut =  document.querySelectorAll(".tutorial_sec");
            tut[0].style.display = 'none';

            document.body.style.overflow = 'auto';
            document.querySelectorAll(".BildungCloud")[0].classList.remove('active');
            document.querySelectorAll(".KarriereCloud")[0].classList.remove('active');
            document.querySelectorAll(".archive")[0].classList.remove('active');
            document.querySelectorAll(".profile_u")[0].classList.remove('active');
            setCookie("user_about","modal_not_show",30);
        }
        }
        function setCookie(name,value,days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }
        function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
        }

</script>

</body>
</html>
