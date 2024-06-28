<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theirma - Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reset beberapa default */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 500px;
            width: 100%;
        }

        /* Tampilan latar belakang */
        body {
            background: linear-gradient(to right, rgba(34, 203, 183, 0.7), rgba(34, 203, 183, 1));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Styling untuk card */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        /* Gaya gambar yang terpusat */
        .centered-image {
            display: block;
            margin: 0 auto 1rem auto;
        }

        /* Gaya input form */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            font-size: 1rem;
        }

        /* Gaya input form */
        .form-control,
        .form-control-file {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .form-group label {
            font-weight: bold;
        }

        /* Gaya tombol signup */
        .btn-primary.signup {
            background-color: rgb(34, 203, 183);
            border-color: rgb(34, 203, 183);
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
        }

        .btn-primary.signup:hover {
            background-color: rgba(34, 203, 183, 0.9);
            transform: scale(1.05);
        }

        .btn-primary.signup:active {
            background-color: rgba(34, 203, 183, 0.8);
            transform: scale(0.95);
        }

        /* Gaya teks link */
        p a {
            color: rgb(34, 203, 183);
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Gaya tambahan untuk fokus pada input form */
        .form-control:focus,
        .form-control-file:focus {
            border-color: rgb(34, 203, 183);
            box-shadow: 0 0 5px rgba(34, 203, 183, 0.5);
        }

        /* Responsivitas untuk card */
        @media (max-width: 767.98px) {
            .container {
                max-width: 90%;
                padding: 0 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Signup Section -->
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="index.php"><img src="assets/img/about.png" class="centered-image" width="200rem"></a>
                        </div>
                        <form action="config.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password..." required>
                            </div>
                            <div class="form-group">
                                <label for="document">Upload Document</label>
                                <input type="file" class="form-control-file" id="document" name="document" required>
                                <small>*Masukkan dokumen (Surat Keaslian Organisasi/Individu)</small>
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary signup">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>