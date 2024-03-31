<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PayPal</title>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
	rel="stylesheet">
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
<body>
	<div class="container">
		<div class="row mt-5 mb-5">
			<div class="col-10 offset-1 mt-5">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="text-white">PayPal</h3>
					</div>
					<div class="card-body">

						@if ($message = Session::get('success'))
						<div class="alert alert-success alert-dismissible fade show"
							role="alert">
							<strong>{{ $message }}</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
						@endif @if ($message = Session::get('error'))
						<div class="alert alert-danger alert-dismissible fade show"
							role="alert">
							<strong>{{ $message }}</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
						@endif

						<center>
							<a href="{{ route('paypal.payment','silber') }}"
								class="btn btn-success">Pay with PayPal </a>
						</center>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
