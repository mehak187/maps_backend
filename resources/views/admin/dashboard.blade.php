<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Map List</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-sky px-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
            <div class="collapse d-block w-100 navbar-collapse ms-lg-5" id="mynavbar">
                <div class="me-auto w-100 d-sm-flex justify-content-end align-items-center ">
                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-5 d-flex align-items-center">
                        {{-- <form action="" class="w-100"> --}}
                        <div class="px-3 w-100 bg-white rounded-3 d-flex py-2 mt-2 mt-lg-0">
                            <input type="text" id="myinput" class="bg-white border-0 w-100 focus-none"
                                placeholder="Search..." onkeyup="searchFunction()">
                            <label for="search" class="bg-primary small text-blue px-3 py-2 rounded-3"><i
                                    class="fa-solid fa-magnifying-glass text-white"></i></label>
                        </div>
                        <a class="text-decoration-none fs-5 ms-3 text-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- </form> --}}
                    </div>

                </div>
            </div>
        </div>


    </nav>
    <section class="">
        <div class="mycontainer px-4">
            <div class="bg-white shadow list-sec-main rounded-4 py-3 px-3 mt-4">
                <div class="bg-white list-sec px-2 " id="content">
                 @if (count($maps) > 0)
                    @foreach ($maps as $map)
                        <a href="{{ 'map/' . $map['id'] }}"
                            class="city-result text-blue rounded-3 my-3 text-decoration-none list-item justify-content-between align-items-center bg-grey py-3 px-3 map-item">
                            <div class="d-flex align-items-center one">
                                <div class="site-logo me-3">
                                    <img src="{{ asset('img/site-logo.png') }}" class="w-100" alt="">
                                </div>
                                <div>
                                    <h2 class="small  text-primary mb-0 fw-bold">
                                        Site Name
                                    </h2>
                                    <p class="mb-0 small  text-primary searchable ">{{ $map['site_name'] }}</p>
                                </div>
                            </div>
                            <div class="one">
                                <h2 class="small  text-primary mb-0 fw-bold">
                                    Email
                                </h2>
                                <p class="mb-0 small  text-primary author">{{ $map['email'] }}</p>
                            </div>
                            <div class="one">
                                <h2 class="small  text-primary mb-0 fw-bold">
                                    Contact
                                </h2>
                                <p class="mb-0 small  text-primary searchable">{{ $map['contact'] }}</p>
                            </div>
                            <div class="one">
                                <h2 class="small  text-primary mb-0 fw-bold">
                                    Address of property
                                </h2>
                                <p class="mb-0 small  text-primary searchable">{{ $map['address'] }}</p>
                            </div>
                            <div class="d-none">
                                <h2 class="small  text-primary mb-0 fw-bold">
                                    Quardinates
                                </h2>
                                <p class="mb-0 small  text-primary searchable">{{ $map['quardinates'] }}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between one">
                                <div class="me-2">
                                    <h2 class="small  text-primary mb-0 fw-bold">
                                        Owner Address
                                    </h2>
                                    <p class="mb-0 small  text-primary searchable">{{ $map['owneradress'] }}</p>
                                </div>
                                <div class="site-logo2">
                                    <img src="{{ asset('img/arrow-icon.png') }}" alt="" class="w-100">
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                 <div class="d-flex align-items-center mt-3 ">
                    <i class="fas fa-exclamation-triangle text-danger fs-4 me-2"></i>
                    <p class="mb-0 text-danger">
                    No data to show
                    </p>
                </div>
                @endif
                </div>
            </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
