<header class="headerContainer navContainer">
	<div class="container">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"> <img
					src="<?php echo e(asset('asset/images/logo.png')); ?>" width="90" height="48"
					alt="logoContainer"></a>
				<button class="navbar-toggler navbar navbar-light" type="button"
					data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul
						class="navbar-nav mx-auto mb-2 mb-lg-0 CenterAnchorTagsContainer">
						<li class="nav-item"><a
							class="nav-link anchor <?php echo e(request()->is('/') ? 'active' : ''); ?>"
							aria-current="page" href="/">Home</a></li>
						<li class="nav-item"><a
							class="nav-link  anchor <?php echo e(request()->is('tools') ? 'active' : ''); ?>"
							href="/tools">Tools</a></li>
						<li class="nav-item profile_u" id="userprofile"><a
							class="nav-link  anchor <?php echo e(request()->is('profile') ? 'active' : ''); ?>"
							href="/profile">Profil </a></li>

						<li class="nav-item archive" id="archive"><a
							class="nav-link anchor <?php echo e(request()->is('archive') ? 'active' : ''); ?>"
							href="/archive">Archiv</a></li>
					</ul>
					<div class="rightContainer">
						<div class="logOutbutton">
							<img style="cursor: pointer"
								src="<?php echo e(asset('asset/images/LogOut.svg')); ?>"
								onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
								alt="Log Out">

							<form id="logout-form" action="<?php echo e(route('logout')); ?>"
								method="POST" class="d-none"><?php echo csrf_field(); ?></form>

						</div>

					</div>
				</div>
			</div>
		</nav>
	</div>


</header>
<?php /**PATH D:\xampp\htdocs\resources\views/includes/header.blade.php ENDPATH**/ ?>