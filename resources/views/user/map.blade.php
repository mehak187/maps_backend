<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main2.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Map</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>

            <div class="collapse w-100 navbar-collapse ms-lg-5" id="mynavbar">
                <div class="ms-auto w-100 d-sm-flex justify-content-end me-2 align-items-center ">
                    <div class="col-8 col-lg-6 col-xl-5">
                        <form action="" class="w-100">
                            <div class="px-3 bg-sky rounded-3 d-flex py-2">
                                <input name="" id="searchInput2" class="bg-sky border-0 w-100 focus-none"
                                    placeholder="Post code or address ">
                                <label for="search"
                                    class="bg-primary2  d-none d-md-block small text-blue px-3 py-2 rounded-3"><i
                                        class="fa-solid fa-magnifying-glass text-white"></i></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex text-nowrap align-items-center text-white bg-primary  pointer d-lg-none fs-6 rounded-2"
                id="toggleButton1">
                User Guide
                <i class="fas fa-book-reader ms-2 fs-6"></i>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <div class="">
        <section class="d-flex position-relative">
            <div class="blue-bg side-map p-3 elementToToggle d-lg-block">
                <div class="position-mark d-lg-none">
                    <i class="fa-regular fa-circle-xmark text-white" id="toggleButton"></i>
                </div>
                <form action="">
                    <div class="light-blue position-relative p-3 rounded-4 mt-lg-4 mt-5">
                        <div class="step">
                            <p class="bg-primary2 text-white px-3 py-2 shadow">Step 1</p>
                        </div>
                        <label class="text-primary small">Type Post code or address in the search box.</label>
                        <div class="d-flex align-items-center bg-white p-2 rounded-3">
                            <input type="search" name="" id="" class="w-100 p-0 border-0 font-13"
                                placeholder="Post code or address" readonly>
                            <i class="fa-solid fa-magnifying-glass bg-primary2 p-2 rounded-3 text-white font-13"></i>
                        </div>
                    </div>
                    <div class="light-blue position-relative p-3 rounded-4 mt-4">
                        <div class="step">
                            <p class="bg-primary2 text-white px-3 py-2 shadow">Step 2</p>
                        </div>
                        <label class="text-primary small">Click the draw button and click on the corners of your site to
                            form
                            a shape.</label>
                        <div class="text-end mt-2">
                            <p type="button"
                                class="d-inline-block mb-0 text-white bg-primary2 border-0 rounded-3 py-2 px-3">Draw<i
                                    class="fa-solid fa-pen ms-2"></i></p>
                        </div>
                    </div>
                    <div class="light-blue position-relative p-3 rounded-4 mt-4">
                        <div class="step">
                            <p class="bg-primary2 text-white px-3 py-2 shadow">Step 3</p>
                        </div>
                        <label class="text-primary small">Once the shape is complete fill in the contact details</label>
                        <div class="my-2">
                            <input type="text" class="grey-bg w-100 rounded-3 border-0 p-2 text-dark font-13"
                                placeholder="Site name" readonly>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="grey-bg w-100 rounded-3 border-0 p-2 text-dark font-13"
                                placeholder="Email" readonly>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="grey-bg w-100 rounded-3 border-0 p-2 text-dark font-13"
                                placeholder="Contact" readonly>
                        </div>
                    </div>
                    <div class="light-blue position-relative p-3 rounded-4 mt-4">
                        <div class="step">
                            <p class="bg-primary2 text-white px-3 py-2 shadow">Step 4</p>
                        </div>
                        <p class="mb-0 text-primary">Publish site.</p>
                        <label class="text-primary small">We will have a valuation back to you in 24 hours.</label>
                        <div class="text-end mt-2">
                            <button type="button" class="text-white bg-primary2 border-0 rounded-3 py-2 px-3">Publish
                                Site</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- ----- primary nav ----- -->
            <div class="primary-nav position-relative">
                <div class="alpha-black d-flex align-items-center justify-content-between position-pnav">
                    <div class="d-flex align-items-center">
                        <h3 class="text-white mb-0 ms-lg-0 d-none d-sm-block fs-6 text-nowrap me-2">Map Plans</h3>
                        <form action="" class="me-2 d-sm-none">
                            <div class="px-2 bg-white rounded-3 d-flex py-2">
                                <input name="" id="searchInput"
                                    class="font-re bg-white border-0 w-100 focus-none" placeholder="Search by address">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex mt-sm-0 justify-content-sm-end align-items-center">
                        <div class="me-2">
                            <button id="customDrawButton"
                                class="text-white d-flex align-items-center bg-transparent border-0 rounded-3 font-re">
                                <p class="mb-0 fs-6 me-2 text-white text-nowrap small" id="on">Draw On</p>
                                <p class="mb-0 fs-6 me-2 text-white text-nowrap small" id="off">Draw Off</p>
                                <label class="switch">
                                    <input type="checkbox" class="b-input">
                                    <span class="slider round"></span>
                                </label>
                            </button>
                        </div>
                        <style>

                        </style>
                        <div class="">
                            <button id="customUndoButton"
                                class="text-white bg-primary2 border-0 rounded-3 py-2 px-2 px-sm-3 font-re"
                                id=" deleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- --------distance-popup--------- -->
                <div class="dis-popup position-absolute d-none">
                    <div class="d-flex">
                        <div class="bg-white d-flex align-items-center py-2 rounded-3 px-3 me-2">
                            <h3 class="fw-normal mb-0 fs-6">
                                Distance:
                            </h3>
                            <div class="dropdown">
                                <button class="bg-white text-primary border-0 rounded-3 py-2 px-3 font-re"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div id="dist" class="mb-0">
                                    </div>
                                </button>
                            </div>
                            <i class="fa-solid fa-file text-primary"></i>
                        </div>
                        <div class="close-icon close-distance">
                            <i
                                class="fas fa-times bg-danger text-white fs-6 border border-4 border-light rounded-circle"></i>
                        </div>
                    </div>
                </div>
                <!-- --------polygon-popup--------- -->
                <div class="pol-popup position-absolute">
                    <div class="d-flex">
                        <div class="bg-white py-2 rounded-3 px-3 me-2">
                            <p class="mb-0 fw-bold">Draw Aria Polygon</p>
                            <div id="tarea">

                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                <button type="button"
                                    class="border-0 open-form bg-primary px-3 py-2 rounded-3 text-white">Convert
                                    to site</button>
                            </div>
                        </div>
                        <div class="close-icon close-pol">
                            <i
                                class="fas fa-times bg-danger text-white fs-6 border border-4 border-light rounded-circle"></i>
                        </div>
                    </div>
                </div>
                <!-- -------form-popup----- -->
                <div class="form-popup position-absolute">
                    <div class="d-flex">
                        <div class="bg-white py-2 rounded-3 px-2 me-2">
                            <div class="form-popup-inner px-2">
                                <p class="mb-0 fw-bold">Draw Aria Polygon</p>
                                <div id="tarea">

                                </div>
                                @if (session('success'))
                                    <script>
                                        swal("Good job!", "{{ session('success') }}", "success");
                                    </script>
                                @endif
                                <div class="mt-2 ">
                                    <form action="{{ route('publishsite') }}" method="POST">
                                        @csrf
                                        <input type="text" placeholder="Site name *"
                                            class="bg-grey2 rounded-3 w-100 border-0 focus-none py-2 px-2 my-1"
                                            name="site_name" required>
                                        @error('site_name')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="text" value=""
                                            class="bg-grey2 rounded-3 w-100 border-0 d-none focus-none py-2 px-2 my-1"
                                            name="quardinates" readonly required>
                                        @error('quardinates')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="email" placeholder="Email *"
                                            class="bg-grey2 rounded-3 w-100 border-0 focus-none py-2 px-2 my-1"
                                            name="email" required>
                                        @error('email')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="tel" placeholder="Contact *"
                                            class="bg-grey2 rounded-3 w-100 border-0 focus-none py-2 px-2 my-1"
                                            name="contact" required>
                                        @error('contact')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="text" placeholder="Address of property *"
                                            class="bg-grey2 rounded-3 w-100 border-0 focus-none py-2 px-2 my-1"
                                            name="address" required>
                                        @error('address')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="text" placeholder="Owner address *"
                                            class="bg-grey2 rounded-3 w-100 border-0 focus-none py-2 px-2 my-1"
                                            name="owneradress" required>
                                        @error('owneradress')
                                            <span class="error text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <div>
                                            <label for="note">Notes *</label>
                                            <textarea name="note" id="note" class="w-100 border-0 resize-none bg-grey2 rounded-3 py-2 px-2 "
                                                rows="4" required></textarea>
                                        </div>
                                        <div class="mt-2 d-flex justify-content-start">
                                            <button type="submit"
                                                class="border-0 bg-primary px-3 py-2 rounded-3 text-white">Publish
                                                site</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="close-icon close-form">
                            <i
                                class="fas fa-times bg-danger text-white fs-6 border border-4 border-light rounded-circle"></i>
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
                                <th>Polygon</th>
                                <th>Coordinates</th>
                                <th>Area (km²)</th>
                                <th>Distance</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
    <script src="{{ asset('js/user.js') }}"></script>

</body>

</html>
