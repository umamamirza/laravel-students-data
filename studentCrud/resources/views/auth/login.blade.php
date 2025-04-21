<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center"> 
            <div class="card p-4 col-md-6">
                <h2 class="text-center mb-3">Login Page</h2>
                <div id="register-errors" class="mb-3 text-danger"></div>

                <form id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
                e.preventDefault(); // default form submit ko roken

                let formData = {
                    email: $('input[name=email]').val(),
                    password: $('input[name=password]').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: "{{ route('login.submit') }}", // POST route for login
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // redirect on success
                        window.location.href = "{{ route('students.index') }}";
                    },
                    error: function (xhr) {
                        // show error
                        $('#register-errors').html(xhr.responseJSON?.message || "Invalid credentials.");
                    }
                });
            });
        });
    </script>
</body>
</html>
