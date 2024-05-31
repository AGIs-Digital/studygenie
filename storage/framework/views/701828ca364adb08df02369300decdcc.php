<!DOCTYPE html>
<html lang="de">
<head>
<?php $__env->startSection('title', Auth::check() ? auth()->user()->name . 's - Archiv' : 'Archiv'); ?>
<?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/profile.css')); ?>">
<!-- MathJax Konfiguration -->
<script>
    window.MathJax = {
        tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']]
        },
        svg: {
            fontCache: 'global'
        }
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<style>
    .delete-archive {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .delete-archive:hover {
        background-color: #ff1a1a;
        transform: scale(1.1);
    }

    .toast {
        opacity: 0.9;
    }
</style>
</head>

<body class="MainContainer">
	<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<section class="archive_sec">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2	style="color: #E09E50; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">Bildung</h2>
					<div class="accordion" id="accordionBildung">
						<div class="accordion-item">
							<h2 class="accordion-header" id="Bildungcheck">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool2"
									aria-expanded="false" aria-controls="BildungCollpasetool2">
									GenieCheck</button>
							</h2>
							<div id="BildungCollpasetool2" class="accordion-collapse collapse"
								aria-labelledby="Bildungcheck" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushGenieCheck">
										 <?php createAccordion($Bildung, 'genie_check'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="TextInspiration">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool1"
									aria-expanded="false" aria-controls="BildungCollpasetool1">
									TextInspiration</button>
							</h2>
							<div id="BildungCollpasetool1" class="accordion-collapse collapse"
								aria-labelledby="TextInspiration" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushTextInspiration">
										 <?php createAccordion($Bildung, 'text_inspiration'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="BildungOne">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool3"
									aria-expanded="false" aria-controls="BildungCollpasetool3">
									TextAnalyse</button>
							</h2>
							<div id="BildungCollpasetool3" class="accordion-collapse collapse"
								aria-labelledby="BildungOne" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushTextAnalyse">
										 <?php createAccordion($Bildung, 'text_analysis'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="BildungMentor">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool4"
									aria-expanded="false" aria-controls="BildungCollpasetool4">
									genieTutor</button>
							</h2>
							<div id="BildungCollpasetool4" class="accordion-collapse collapse"
								aria-labelledby="BildungMentor" data-bs-parent="#accordionBildung">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushgenieTutor">
										 <?php createAccordion($Bildung, 'genieTutor'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h2 style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">Karriere</h2>
					<div class="accordion" id="accordionKarriere">
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingJobMatch">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseJobMatch"
									aria-expanded="false" aria-controls="collapseJobMatch">JobMatch</button>
							</h2>
							<div id="collapseJobMatch" class="accordion-collapse collapse"
								aria-labelledby="headingJobMatch" data-bs-parent="#accordionKarriere">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushJobMatch">
										 <?php createAccordion($Karriere, 'job_match'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="headingJobInsider">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseJobInsider"
									aria-expanded="false" aria-controls="collapseJobInsider">JobInsider</button>
							</h2>
							<div id="collapseJobInsider" class="accordion-collapse collapse"
								aria-labelledby="headingJobInsider" data-bs-parent="#accordionKarriere">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushJobInsider">
										 <?php createAccordion($Karriere, 'job_insider'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<h2 class="accordion-header" id="headingKarriereMentor">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseKarriereMentor"
									aria-expanded="false" aria-controls="collapseKarriereMentor">
									KarriereMentor</button>
							</h2>
							<div id="collapseKarriereMentor" class="accordion-collapse collapse"
								aria-labelledby="headingKarriereMentor" data-bs-parent="#accordionKarriere">
								<div class="accordion-body">
									<div class="accordion accordion-flush"
										id="accordionFlushKarriereMentor">
										 <?php createAccordion($Karriere, 'karriere_mentor'); ?>
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
            <img id="footerLogo" src="<?php echo e(asset('asset/images/Logo (2).png')); ?>"
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
                        src="<?php echo e(asset('asset/images/instagram.svg')); ?>" alt="Instagram" loading="lazy"></a>
                    <a href=""><img id="tiktok"
                        src="<?php echo e(asset('asset/images/tiktok.svg')); ?>" alt="TikTok" loading="lazy"></a> <a
                        href=""><img id="linkedin"
                        src="<?php echo e(asset('asset/images/linkedin.svg')); ?>" alt="LinkedIn" loading="lazy"></a>
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
			var deleteId;

			$('.delete-archive').click(function() {
				deleteId = $(this).data('id');
				$('#deleteConfirmationModal').modal('show');
			});

			$('#confirmDelete').click(function() {
				$('#deleteConfirmationModal').modal('hide');
				$.ajax({
					url: route('archive.destroy', deleteId),
					type: 'DELETE',
					data: {
						_token: '<?php echo e(csrf_token()); ?>'
					},
					success: function(response) {
						if (response.status === 'success') {
							$('#archive-item-' + deleteId).fadeOut('slow', function() {
								$(this).remove();
							});
							var deleteToast = new bootstrap.Toast(document.getElementById('deleteToast'), {
								delay: 2500
							});
							deleteToast.show();
						} else {
							alert('Fehler: ' + response.message);
						}
					},
					error: function(xhr) {
						alert('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
					}
				});
			});

			// MathJax-Formatierung auf alle Nachrichten anwenden
			MathJax.typeset();
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

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Bestätigung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sind Sie sicher, dass Sie diese Antwort löschen möchten?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Löschen</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 11">
    <div id="deleteToast" class="toast align-items-center text-white bg-success bg-opacity-75 border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Der Eintrag wurde erfolgreich gelöscht.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\resources\views/archive.blade.php ENDPATH**/ ?>