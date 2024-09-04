@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="reset-card">
				<div class="card-header reset-card-header">{{ __('Passwort zurücksetzen') }}</div>

				<div class="card-body reset-card-body">
					<form method="POST" action="{{ route('password.update') }}">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail-Adresse') }}</label>

							<div class="col-md-6">
								<input id="email" type="email"
									class="form-control @error('email') is-invalid @enderror"
									name="email" value="{{ $email ?? old('email') }}" required
									autocomplete="email" autofocus> @error('email') <span
									class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
								</span> @enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Passwort') }}</label>

							<div class="col-md-6">
								<div class="password-field">
									<input id="password" type="password"
										class="form-control @error('password') is-invalid @enderror"
										name="password" required autocomplete="new-password">
									<span class="toggle-password" onclick="togglePasswordVisibility()">
										<img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
									</span>
								</div>
								@error('password') <span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span> @enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password-confirm"
								class="col-md-4 col-form-label text-md-right">{{ __('Passwort bestätigen') }}</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password"
									class="form-control" name="password_confirmation" required
									autocomplete="new-password">
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">{{ __('Passwort zurücksetzen') }}</button>
							</div>
						</div>
					</form>

					<div id="passwordCriteria" class="criteria-container mt-2">
						<div class="criteria-row">
							<p id="lengthCriteria" class="text-danger"><span class="checkmark">✘</span> 8 Zeichen</p>
							<p id="uppercaseCriteria" class="text-danger"><span class="checkmark">✘</span> Großbuchstabe</p>
						</div>
						<div class="criteria-row">
							<p id="numberCriteria" class="text-danger"><span class="checkmark">✘</span> Zahl</p>
							<p id="specialCharCriteria" class="text-danger"><span class="checkmark">✘</span> Sonderzeichen</p>
						</div>
					</div>

					<script>
						function updateCriteria() {
							const criteria = [
								{ id: 'specialCharCriteria', regex: /[!@#$%^&*(),.?":{}|<>]/ },
								{ id: 'uppercaseCriteria', regex: /[A-Z]/ },
								{ id: 'numberCriteria', regex: /[0-9]/ },
								{ id: 'lengthCriteria', regex: /.{8,}/ }
							];

							const password = document.getElementById('password').value;

							criteria.forEach(({ id, regex }) => {
								const element = document.getElementById(id);
								if (regex.test(password)) {
									element.classList.remove('text-danger');
									element.classList.add('text-success');
									element.querySelector('.checkmark').textContent = '✔';
								} else {
									element.classList.remove('text-success');
									element.classList.add('text-danger');
									element.querySelector('.checkmark').textContent = '✘';
								}
							});
						}

						document.getElementById('password').addEventListener('input', updateCriteria);
					</script>

					<script>
						document.addEventListener('DOMContentLoaded', function() {
							const resetForm = document.querySelector('form[action="{{ route('password.update') }}"]');

							resetForm.addEventListener('submit', function(event) {
								event.preventDefault();

								const formData = new FormData(resetForm);
								fetch('{{ route('password.update') }}', {
									method: 'POST',
									body: formData,
									headers: {
										'X-CSRF-TOKEN': '{{ csrf_token() }}'
									}
								})
								.then(response => response.json())
								.then(data => {
									if (data.status === 'success') {
										$('#loginModal').modal('show');
									} else {
										const errorMessages = data.errors.join('<br>');
										showToast(errorMessages, 'error');
									}
								})
								.catch(error => showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error'));
							});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
