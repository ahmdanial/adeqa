<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
        @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange"><!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            AD
        </a>
        <a href="https://web.facebook.com/people/Alfa-Diagnostik-Sdn-Bhd/100064047660052/?_rdc=1&_rdr" class="simple-text logo-normal">
          ADEQA
        </a>

      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
        <li class="{{ 'user-register' == request()->path() ? 'active' : '' }}">
            <a href="./user-register">
                <i class="now-ui-icons users_single-02"></i>
                <p>Registered User</p>
            </a>
            </li>

            <li>
                <li class="{{ 'departments' == request()->path() ? 'active' : '' }}">
                <a href="./departments">
                    <i class="now-ui-icons business_briefcase-24"></i>
                    <p>Department Setup</p>
                </a>
            </li>

            <li>
                <li class="{{ 'programs' == request()->path() ? 'active' : '' }}">
                <a href="./programs">
                    <i class="now-ui-icons tech_laptop"></i>
                    <p>Program Setup</p>
                </a>
            </li>

            <li>
                <li class="{{ 'labs' == request()->path() ? 'active' : '' }}">
                <a href="./labs">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Labs Setup</p>
                </a>
            </li>

            @php
            use Illuminate\Support\Str;
            @endphp

            <li class="{{ Str::startsWith(request()->path(), 'test-setup') ? 'active dropdown' : '' }}">
                <a href="#" data-toggle="collapse" data-target="#setupDropdown">
                    <i class="now-ui-icons business_bulb-63"></i>
                    <p>Test Setup</p>
                </a>
                <ul class="collapse list-unstyled" id="setupDropdown">
                    @foreach(['instruments', 'reagents', 'tests', 'units', 'methods'] as $item)
                        <li class="{{ $item == request()->path() ? 'active' : '' }}">
                            <a href="{{ "./$item" }}" style="padding-left: 30px;">
                                <i class="now-ui-icons design_app"></i>
                                <p>{{ ucfirst($item) }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="{{ Str::startsWith(request()->path(), 'assign-' . $item) ? 'active dropdown' : '' }}">
              <a href="#" data-toggle="collapse" data-target="#assignDropdown">
                  <i class="now-ui-icons loader_gear"></i>
                  <p>Assign</p>
              </a>
              <ul class="collapse list-unstyled" id="assignDropdown">
                  @foreach([ 'users','programs' ] as $item)
                      <li class="{{ Str::startsWith(request()->path(), 'assign-' . $item) ? 'active' : '' }}">
                          <a href="{{ route('assign.' . $item) }}" style="padding-left: 30px;">
                              <i class="now-ui-icons design_app"></i>
                              <p>{{ ucfirst($item) }}</p>
                          </a>
                      </li>
                  @endforeach
              </ul>

          </li>


        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/adeqa-white.png') }}" alt="ADEQA Logo" height="60">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a id="navbarDropdownMenuLink" data-toggle="dropdown" class="nav-link dropdown-toggle" href="#pablo" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->username }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->



      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">

        @yield('content')

      </div>



      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  ALFA DIAGNOSTIK
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">ADEQA</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Ahmad Danial</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>

  <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
  <script>
    @if (session('status'))
            //alert('{{ session('status') }}');

            Swal.fire({
                title: '{{ session('status') }}',
                position: 'center',
                icon: '{{ session('statuscode') }}',
                button: "OK",
                })

        @endif
    </script>

    @yield('scripts')

</body>

</html>