<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <!-- Bootstrap CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 my-auto mx-auto">
                <div class="card-header bg-white border-0 py-3">
                    <h1 class="text-center">REGISTER</h1>
                </div>
                <div class="card-body">
                    <form action="../actions/register-action.php" method="post">
                        <div class="mb-3">
                            <label for="first-name" class="form-label">Firstname</label>
                            <input type="text" name="first_name" id="first-name" class="form-control" required autofocus>
                        </div>
                        
                        <div class="mb-3">
                            <label for="last-name" class="form-label">Lastname</label>
                            <input type="text" name="last_name" id="last-name" class="form-control" required>
                        </div>

                        <!-- Bold for emphasies -->
                         <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control fw-bold" maxlength="15" required>
                         </div>

                         <div class="mb-5">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" minlength="8" class="form-control fw-bold" required aria-describedby="password-info">
                            <div class="form-text" id="password-info">
                                Password must be atleast 8 characters long.
                            </div>
                         </div>
                         <button type="submit" class="btn btn-success w-100">Register</button>
                    </form>
                    <p class="text-center mt-3 small">Registered already? <a href="../views">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>