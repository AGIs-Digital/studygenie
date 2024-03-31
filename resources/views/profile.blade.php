<!DOCTYPE html>
<html lang="en">

<head>
@include('includes.head')
@section('title', Auth::check() ? Auth::user()->name . ' - Profil' : 'Profil')
<link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">

</head>

<body class="MainContainer">
	@include('includes.header')
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<h1>
					Account Einstellungen<img
						src="{{ asset('asset/images/profile.svg') }}">
				</h1>
			</div>

		</div>
		@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
		@endforeach @if(Session::has('success'))
		<div class="alert alert-success mt-4">
			<strong>{{Session::get('success')}}</strong>
		</div>
		@endif @if(Session::has('error'))
		<div class="alert alert-danger mt-4">
			<strong>{{Session::get('error')}}</strong>
		</div>
		@endif
		<form method="POST" action="{{ route('change.password') }}">
			@csrf
			<div class="content">
				<div class="col-md-12">
					<div class="sup_plan">
						<img src="{{ asset('asset/images/p1.svg') }}" class="p1" alt=""> <img
							src="{{ asset('asset/images/p2.svg') }}" class="p2" alt=""> {{--
						<img src="{{ asset('asset/images/psvg.svg') }}" class="geni_image"
							alt=""> --}} <span class="head">{{
							ucfirst(auth()->user()->subscription_name) }} Status</span>
						<div class="dayleft">
							<img src="{{ asset('asset/images/dayleft.svg') }}" alt="">
							<div class="con">
								@if(auth()->user()->subscription_name == 'silber') <span
									class="last">Unbegrenzt</span> @else <span class="first">{{
									\Carbon\Carbon::parse(auth()->user()->expire_date)->diffInDays(\Carbon\Carbon::now());
									}}</span> <span class="last">Tage übrig</span> @endif

							</div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<h2>{{ auth()->user()->name }}</h2>
					</div>
					<div class="col-md-4">
						<div class="planCard">

							<div class="headerPlanCard">
								<img class="crownImg"
									src="{{ asset('asset/images/illustrations/silber2.png') }}"
									alt="Crown Image">

								<h6 class="secondary-Heading">Silber</h6>

							</div>
							<div class="contentPlanCard contentPlanCard3">

								<span class="highWeightSpan">0 €<span class="lowWeightSpan">
										mtl.</span></span>
								<p class="planCardParagraph">
									✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✘ Inspirationen<br />
									✘ Bewerbungen<br /> ✘ Lernen<br /> ✘ Bewerbungstrainer
								</p>

								@guest
								<button data-bs-toggle="modal" data-bs-target="#loginModal"
									class="plancardButton">Kostenlos ausprobieren</button>
								@else @if(auth()->user()->subscription_name == 'silber')
								<button class="plancardButton" disabled>Aktueller Status</button>
								@else
								<!-- Button für den Wechsel zu Silber mit Bestätigungsabfrage -->
								<a href="javascript:void(0)"
									onclick="confirmSilberStatus('{{ route('paypal.payment', 'silber') }}')"
									class="plancardButton"> Kostenlos </a> @endif @endguest

							</div>
							<br />
						</div>
					</div>

					<div class="col-md-4">
						<div class="planCard">
							<div class="headerPlanCard">
								<img class="crownImg"
									src="{{ asset('asset/images/illustrations/gold.png') }}"
									alt="Crown Image">

								<h6 class="secondary-Heading">Gold</h6>

							</div>

							<div class="contentPlanCard contentPlanCard2">
								<span class="highWeightSpan">10 €<span class="lowWeightSpan">
										mtl.</span></span>
								<p class="planCardParagraph">
									✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✓ Inspirationen<br />
									✓ Bewerbungen<br /> ✘ Lernen<br /> ✘ Bewerbungstrainer
								</p>

								@guest
								<button data-bs-toggle="modal" data-bs-target="#signupModal"
									class="plancardButton">Hol dir Gold</button>
								@else @php $check = false; $date = auth()->user()->expire_date;
								if($date != null &&
								\Carbon\Carbon::parse($date)->gt(\Carbon\Carbon::now())){ $check
								= true; } @endphp @if(auth()->user()->subscription_name ==
								'gold' && $check)

								<button class="plancardButton" disabled>Aktueller Status</button>

								@else
								<button class="plancardButton"
									data-paypal-route="{{ route('paypal.payment', 'gold') }}"
									data-stripe-route="{{ route('stripe.payment', 'gold') }}"
									onclick="setModel(this)">Hol dir Gold</button>
								@endif @endguest
							</div>
							<br />
						</div>
					</div>
					<div class="col-md-4">
						<div class="planCard ">
							<div class="headerPlanCard">
								<img class="crownImg"
									src="{{ asset('asset/images/illustrations/diamant.png') }}"
									alt="Crown Image">

								<h6 class="secondary-Heading">Diamant</h6>

							</div>


							<div class="contentPlanCard contentPlanCard3">

								<span class="highWeightSpan">20 €<span class="lowWeightSpan">
										mtl.</span></span>

								<p class="planCardParagraph">
									✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✓ Inspirationen<br />
									✓ Bewerbungen<br /> ✓ Lernen<br /> ✓ Bewerbungstrainer
								</p>

								@guest
								<button data-bs-toggle="modal" data-bs-target="#loginModal"
									class="plancardButton">Hol dir Diamant</button>
								@else @if(auth()->user()->subscription_name == 'diamant' &&
								$check)

								<button class="plancardButton" disabled>Aktueller Status</button>

								@else
								<button class="plancardButton"
									data-paypal-route="{{ route('paypal.payment', 'diamant') }}"
									data-stripe-route="{{ route('stripe.payment', 'diamant') }}"
									onclick="setModel(this)">Hol dir Diamant</button>
								@endif @endguest
							</div>
							<br />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-between">
						<button id="changePasswordButton" type="button" class="btn btn-primary">Account Einstellungen</button>
						<form method="POST" action="{{ route('user.delete') }}" onsubmit="return confirmDeletion();">
							@csrf
							@method('DELETE')
							
						</form>
					</div>
				</div>
				<div id="passwordChangeForm" class="hidden">
					<div class="row">
						<div class="col-md-4">
							<div class="input_group">
								<label for="old_password">Altes Passwort</label>
								<input type="password" name="old_password" class="form-control form-control-sm">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_group">
								<label for="new_password">Neues Passwort</label>
								<input type="password" name="new_password" class="form-control form-control-sm">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_group">
								<label for="new_confirm_password">Wiederhole Neues Passwort</label>
								<input type="password" name="new_confirm_password" class="form-control form-control-sm">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-2 text-end">
							<form method="POST" action="{{ route('user.delete') }}" onsubmit="return confirmDeletion();">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Account löschen</button>
							</form>
						</div>
					</div>
					<div id="passwordChangeForm" class="hidden">
						<div class="row">
							<div class="col-md-4">
								<div class="input_group">
									<label for="old_password">Altes Passwort</label>
									<input type="password" name="old_password" class="form-control form-control-sm">
								</div>
							</div>
							<div class="col-md-4">
								<div class="input_group">
									<label for="new_password">Neues Passwort</label>
									<input type="password" name="new_password" class="form-control form-control-sm">
								</div>
							</div>
							<div class="col-md-4">
								<div class="input_group">
									<label for="new_confirm_password">Wiederhole Neues Passwort</label>
									<input type="password" name="new_confirm_password" class="form-control form-control-sm">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary mt-2">Änderung speichern</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</form>

	</div> <!-- Ende des Hauptinhalts-Containers -->

	<footer class="mainFooterContainer">
		<div class="container-fluid px-0"> <!-- Verwendung von container-fluid für volle Breite -->
			<div class="footerContainer">
				<img id="footerLogo" src="{{ asset('asset/images/Logo (2).png') }}" width="133" height="77" alt="Logo " loading="lazy">
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
						<a href=""><img id="instagram" src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
						<a href=""><img id="tiktok" src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a> <a
							href=""><img id="linkedin" src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="modal fade" id="payment_modal" tabindex="-1"
		aria-labelledby="payment_modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-body p-0">
					<div class="button_payment_box">
						<a href="#" id="paypal_btn">Bezahlung über<span>Pay</span><span>pal</span></a>
						<a href="#" id="stripe_btn">Bezahlung über Stripe</a>

					</div>
				</div>

			</div>
		</div>
	</div>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
        function setModel(element){
    event.preventDefault();
    var paypal = element.getAttribute('data-paypal-route');
    var stripe = element.getAttribute('data-stripe-route');
    document.getElementById('paypal_btn').href = paypal;
    document.getElementById('stripe_btn').href = stripe;
    $("#payment_modal").modal('show');
}
        
        function confirmSilberStatus(url) {
        if (confirm("Möchten Sie wirklich zu Silber wechseln?")) {
            window.location.href = url;
        }
    }
    
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('changePasswordButton').addEventListener('click', function () {
            var form = document.getElementById('passwordChangeForm');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        });
    });

    function confirmDeletion() {
        return confirm('ACHTUNG: Diese Aktion wird Ihren Account und alle damit verbundenen Daten dauerhaft löschen. Diese Aktion kann nicht rückgängig gemacht werden. Sind Sie sicher, dass Sie fortfahren möchten?');
    }
</script>

</body>

</html>
