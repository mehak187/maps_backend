<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="css/main3.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <section class="main bg-grey row shadow mx-2 mx-sm-4">
            <div class="col-6 d-none d-md-flex align-items-center px-3">
                <div class="row justify-content-center">
                    <div class="col-11 col-lg-9">
                        <img src="img/login-img.avif" alt="" class="w-100">
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-white px-4 px-xl-3 d-flex flex-column justify-content-center login-det">
                <div class="row justify-content-center">
                    <div class="col-sm-9 col-md-12 col-lg-11 col-xl-9">
                        <p class="mb-0 fs-4 text-center lh-sm">
                            Welcome to Map
                        </p>
                        <p class="mt-3 small text-center">
                            Please enter your login details.
                        </p>
                        <form method="POST" action="{{ route('login') }}" class="mt-4">
                            @csrf
                            <div class="d-flex align-items-center my-3 bg-white rounded-3 py-3 px-3 my-shadow">
                                <label for="email" class="me-2">
                                    <i class="fa-regular fa-envelope text-secondary"></i>
                                </label>
                                <input type="email" id="email" placeholder="Email"
                                    class="border-0 text-secondary w-100 focus-none @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center my-3 bg-white rounded-3 py-3 px-3 my-shadow">
                                <label for="password" class="me-2">
                                    <i class="fas fa-lock text-secondary"></i>
                                </label>
                                <input type="password" id="password" placeholder="Password"
                                    class="border-0 text-secondary w-100 focus-none@error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    class="bg-primary border-0 px-5 rounded-pill py-2 mt-5 text-white">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ------------------------
|         JS LINKS          |
------------------------- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
