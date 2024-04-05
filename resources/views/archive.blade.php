<!DOCTYPE html>
<html lang="en">

<head>
@include('includes.head')
@section('title', Auth::check() ? Auth::user()->name . ' - Archiv' : 'Archiv')
<link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
</head>

<body class="MainContainer">
	@include('includes.header')
	<section class="archive_sec">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2
						style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">Bildung</h2>
					<div class="accordion" id="accordionBildung">
						<div class="accordion-item">
							<h2 class="accordion-header" id="BildungOne">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool1"
									aria-expanded="true" aria-controls="BildungCollpasetool1">
									TextInspiration</button>
							</h2>
							<div id="BildungCollpasetool1" class="accordion-collapse collapse"
								aria-labelledby="BildungOne" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushExample2">
										 <?php createAccordion($Bildung, 'TextInspiration'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="Bildungcheck">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool2"
									aria-expanded="true" aria-controls="BildungCollpasetool2">
									GenieCheck</button>
							</h2>
							<div id="BildungCollpasetool2" class="accordion-collapse collapse"
								aria-labelledby="Bildungcheck" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushTextInspiration">
										 <?php createAccordion($Bildung, 'GenieCheck'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="BildungMentor">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool3"
									aria-expanded="true" aria-controls="BildungCollpasetool3">
									GenieTutor</button>
							</h2>
							<div id="BildungCollpasetool3" class="accordion-collapse collapse"
								aria-labelledby="BildungMentor" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushTextInspiration">
										 <?php createAccordion($Bildung, 'GenieTutor'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h2
						style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">Karriere</h2>
					<div class="accordion" id="accordionKarriere">
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingOne">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseOne"
									aria-expanded="true" aria-controls="collapseOne">JobInsider</button>
							</h2>
							<div id="collapseOne" class="accordion-collapse collapse"
								aria-labelledby="headingOne" data-bs-parent="#accordionKarriere">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionJobInsider">
										 <?php createAccordion($Karriere, 'JobInsider'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingTwo">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseTwo"
									aria-expanded="false" aria-controls="collapseTwo">
									GeniusInterview</button>
							</h2>
							<div id="collapseTwo" class="accordion-collapse collapse"
								aria-labelledby="headingTwo" data-bs-parent="#accordionKarriere">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionGeniusInterview">
										 <?php createAccordion($Karriere, 'GeniusInterview'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo (2).png') }}"
                width="133" height="77" alt="Logo " loading="lazy">
            <div class="CenterContainer">
                <div class="anchorTagsFooterContainer">
                    <a href="/impressum" class="footerHeading"> Impressum </a>
                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="/agb" class="footerHeading"> AGBs </a>

                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="/datenschutz" class="footerHeading"> Datenschutz </a>
                </div>

            </div>

            <div class="rightContainer" style="gap: 0rem;">
                <div class="socialAnchorTags">
                    <a href=""><img id="instagram"
                        src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
                    <a href=""><img id="tiktok"
                        src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a> <a
                        href=""><img id="linkedin"
                        src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
                </div>
            </div>
        </div>
    </footer>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.delete-archive').click(function() {
				var id = $(this).data('id');
				if (confirm('Sind Sie sicher, dass Sie diese Antwort löschen möchten?')) {
					$.ajax({
						url: '{{ route('archive.delete', '') }}/' + id,
						type: 'POST',
						data: {
							_method: 'DELETE',
							_token: '{{ csrf_token() }}'
						},
						success: function(response) {
							if (response.status === 'success') {
								$('#archive-item-' + id).fadeOut('slow', function() {
									$(this).remove();
								});
								alert(response.message);
							} else {
								alert('Fehler: ' + response.message);
							}
						},
						error: function(xhr) {
							alert('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
						}
					});
				}
			});
		});
	</script>
</body>
</html>
<?php
function createAccordion($data, $toolType) {
    foreach ($data as $row) {
        if ($row->tooltype == $toolType) {
            echo '<div class="accordion-item" id="archive-item-' . $row->id . '">';
            echo '<h2 class="accordion-header d-flex justify-content-between align-items-center" id="flush-headingOne' . $row->id . '">';
            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne' . $row->id . '" aria-expanded="false" aria-controls="flush-collapseOne' . $row->id . '">' . $row->question . '</button>';
            echo '<button class="btn delete-archive" data-id="' . $row->id . '">X</button>';
            echo '</h2>';
            echo '<div id="flush-collapseOne' . $row->id . '" class="accordion-collapse collapse" aria-labelledby="flush-headingOne' . $row->id . '" data-bs-parent="#accordionFlushExample2">';
            echo '<div class="accordion-body">' . $row->answer . '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}
?>
