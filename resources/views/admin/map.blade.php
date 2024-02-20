<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main2.css') }}">
    <title>Map</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-sky px-3 shadow-sm">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
            <div class="collapse d-none w-100 navbar-collapse ms-lg-5 me-3 me-lg-0" id="mynavbar">
                <div class="me-auto w-100 d-sm-flex justify-content-end align-items-center ">
                    <div class="col-9 col-lg-6 col-xl-5 d-sm-flex align-items-center  d-none">
                        {{-- <form action="" class="w-100"> --}}
                        <div class="px-3 bg-white rounded-3 d-sm-flex py-2 w-100 ">
                            <input name="" id="searchInput2" class="bg-white border-0 w-100 focus-none"
                                placeholder="Post code or address ">
                            <label for="search"
                                class="bg-primary  d-none d-md-block small text-blue px-3 py-2 rounded-3"><i
                                    class="fa-solid fa-magnifying-glass text-white"></i></label>
                        </div>
                        <a class="text-decoration-none text-primary fs-5 ms-3" href="{{ route('logout') }}"
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
            <div class="d-flex align-items-center">
                <div class="d-sm-none">
                    <a class="text-decoration-none text-primary fs-5 ms-3" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <div class="d-flex align-items-center ms-2">
                    <i class="fa-solid fa-bars text-white bg-primary rounded-2 pointer d-lg-none fs-4"
                        id="toggleButton1"></i>
                </div>
            </div>
        </div>

    </nav>
    <!-- Sidebar -->
    <div class="">
        <section class="d-flex position-relative">
            <div class="blue-bg side-map p-3 elementToToggle d-lg-block">
                <div class="position-mark d-lg-none pointer">
                    <i class="fa-regular fa-circle-xmark text-white" id="toggleButton"></i>
                </div>
                <div class="light-blue position-relative p-3 rounded-4 mt-lg-3 mt-4 mb-0">
                    <p class="bg-primary text-white px-3 py-2 shadow rounded-3">Details</p>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Site name:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['site_name'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2 d-none">
                        <label class="text-primary ms-1 fs-6 small">Quardinates:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['quardinates'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Email:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['email'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Contact:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['contact'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Address:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['address'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Owner Address:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="text" name="" id="" class="w-100 p-0 border-0 small"
                                placeholder="{{ $map['owneradress'] }}" readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label class="text-primary ms-1 fs-6 small">Note:</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <textarea rows="6" class="w-100 p-0 border-0 small resize-none" readonly> {{ $map['note'] }}
                                </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ----- primary nav ----- -->
            <div class="primary-nav position-relative ">
                <div class="alpha-black d-none d-sm-flex align-items-center justify-content-between position-pnav">
                    <div class="d-flex align-items-center">
                        <h3 class="text-white mb-0 ms-lg-0 d-none d-sm-block fs-6 text-nowrap me-2">Map Plans</h3>

                    </div>
                    <div class="d-flex mt-sm-0 justify-content-sm-end align-items-center">
                        <div class="me-2 d-none">
                            <button id="customDrawButton"
                                class="text-white d-flex align-items-center bg-primary border-0 rounded-3 py-2 px-2 px-sm-3 font-re">Draw
                                <i class="fa-solid fa-pen ms-2"></i></button>
                        </div>
                        <style>

                        </style>
                        <div class="d-none">
                            <button id="customUndoButton"
                                class="text-white bg-primary border-0 rounded-3 py-2 px-2 px-sm-3 font-re"
                                id=" deleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="map">

                    </div>
                </div>


                <div class="d-none">
                    <h2>Polygon Coordinates and Area:</h2>
                    <table id="coordinatesTable">
                        <thead>
                            <tr>
                                <th>Coordinates</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td><input type="text" class="form-control" name="mpqr" id="mpqr"
                                        value="{{ $map['quardinates'] }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- ======JS link==== -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu1gwHCSzLG9ACacQqLk-LG8oJMkarNF0&libraries=drawing,places&callback=initMap">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
