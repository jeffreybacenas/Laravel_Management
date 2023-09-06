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
		<form method="POST" action="{{ route('performLogin') }}">
		@csrf
			<h1>Library Management Login</h1>
			<div class="input-box">
				<input type="text" placeholder="Email" class="form-control"  name="email" required>
				<i class='bx bxs-user'></i>
			</div>

			<div class="input-box">
				<input type="password" class="form-control"  placeholder="Password" name="password" required>
				<i class='bx bxs-lock-alt' ></i>
			</div>

			<button type="submit" class="btn">Login</button>

			<div class="register-link">
				<p>Don't have an account?
					<a href="{{ route('registration') }}">Register</a></p>
			</div>

		</form>
	</div>
	

	<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
	@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}', // Use session('error') here
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    </script>
	@endif

	@if(session('success'))
          <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                toast: true,
                position: 'top-end', // Position the toast notification at the top-right corner
                showConfirmButton: false,
                timer: 3000 // Display for 3 seconds
            });
          </script>
        @endif


</body>
</html>