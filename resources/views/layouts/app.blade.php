<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="robots" content="follow, index" />
    <meta name="description"
        content="DidTrumpDoIt.com is a site dedicated to tracking what Donald Trump accomplishes and what he promised to accomplish.  We intend to hold Trump, conservative influencers, and Republicans responsible for the things they say." />

    <!-- OpenGraph entries for better social sharing support -->
    <meta property="og:url" content="https://didtrumpdoit.com" />
    <meta property="og:type" content="WebSite" />
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:description" content="DidTrumpDoIt.com is a site dedicated to tracking what Donald Trump accomplishes and what he promised to accomplish.  We intend to hold Trump, conservative influencers, and Republicans responsible for the things they say." />
    <meta property="og:image" content="https://didtrumpdoit.com/imgs/dtdi_ogimage.png" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:site" content="@theGimpboy" />
    <meta property="twitter:creator" content="@theGimpboy" />

    <link rel="apple-touch-icon" sizes="180x180" href="imgs/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon-16x16.png">
    <link rel="manifest" href="imgs/site.webmanifest">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <?php $statuses = \App\Models\Status::all(); ?>
    <?php $categories = \App\Models\Category::all(); ?>
    
    <style type="text/css">
    @foreach($statuses as $status)
    <?php $color = colority()->fromHex($status->color)->getBestForegroundColor()->getValueColor(); ?>
    .status-pill-{{ $status->id }} {
        background-color: {{ $status->color }} !important;
        --bs-badge-font-weight: 500 !important;
        --bs-badge-font-size: .8em !important;
        --bs-badge-color: {{ $color }} !important;
    }

    .status-pill-filter-{{ $status->id }} {
        color: black !important;
        font-size: .8em !important;
        background-color: white !important;
        --bs-badge-font-weight: 500 !important;
        --bs-badge-font-size: .8em !important;
        --bs-badge-color: black !important;
    }

    .status-{{$status->id}} {
        background-color: {{ $status->color }} !important;
        color: {{ $color }} !important;
    }

    .table-curved .status-{{ $status->id }} td:first-child:before {
        content: '' !important;
        position: absolute !important;
        border-radius: 8px 0 0 8px !important;
        background-color: {{ $status->color }} !important;
        width: 4px !important;
        height: 100% !important;
        left: -4px !important;
        top: 0px !important;
    }
    @endforeach

    @foreach($categories as $category)
    .category-pill-{{ $category->id }} {
        color: {{ colority()->fromHex($category->color)->getBestForegroundColor()->getValueColor() }} !important;
        background-color: {{ $category->color }} !important;
        --bs-badge-font-weight: 500 !important;
        --bs-badge-font-size: .8em !important;
        --bs-badge-color: {{ colority()->fromHex($category->color)->getBestForegroundColor()->getValueColor() }} !important;
    }

    .category-pill-filter-{{ $category->id }} {
        color: black !important;
        font-size: .8em !important;
        background-color: white !important;
        --bs-badge-font-weight: 500 !important;
        --bs-badge-font-size: .8em !important;
        --bs-badge-color: black !important;
    }
    @endforeach
    </style>
</head>

<body class="container-fluid">
    <!-- External JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.js"
        integrity="sha512-3CuraBvy05nIgcoXjVN33mACRyI89ydVHg7y/HMN9wcTVbHeur0SeBzweSd/rxySapO7Tmfu68+JlKkLTnDFNg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js" integrity="sha512-7DgGWBKHddtgZ9Cgu8aGfJXvgcVv4SWSESomRtghob4k4orCBUTSRQ4s5SaC2Rz+OptMqNk0aHHsaUBk6fzIXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js" integrity="sha512-k37wQcV4v2h6jgYf5IUz1MoSKPpDs630XGSmCaCCOXxy2awgAWKHGZWr9nMyGgk3IOxA1NxdkN8r1JHgkUtMoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-lg page-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('/imgs/dtdi_logo.png')}}" alt="Did Trump Do It?" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item nav-item active">
                            <a href="https://trumptracker.github.io/" class="nav-link">Old Data</a>
                        </li>
                        <li class="nav-item nav-item active">
                            <a href="{{ URL::Route('about') }}" class="nav-link">About</a>
                        </li>
                        <li class="nav-item nav-item active">
                            <a href="{{ URL::Route('api') }}" class="nav-link">API</a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-lg-flex align-items-center">
                        <form class="navbar-nav ms-auto flex-row-reverse">
                            <a class="nav-link" href="https://github.com/jbolduan/didtrumpdoit/issues/new"><button type="button"
                                    class="btn btn-outline-purple">Report Issue</button></a>&nbsp;

                            <a class="nav-link"
                                href="<?php echo url("/statements/create"); ?>"><button
                                    type="button" class="btn btn-outline-purple">Submit Promise</button></a>
                        </form>

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <ul class="list-unstyled">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="body-content">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md text-center">
                        <p class="text-muted">By <a href="https://bsky.app/profile/thegimpboy.daliban.co" target="_blank"
                                class="maintainer-name">theGimpboy</a></p>
                    </div>
                    <div class="col-md text-center">
                        <h4 class="text-muted">Open Source on Github <a href="https://github.com/jbolduan/didtrumpdoit.com"><i
                                    class="fab fa-github fa-fw"></i></a></h4>
                    </div>
                    <div class="col-md text-center">
                        <p class="text-muted"><a
                                href="/open-data"
                                target="_blank" rel="nofollow">Open Data</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Load After Scripts -->
    @vite(['resources/js/loadAfter.js'])
</body>

</html>
