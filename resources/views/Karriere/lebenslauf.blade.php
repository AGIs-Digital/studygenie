<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lebenslauf</title>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
	rel="stylesheet">

<link rel="stylesheet" href="{{ asset('asset/css/navBarStyle.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/utilities.css') }}">
<link rel="stylesheet"
	href="{{ asset('asset/css/written-green-board.css') }}">
<link rel="apple-touch-icon" sizes="57x57"
	href="/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60"
	href="/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76"
	href="/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120"
	href="/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144"
	href="/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152"
	href="/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180"
	href="/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"
	href="/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32"
	href="/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96"
	href="/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16"
	href="/favicon/favicon-16x16.png">
<link rel="manifest" href="/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage"
	content="/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
</head>

<body class="MainContainer">
	@include('includes.header')
	<section class="archive_sec">
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
									fill="rgba(41,58,74,1)"></path>
                                <text class="textStyle" x="28" y="65"
									font-family: 'Milonga', cursive; font-size="24" fill="#FFFFFF"
									font-weight="400">Lebenslauf</text>
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

				<div class="col-md-3">
					<h2
						style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">Lebenslauf</h2>
					<div class="accordion accordion-flush" id="accordionFlushExample"
						style="border: 1px solid #293a4a; border-radius: 12px;">

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingOne">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
									aria-expanded="false" aria-controls="flush-collapseOne">
									Persönliche Informationen</button>
							</h2>
							<div id="flush-collapseOne" class="accordion-collapse collapse"
								aria-labelledby="flush-headingOne"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="form-group">
											<label for="">Vor</label> <input type="text"
												id="first_name">
										</div>
										<div class="form-group">
											<label for="">Nach</label> <input type="text"
												id="last_name">
										</div>
										<div class="form-group">
											<label for="">Anschrift</label> <input type="text"
												id="address">
										</div>
										<div class="form-group">
											<label for="">Postleitzahl</label> <input type="text"
												id="postal_code">
										</div>
										<div class="form-group">
											<label for="">Ort</label> <input type="text" id="city_date">
										</div>
										<div class="form-group">
											<label for="">Telefon</label> <input type="text" id="phone">
										</div>
										<div class="form-group">
											<label for="">E-Mail-Adresse</label> <input type="email"
												id="email_address">
										</div>

										<div class="form-group">
											<label for="">Geburtsdatum</label> <input type="date"
												id="birth_date">
										</div>

									</div>

								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingTwo">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
									aria-expanded="false" aria-controls="flush-collapseTwo">
									Beruflicher Werdegang</button>
							</h2>
							<div id="flush-collapseTwo" class="accordion-collapse collapse"
								aria-labelledby="flush-headingTwo"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="all_box" id="personal_box_open">
											<div class="box">

												<div class="form-group">
													<label for="">Position</label> <input type="text"
														class="position">
												</div>
												<div class="form-group">
													<label for="">Arbeitgeber</label> <input type="text"
														class="employer">
												</div>
												<div class="form-group">
													<label for="">Startdatum</label> <input type="date"
														class="start_date">
												</div>
												<div class="form-group">
													<label for="">Enddatum</label> <input type="date"
														class="end_date">
												</div>

											</div>
										</div>




										<div class="button" onclick="proBack();">
											<button>+ weiteren Job hinzufügen</button>
										</div>


									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingThree">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
									aria-expanded="false" aria-controls="flush-collapseThree">
									Ausbildung</button>
							</h2>
							<div id="flush-collapseThree" class="accordion-collapse collapse"
								aria-labelledby="flush-headingThree"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="all_box" id="trainig_append">
											<div class="box">
												<div class="form-group">
													<label for="">Abschluss</label> <input type="text"
														class="diploma">
												</div>
												<div class="form-group">
													<label for="">Bildungseinrichtung</label> <input
														type="text" class="educational_institution">
												</div>
												<div class="form-group">
													<label for="">Startdatum</label> <input type="date"
														class="a_start_date">
												</div>
												<div class="form-group">
													<label for="">Datum des Abschlusses</label> <input
														type="date" class="date_of_completion">
												</div>

											</div>
										</div>

										<div class="button" onclick="traningAppend();">
											<button>+ weiten Abschluss hinzufügen</button>
										</div>


									</div>
								</div>
							</div>

						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingfour">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapsefour"
									aria-expanded="false" aria-controls="flush-collapsefour">
									Kenntnisse</button>
							</h2>
							<div id="flush-collapsefour" class="accordion-collapse collapse"
								aria-labelledby="flush-headingfour"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="all_box box" id="expertise_append">
											<div class="form-group">

												<label for="" style="font-family: auto;">Fähigkeit</label> <input
													type="text" class="Capability">
											</div>


										</div>

										<div class="button" onclick="proCapability();">
											<button>+ weitere Fähigkeit hinzufügen</button>
										</div>


									</div>
								</div>
							</div>

						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingfive">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapsefive"
									aria-expanded="false" aria-controls="flush-collapsefive">
									Sprachen</button>
							</h2>
							<div id="flush-collapsefive" class="accordion-collapse collapse"
								aria-labelledby="flush-headingfive"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="all_box" id="language_append">
											<div class="box">
												<div class="form-group">
													<label for="">Sprachen</label> <input type="text"
														class="language">
												</div>
												<div class="form-group">
													<label for="">Level</label> <input type="text"
														class="level">
												</div>


											</div>
										</div>

										<div class="button" onclick="languageAppend();">
											<button>+ weitere Sprache hinzufügen</button>
										</div>


									</div>
								</div>
							</div>

						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingsix">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapsesix"
									aria-expanded="false" aria-controls="flush-collapsesix">
									Ehrenamtliche Tätigkeiten</button>
							</h2>
							<div id="flush-collapsesix" class="accordion-collapse collapse"
								aria-labelledby="flush-headingsix"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="box" id="voluntry_append">
											<div class="form-group">
												<label for="" style="font-family: auto;">Tätigkeit</label> <input
													type="text" class="task">
											</div>


										</div>

										<div class="button" onclick="voluntryfun();">
											<button>+ weitere Tätigkeit hinzufügen</button>
										</div>


									</div>
								</div>
							</div>

						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingseven">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#flush-collapseseven"
									aria-expanded="false" aria-controls="flush-collapseseven">Ort &
									Datum</button>
							</h2>
							<div id="flush-collapseseven" class="accordion-collapse collapse"
								aria-labelledby="flush-headingseven"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="personal_info">
										<div class="all_box" id="place_append">
											<div class="box">
												<div class="form-group">
													<label for="">Ort</label> <input type="text" id="location">
												</div>
												<div class="form-group">
													<label for="">Datum</label> <input type="date" id="o_date">
												</div>


											</div>
										</div>



									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="text-center">
						<button
							style="width: 156px; font-size: 12px; padding: 8px 7px; border: none; color: #fff; background: #f3922a; border-radius: 7px; margin-top: 10px; margin-left: auto; margin-right: auto;"
							onclick="writeCv();">einreichen</button>
					</div>


				</div>

				<div class="col-md-7">
					<div class="cv_box_sec" id="cv_appnd">
						{{--
						<div class="cv_box" id="all_cv_content">
							<h2>
								<span>Tom</span> <span>Ablen</span>
							</h2>
							<div class="personal_info_box">
								<div class="row">
									<div class="col-md-5 mt-2">
										<div class="box">
											<div class="img">
												<img src="{{ asset(" asset/images/location.svg") }}" alt="">
											</div>
											<div class="content">
												<span>address</span> <span>postal_code</span>
											</div>
										</div>
									</div>
									<div class="col-md-5 mt-2">
										<div class="box">
											<div class="img">
												<svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 5.822 5.822">
                                                    <g id="Group_66"
														data-name="Group 66"
														transform="translate(-0.264 -290.914)">
                                                      <path
														id="Path_302" data-name="Path 302"
														d="M1.059.264a.8.8,0,0,0-.8.795V5.292a.8.8,0,0,0,.8.795H5.291a.8.8,0,0,0,.795-.795V1.059A.8.8,0,0,0,5.291.264Zm0,.529H5.291a.26.26,0,0,1,.266.266v.264H.793V1.059A.261.261,0,0,1,1.059.793ZM.793,1.852H5.557v3.44a.26.26,0,0,1-.266.266H1.059a.261.261,0,0,1-.266-.266Zm1.853.529a.265.265,0,1,0,.265.265A.265.265,0,0,0,2.646,2.381Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,2.381Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,4.762,2.381ZM1.587,3.44a.265.265,0,1,0,.265.265A.265.265,0,0,0,1.587,3.44Zm1.058,0A.265.265,0,1,0,2.91,3.7.265.265,0,0,0,2.646,3.44Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,3.44Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,4.762,3.44ZM1.587,4.5a.265.265,0,1,0,.265.265A.265.265,0,0,0,1.587,4.5Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,2.646,4.5ZM3.7,4.5a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,4.5Z"
														transform="translate(0 290.65)" fill="#fff"
														fill-rule="evenodd" />
                                                    </g>
                                                  </svg>

											</div>
											<div class="content">
												<span>address</span>

											</div>
										</div>
									</div>
									<div class="col-md-5 mt-3">
										<div class="box">
											<div class="img">
												<svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 92.636 92.638">
                                                    <path id="Path_303"
														data-name="Path 303"
														d="M94,77.1l-.743,8.063a14.757,14.757,0,0,1-6.2,10.731,14.942,14.942,0,0,1-8.558,2.707,15.207,15.207,0,0,1-3.745-.477A101.491,101.491,0,0,1,1.877,25.269a14.915,14.915,0,0,1,2.23-12.3,14.756,14.756,0,0,1,10.722-6.2l8.082-.753a9.434,9.434,0,0,1,10.112,7.548,68.02,68.02,0,0,0,3.926,12.752A9.461,9.461,0,0,1,32.86,38.259L27.79,41.07A83.343,83.343,0,0,0,58.945,72.225l2.811-5.07a9.447,9.447,0,0,1,11.951-4.088,69,69,0,0,0,12.751,3.926A9.427,9.427,0,0,1,94,77.1Z"
														transform="translate(-1.401 -5.967)" fill="#fff" />
                                                  </svg>
											</div>
											<div class="content">
												<span>+92 3242342141</span>

											</div>
										</div>
									</div>
									<div class="col-md-5 mt-3">
										<div class="box">
											<div class="img">
												<svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 81.84 54.6">
                                                    <g id="_1"
														data-name="1" transform="translate(-7.08 -20.7)">
                                                      <path
														id="Path_304" data-name="Path 304"
														d="M88.92,67.3a8,8,0,0,1-1.4,4.519L60.12,48l27.4-23.82a8,8,0,0,1,1.4,4.52ZM48,53.24l36.46-31.7a8,8,0,0,0-3.54-.84H15.08a8,8,0,0,0-3.54.84ZM8.48,24.18a8,8,0,0,0-1.4,4.52V67.3a8,8,0,0,0,1.4,4.519L35.88,48Zm48.6,26.47L49.31,57.4a2,2,0,0,1-2.62,0l-7.77-6.75L11.54,74.46a8,8,0,0,0,3.54.84H80.92a8,8,0,0,0,3.54-.84Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>

											</div>
											<div class="content">
												<span>example@gmail.com</span>

											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="professional_background_box mt-4">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<span> <svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 28 26">
                                                    <g id="Layer_2"
														data-name="Layer 2" transform="translate(-2 -3)">
                                                      <path
														id="Path_305" data-name="Path 305"
														d="M28,7H22V6a3,3,0,0,0-3-3H13a3,3,0,0,0-3,3V7H4A2,2,0,0,0,2,9v5a3,3,0,0,0,2,2.816V26a3,3,0,0,0,3,3H25a3,3,0,0,0,3-3V16.816A3,3,0,0,0,30,14V9A2,2,0,0,0,28,7ZM12,6a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1V7H12ZM26,26a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V17H8v1a1,1,0,0,0,2,0V17H22v1a1,1,0,0,0,2,0V17h2Zm2-12a1,1,0,0,1-1,1H24V14a1,1,0,0,0-2,0v1H10V14a1,1,0,0,0-2,0v1H5a1,1,0,0,1-1-1V9H28Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>
											</span> Beruflicher Werdegang
										</h3>
									</div>
									<div class="col-md-3 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>
									<div class="col-md-5 mt-2">
										<span class="edu_1"> Sales & Marketing Manager </span> <span
											class="location_edu"> Edward </span>
									</div>
								</div>
							</div>

							<div class="training_sec_box mt-4">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<span> <svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 120 94.2">
                                                    <g id="Group_66"
														data-name="Group 66" transform="translate(-15 -27.9)">
                                                      <path
														id="Path_306" data-name="Path 306"
														d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z"
														fill="#fff" />
                                                      <path
														id="Path_307" data-name="Path 307"
														d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_308" data-name="Path 308"
														d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z"
														fill="#fff" />
                                                      <path
														id="Path_309" data-name="Path 309"
														d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_310" data-name="Path 310"
														d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff" />
                                                      <path
														id="Path_311" data-name="Path 311"
														d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>
											</span> Ausbildung
										</h3>
									</div>
									<div class="col-md-3 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>
									<div class="col-md-8 mt-2">
										<span class="edu_1"> Sales & Marketing Manager </span> <span
											class="location_edu"> Edward </span>
									</div>
									<div class="col-md-3 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>
									<div class="col-md-5 mt-2">
										<span class="edu_1"> Sales & Marketing Manager </span> <span
											class="location_edu"> Edward </span>
									</div>
								</div>
							</div>

							<div class="expertise_sec_box mt-4">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<span> <svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 120 94.2">
                                                    <g id="Group_66"
														data-name="Group 66" transform="translate(-15 -27.9)">
                                                      <path
														id="Path_306" data-name="Path 306"
														d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z"
														fill="#fff" />
                                                      <path
														id="Path_307" data-name="Path 307"
														d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_308" data-name="Path 308"
														d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z"
														fill="#fff" />
                                                      <path
														id="Path_309" data-name="Path 309"
														d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_310" data-name="Path 310"
														d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff" />
                                                      <path
														id="Path_311" data-name="Path 311"
														d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>
											</span> Kenntnisse
										</h3>
									</div>
									<div class="col-md-3 mt-2"></div>
									<div class="col-md-6 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>


								</div>
							</div>

							<div class="sprachen_sec_box mt-4">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<span> <svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 120 94.2">
                                                    <g id="Group_66"
														data-name="Group 66" transform="translate(-15 -27.9)">
                                                      <path
														id="Path_306" data-name="Path 306"
														d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z"
														fill="#fff" />
                                                      <path
														id="Path_307" data-name="Path 307"
														d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_308" data-name="Path 308"
														d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z"
														fill="#fff" />
                                                      <path
														id="Path_309" data-name="Path 309"
														d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_310" data-name="Path 310"
														d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff" />
                                                      <path
														id="Path_311" data-name="Path 311"
														d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>
											</span> Sprachen
										</h3>
									</div>
									<div class="col-md-3 mt-2"></div>
									<div class="col-md-6 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>


								</div>
							</div>
							<div class="Other_activities_sec_box mt-4">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<span> <svg xmlns="http://www.w3.org/2000/svg" width="14"
													height="14" viewBox="0 0 120 94.2">
                                                    <g id="Group_66"
														data-name="Group 66" transform="translate(-15 -27.9)">
                                                      <path
														id="Path_306" data-name="Path 306"
														d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z"
														fill="#fff" />
                                                      <path
														id="Path_307" data-name="Path 307"
														d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_308" data-name="Path 308"
														d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z"
														fill="#fff" />
                                                      <path
														id="Path_309" data-name="Path 309"
														d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z"
														fill="#fff" />
                                                      <path
														id="Path_310" data-name="Path 310"
														d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff" />
                                                      <path
														id="Path_311" data-name="Path 311"
														d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z"
														fill="#fff" />
                                                    </g>
                                                  </svg>
											</span> Weitere Tätigkeiten
										</h3>
									</div>
									<div class="col-md-3 mt-2"></div>
									<div class="col-md-6 mt-2">
										<span class="left_date"> 08/2023 - 03/2025 </span>
									</div>


								</div>
							</div>

							<h4 class="mt-4">However 30,10,2019</h4>
						</div>
						--}}
					</div>

				</div>


			</div>
		</div>
	</section>

	<div class="save_folder" id="save_folder" onclick="generatePDF()">
		<img src="{{ asset('asset/images/pdf.svg') }}" width="30" height="30"
			alt="">
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

	<script>
        window.jsPDF = window.jspdf.jsPDF;
        var constvar = 0;
        function proBack(){
            constvar++;
           var text = `<div class="box mt-3" id="pro_${constvar}">
            <span onclick="deletePro(${constvar})">X</span>
                                            <div class="form-group">
                                                <label for="">Position</label>
                                                <input type="text" class="position">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Arbeitgeber</label>
                                                <input type="text" class="employer">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Startdatum</label>
                                                <input type="date" class="start_date">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Enddatum</label>
                                                <input type="date" class="end_date">
                                            </div>

                                        </div>`;
                                        $("#personal_box_open").append(text);

        }

        function traningAppend(){
            constvar++;
           var text = `<div class="box mt-3" id="pro_${constvar}">
                                            <span onclick="deletePro(${constvar})">X</span>
                                            <div class="form-group">
                                                <label for="">Abschluss</label>
                                                <input type="text" class="diploma">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Bildungseinrichtung</label>
                                                <input type="text" class="educational_institution">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Startdatum</label>
                                                <input type="date" class="a_start_date">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Datum des Abschlusses</label>
                                                <input type="date" class="date_of_completion">
                                            </div>

                                        </div>`;


                    $("#trainig_append").append(text);
        }

        function proCapability(){
            constvar++;
           var text = ` <div class="form-group" id="pro_${constvar}">
            <span onclick="deletePro(${constvar})">X</span>
                                                <label for="" style="font-family:auto">Fähigkeit</label>
                                              <input type="text" class="Capability">
                                          </div>`;


                                          $("#expertise_append").append(text);
        }

        function voluntryfun(){
            constvar++;
           var text = ` <div class="form-group" id="pro_${constvar}">
            <span onclick="deletePro(${constvar})"> X </span>
                                              <label for="" style="font-family:auto;">Tätigkeit</label>
                                              <input type="text" class="task">
                                          </div>`;


                                          $("#voluntry_append").append(text);
        }

        function placefun(){
            constvar++;
           var text = `<div class="box mt-3" id="pro_${constvar}">
                                            <span onclick="deletePro(${constvar})">X</span>
                                            <div class="form-group">
                                                <label for="">Ort</label>
                                                <input type="text" class="location">
                                            </div>
                                            <div class="form-group">
                                              <label for="">Datum</label>
                                              <input type="date" class="o_date">
                                          </div>

                                        </div>`;


                                        $("#place_append").append(text);
        }


        function languageAppend(){
            constvar++;
           var text = `<div class="box mt-3" id="pro_${constvar}">
                                            <span onclick="deletePro(${constvar})">X</span>
                                            <div class="form-group">
                                                <label for="">Sprachen</label>
                                                <input type="text" class="language">
                                            </div>
                                            <div class="form-group">
                                              <label for="">Level</label>
                                              <input type="text" class="level">
                                            </div>
                                        </div>`;


                                        $("#language_append").append(text);
        }

        function deletePro(id){
            document.getElementById('pro_'+id).remove();
        }

        function writeCv(){
            // alert($('#first_name').val());
            let emptyFirst = '';
            let emptySecond = '';
            let emptyThird = '';
            let emptyFour = '';
            let emptyFive = '';
            let emptySix = '';
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let address = $('#address').val();
            let postal_code = $('#postal_code').val();
            let birth_date = changeDateFormat($('#birth_date').val());
            let city_date =$('#city_date').val();


            let phone = $('#phone').val();
            let email_address = $('#email_address').val();

            if(first_name != '' || last_name != '' || address != '' || postal_code != '' || birth_date != '' || phone != '' || email_address != '' || city_date != ''){
                emptyFirst = `<h2><span>${first_name}</span> <span>${last_name}</span></h2>
                        <div class="personal_info_box">
                            <div class="row">
                                <div class="col-md-5 mt-2">
                                    <div class="box">
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 72 90">
                                                <path id="Path_301" data-name="Path 301" d="M50,95C68,77,86,60.882,86,41a36,36,0,0,0-72,0C14,60.882,32,77,50,95Zm0-64A10,10,0,1,1,40,41,10,10,0,0,1,50,31Z" transform="translate(-14 -5)" fill="#fff"/>
                                              </svg>
                                        </div>
                                        <div class="content">
                                            <span>${address}</span>
                                            <span>${postal_code}  ${city_date}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-2">
                                    <div class="box">
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 5.822 5.822">
                                                <g id="Group_66" data-name="Group 66" transform="translate(-0.264 -290.914)">
                                                  <path id="Path_302" data-name="Path 302" d="M1.059.264a.8.8,0,0,0-.8.795V5.292a.8.8,0,0,0,.8.795H5.291a.8.8,0,0,0,.795-.795V1.059A.8.8,0,0,0,5.291.264Zm0,.529H5.291a.26.26,0,0,1,.266.266v.264H.793V1.059A.261.261,0,0,1,1.059.793ZM.793,1.852H5.557v3.44a.26.26,0,0,1-.266.266H1.059a.261.261,0,0,1-.266-.266Zm1.853.529a.265.265,0,1,0,.265.265A.265.265,0,0,0,2.646,2.381Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,2.381Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,4.762,2.381ZM1.587,3.44a.265.265,0,1,0,.265.265A.265.265,0,0,0,1.587,3.44Zm1.058,0A.265.265,0,1,0,2.91,3.7.265.265,0,0,0,2.646,3.44Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,3.44Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,4.762,3.44ZM1.587,4.5a.265.265,0,1,0,.265.265A.265.265,0,0,0,1.587,4.5Zm1.058,0a.265.265,0,1,0,.265.265A.265.265,0,0,0,2.646,4.5ZM3.7,4.5a.265.265,0,1,0,.265.265A.265.265,0,0,0,3.7,4.5Z" transform="translate(0 290.65)" fill="#fff" fill-rule="evenodd"/>
                                                </g>
                                              </svg>

                                        </div>
                                        <div class="content">
                                            <span>${birth_date}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-3">
                                    <div class="box">
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 92.636 92.638">
                                                <path id="Path_303" data-name="Path 303" d="M94,77.1l-.743,8.063a14.757,14.757,0,0,1-6.2,10.731,14.942,14.942,0,0,1-8.558,2.707,15.207,15.207,0,0,1-3.745-.477A101.491,101.491,0,0,1,1.877,25.269a14.915,14.915,0,0,1,2.23-12.3,14.756,14.756,0,0,1,10.722-6.2l8.082-.753a9.434,9.434,0,0,1,10.112,7.548,68.02,68.02,0,0,0,3.926,12.752A9.461,9.461,0,0,1,32.86,38.259L27.79,41.07A83.343,83.343,0,0,0,58.945,72.225l2.811-5.07a9.447,9.447,0,0,1,11.951-4.088,69,69,0,0,0,12.751,3.926A9.427,9.427,0,0,1,94,77.1Z" transform="translate(-1.401 -5.967)" fill="#fff"/>
                                              </svg>
                                        </div>
                                        <div class="content">
                                            <span>${phone}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-3">
                                    <div class="box">
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 81.84 54.6">
                                                <g id="_1" data-name="1" transform="translate(-7.08 -20.7)">
                                                  <path id="Path_304" data-name="Path 304" d="M88.92,67.3a8,8,0,0,1-1.4,4.519L60.12,48l27.4-23.82a8,8,0,0,1,1.4,4.52ZM48,53.24l36.46-31.7a8,8,0,0,0-3.54-.84H15.08a8,8,0,0,0-3.54.84ZM8.48,24.18a8,8,0,0,0-1.4,4.52V67.3a8,8,0,0,0,1.4,4.519L35.88,48Zm48.6,26.47L49.31,57.4a2,2,0,0,1-2.62,0l-7.77-6.75L11.54,74.46a8,8,0,0,0,3.54.84H80.92a8,8,0,0,0,3.54-.84Z" fill="#fff"/>
                                                </g>
                                              </svg>

                                        </div>
                                        <div class="content">
                                            <span>${email_address}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }

            let location = $('#location').val();
            let o_date = changeDateFormat($('#o_date').val());
            let position = document.getElementsByClassName('position');
            let diploma = document.getElementsByClassName('diploma');
            let capability = document.getElementsByClassName('Capability');
            let language = document.getElementsByClassName('language');
            let task = document.getElementsByClassName('task');
            let expenses = [];

            let profisianal= '';
            let traning= '';
            let expertise= '';
            let languagesbox= '';
            let Other_activities= '';


            for (var i = 0; i < position.length; i++) {
                        var pos = position[i].value;
                         var employer = document.getElementsByClassName('employer')[i].value;
                         var start_date = changeDateFormat(document.getElementsByClassName('start_date')[i].value);
                         var end_date = changeDateFormat(document.getElementsByClassName('end_date')[i].value);


               if(pos != '' || employer != '' || start_date != '' || end_date != '' ){

                            profisianal += ` <div class="col-md-3 mt-2">
                                            <span class="left_date">
                                                ${start_date} - ${end_date}
                                            </span>
                                            </div>
                                            <div class="col-md-8 mt-2">
                                                <span class="edu_1">
                                                ${pos}
                                                </span>
                                                <span class="location_edu">
                                                    ${employer}
                                                </span>
                                            </div>`;

                }else {
                emptySecond = '';

                }

            }

            if(emptySecond == '' && profisianal != ''){
                emptySecond = `<div class="professional_background_box mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 28 26">
                                                <g id="Layer_2" data-name="Layer 2" transform="translate(-2 -3)">
                                                  <path id="Path_305" data-name="Path 305" d="M28,7H22V6a3,3,0,0,0-3-3H13a3,3,0,0,0-3,3V7H4A2,2,0,0,0,2,9v5a3,3,0,0,0,2,2.816V26a3,3,0,0,0,3,3H25a3,3,0,0,0,3-3V16.816A3,3,0,0,0,30,14V9A2,2,0,0,0,28,7ZM12,6a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1V7H12ZM26,26a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V17H8v1a1,1,0,0,0,2,0V17H22v1a1,1,0,0,0,2,0V17h2Zm2-12a1,1,0,0,1-1,1H24V14a1,1,0,0,0-2,0v1H10V14a1,1,0,0,0-2,0v1H5a1,1,0,0,1-1-1V9H28Z" fill="#fff"/>
                                                </g>
                                              </svg>
                                        </span>
                                         Beruflicher Werdegang</h3>
                                </div>
                                ${profisianal}
                            </div>
                        </div>`;
            }




            for (var i = 0; i < diploma.length; i++) {
                        var dop = diploma[i].value;
                         var educational_institution = document.getElementsByClassName('educational_institution')[i].value;
                         var start_date = changeDateFormat(document.getElementsByClassName('a_start_date')[i].value);
                         var end_date = changeDateFormat(document.getElementsByClassName('date_of_completion')[i].value);
                    if(dop != '' || educational_institution != '' || start_date != '' || end_date != '' ){
                         traning += ` <div class="col-md-3 mt-2">
                                   <span class="left_date">
                                    ${start_date} - ${end_date}
                                   </span>
                                </div>
                                <div class="col-md-8 mt-2">
                                    <span class="edu_1">
                                     ${dop}
                                    </span>
                                    <span class="location_edu">
                                        ${educational_institution}
                                       </span>
                                </div>`;
                    }else {
                        emptyThird = '';

                    }

            }

            if(emptyThird == '' && traning != ''){
                emptyThird = ` <div class="training_sec_box mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 120 94.2">
                                                <g id="Group_66" data-name="Group 66" transform="translate(-15 -27.9)">
                                                  <path id="Path_306" data-name="Path 306" d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z" fill="#fff"/>
                                                  <path id="Path_307" data-name="Path 307" d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z" fill="#fff"/>
                                                  <path id="Path_308" data-name="Path 308" d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z" fill="#fff"/>
                                                  <path id="Path_309" data-name="Path 309" d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z" fill="#fff"/>
                                                  <path id="Path_310" data-name="Path 310" d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff"/>
                                                  <path id="Path_311" data-name="Path 311" d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z" fill="#fff"/>
                                                </g>
                                              </svg>
                                        </span>
                                        Ausbildung</h3>
                                </div>
                                ${traning}
                            </div>
                        </div>`;
            }

            for (var i = 0; i < task.length; i++) {
                        var cap = task[i].value;
                    if(cap != ''){

                        Other_activities += `<div class="col-md-3 mt-2"></div>
                                <div class="col-md-9 mt-2">
                                    <span class="left_date">
                                     ${cap}
                                    </span>
                                </div>`;

                    }else {
                        emptyFour = '';

                    }

            }

            if(emptyFour == '' && Other_activities != ''){
                emptyFour = `  <div class="Other_activities_sec_box mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 120 94.2">
                                                <g id="Group_66" data-name="Group 66" transform="translate(-15 -27.9)">
                                                  <path id="Path_306" data-name="Path 306" d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z" fill="#fff"/>
                                                  <path id="Path_307" data-name="Path 307" d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z" fill="#fff"/>
                                                  <path id="Path_308" data-name="Path 308" d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z" fill="#fff"/>
                                                  <path id="Path_309" data-name="Path 309" d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z" fill="#fff"/>
                                                  <path id="Path_310" data-name="Path 310" d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff"/>
                                                  <path id="Path_311" data-name="Path 311" d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z" fill="#fff"/>
                                                </g>
                                              </svg>
                                        </span>
                                        Weitere Tätigkeiten</h3>
                                </div>
                               ${Other_activities}


                            </div>
                        </div>`;
            }

            for (var i = 0; i < capability.length; i++) {
                        var cap = capability[i].value;
                        if(cap != ''){
                        expertise += `<div class="col-md-3 mt-2"></div>
                                <div class="col-md-9 mt-2">
                                    <span class="left_date">
                                     ${cap}
                                    </span>
                                </div>`;

                            }else {
                        emptyFive = '';

                    }

            }

            if(emptyFive == '' && expertise != ''){
                emptyFive = `  <div class="expertise_sec_box mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 120 94.2">
                                                <g id="Group_66" data-name="Group 66" transform="translate(-15 -27.9)">
                                                  <path id="Path_306" data-name="Path 306" d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z" fill="#fff"/>
                                                  <path id="Path_307" data-name="Path 307" d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z" fill="#fff"/>
                                                  <path id="Path_308" data-name="Path 308" d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z" fill="#fff"/>
                                                  <path id="Path_309" data-name="Path 309" d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z" fill="#fff"/>
                                                  <path id="Path_310" data-name="Path 310" d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff"/>
                                                  <path id="Path_311" data-name="Path 311" d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z" fill="#fff"/>
                                                </g>
                                              </svg>
                                        </span>
                                        Kenntnisse</h3>
                                </div>
                                ${expertise}


                            </div>
                        </div>`;
            }

            for (var i = 0; i < language.length; i++) {
                        var lang = language[i].value;
                         var level = document.getElementsByClassName('level')[i].value;
                        if(lang != '' || level != ''){
                         languagesbox += `<div class="col-md-3 mt-2"></div>
                                <div class="col-md-9 mt-2">
                                    <span class="left_date">
                                        ${lang} - ${level}
                                    </span>
                                </div>`;

                            }else {
                        emptySix = '';

                    }



            }


            if(emptySix == '' && languagesbox != ''){
                emptySix = `   <div class="sprachen_sec_box mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 120 94.2">
                                                <g id="Group_66" data-name="Group 66" transform="translate(-15 -27.9)">
                                                  <path id="Path_306" data-name="Path 306" d="M127.8,75.8l-1.4,3.7-21.6-8.3a4.9,4.9,0,0,1-3.7,1.6,5.061,5.061,0,0,1-3.7-1.6L80.1,77.8a5.1,5.1,0,0,1-10.2-.2,5.019,5.019,0,0,1,.2-1.2L51.5,62.3A5.528,5.528,0,0,1,49,63a5.2,5.2,0,0,1-2.5-.7l-22.3,17-2.4-3.2,22.3-17a5.019,5.019,0,0,1-.2-1.2,5.1,5.1,0,0,1,10.2,0,5.019,5.019,0,0,1-.2,1.2L72.5,73.3a4.975,4.975,0,0,1,6.2.9L96,67.5a5.1,5.1,0,0,1,10.2,0Z" fill="#fff"/>
                                                  <path id="Path_307" data-name="Path 307" d="M97.4,94.3A8.2,8.2,0,1,1,89.2,86,8.324,8.324,0,0,1,97.4,94.3Z" fill="#fff"/>
                                                  <path id="Path_308" data-name="Path 308" d="M106.5,122.1H82.1A21.4,21.4,0,0,0,77.7,111a17.352,17.352,0,0,1,28.8,11.1Z" fill="#fff"/>
                                                  <path id="Path_309" data-name="Path 309" d="M69,94.3A8.2,8.2,0,1,1,60.8,86,8.324,8.324,0,0,1,69,94.3Z" fill="#fff"/>
                                                  <path id="Path_310" data-name="Path 310" d="M78.1,122.1H43.5a17.4,17.4,0,0,1,34.6,0Z" fill="#fff"/>
                                                  <path id="Path_311" data-name="Path 311" d="M129,27.9H21a6.018,6.018,0,0,0-6,6v71.6a6.018,6.018,0,0,0,6,6H38.9v-4H21a2.006,2.006,0,0,1-2-2V46H131v59.6a2.006,2.006,0,0,1-2,2H111.1v4H129a6.018,6.018,0,0,0,6-6V33.9A6.018,6.018,0,0,0,129,27.9Zm-9.7,7H126v4h-6.7Z" fill="#fff"/>
                                                </g>
                                              </svg>
                                        </span>
                                        Sprachen</h3>
                                </div>
                               ${languagesbox}


                            </div>
                        </div>`;
            }


            var text = `  <div class="cv_box">
                        ${emptyFirst}

                        ${emptySecond}

                        ${emptyThird}

                        ${emptyFive}

                        ${emptySix}

                        ${emptyFour}

                        <h4 class="mt-4">${location} ${o_date}</h4>
                    </div>`;
                    $("#save_folder").css('display','block');

                                    document.getElementById('cv_appnd').innerHTML = text;


        }

        function generatePDF(){
            const element = document.getElementById('cv_appnd');

            // Use html2canvas to capture the content as an image
                    html2canvas(element,{quality: 4,scale:5}).then(canvas => {
                        // Convert the canvas to a data URL
                        const dataURL = canvas.toDataURL();

                        // Create a new jsPDF instance
                        const pdf = new jsPDF('p', 'px', 'a4', 'false', 'false');

                        // Add the image to the PDF
                        pdf.addImage(dataURL, 'PNG', 0, 0, pdf.internal.pageSize.width, pdf.internal.pageSize.height,'','FAST');
                        pdf.save('Lebenslauf.pdf');
                    });
        }



        function changeDateFormat(inputDate) {

            if(inputDate == ''){
                return '';
            }
            // Get the input date value

            // Create a Date object from the input date
            var parts = inputDate.split('-');
            var year = parts[0];
            var month = parts[1];
            var day = parts[2];

            // Create the new format: dd.mm.yyyy
            var newFormatDate = day + '-' + month + '-' + year;


            // Display the formatted date
            return newFormatDate
            // document.getElementById('output').textContent = 'Formatted Date: ' + formattedDate;
        }

      </script>

</body>
</html>
