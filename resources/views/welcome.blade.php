<!DOCTYPE html>
<html>
    <head>

        <title>Demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>

    <body>

        <!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg my_navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://www.instagram.com/acmauth" target="_blank">
                    <img src="{{ asset('images/LogoACM.png') }}" alt="Logo" height="50" class="brand-logo me-2">
                    <span>ACM Auth</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Events</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Homepage content-->
        <h1>This is the ACM website</h1>
        <h2>This is the homepage</h2>
        <h3>Click on "Events"</h3>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
        <script src="/js/app.js"></script>  

    </body>

</html>