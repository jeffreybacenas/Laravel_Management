<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/custom-style/style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  	<link rel="stylesheet" href="{{ asset('css/sweetalert2/sweetalert2.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
</head>
<body>
<div class="wrapper">
		<form method="POST" action="{{ route('registration.store') }}">
		@csrf
			<h1>Library Management Registration</h1>

			<div class="form-group">
				<div class="row">
					<div class="col input-box">
						<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
					</div>
					<div class="col input-box">
						<input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
					</div>
					<div class="col input-box">
						<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
					</div>
				</div>
			</div>

			<div class="input-box">
				<input type="text" placeholder="Email" class="form-control"  name="email" required>
				<i class='bx bxs-user'></i>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col input-box">
						<input type="password" class="form-control"  placeholder="Password" name="password" required>
						<i class='bx bxs-lock-alt' ></i>
					</div>
					<div class="col input-box">
						<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
						<i class='bx bxs-lock-alt' ></i>
					</div>
				</div>
			</div>

			<button type="submit" class="btn">Login</button>

			<div class="register-link">
				<p>Already has an account?
					<a href="{{ route('login') }}">LogIn</a></p>
			</div>

		</form>
	</div>
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

  @if ($errors->any())
      @foreach ($errors->all() as $error)
          <script>
              Swal.fire({
                  icon: 'error',
                  title: '{{ $error }}',
                  toast: true,
                  position: 'top-end', // Position the toast notification at the top-right corner
                  showConfirmButton: false,
                  timer: 5000 // Display for 5 seconds
              });
          </script>
      @endforeach
  @endif


