<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php

$sesion = null;

if (isset($_GET['logout'])) {
    Session::forget('user');
    session_destroy();
    unlink(__DIR__ . '/user.json');
}

if (isset($_SESSION['login'])) {
    $sesion = $_SESSION['login'];
}

if (Session::has('user')) {
    $_SESSION['login'] = Session::get('user');
    $sesion = $_SESSION['login'];
    if (!is_file(__DIR__ . '/user.json')) {
        $fichero = __DIR__ . '/user.json';
        $myfile = fopen($fichero, 'w');

        $texto = Session::get('user')['name'] . ',' . Session::get('user')['email'] . ',' . Session::get('user')['avatar'];
        fwrite($myfile, $texto); 
        fclose($myfile);

    } else {
        $fichero = __DIR__ . '/user.json';
        $myfile = fopen($fichero, 'w');

        $texto = Session::get('user')['name'] . ',' . Session::get('user')['email'] . ',' . Session::get('user')['avatar'];
        fwrite($myfile, $texto); 
        fclose($myfile);
    }

}
?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?= $lang['title'] ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ url('assets/fontawesome-free-6.1.0-web/css/all.css') }}" />
<link rel="stylesheet" href="{{ url('assets/css/styles.css') }}" />
<link rel="stylesheet" href="{{ url('assets/css/create.css') }}" />
<link rel="stylesheet" href="{{ url('assets/css/autocomplete.css') }}" />
<link rel="icon" href="{{ url('assets/images/icon/versus.png') }}">
</head>

<body class="background">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="http://127.0.0.1:8000/?lang=<?= $lang['lang'] ?>"><?= $lang['home'] ?></a>
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><?= $lang['new-phone'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $lang['brands-recorded'] ?>0</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $lang['new-cpu'] ?></a>
                </li>
            </ul>

            <span class="navbar-text" ;">
                <div class="row">
                    <div class="col-2">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= 'assets/images/flags/' . $lang['flag'] . '.svg' ?>" alt="user-image"
                                        class="me-2 rounded" height="18">
                                    <span class="align-middle"><?= $lang['lang'] ?></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item dropdown-item" href="?lang=en" data-lang="en"
                                            title="English">
                                            <img src="assets/images/flags/us.svg" alt="user-image"
                                                class="me-2 rounded" height="18">
                                            <span class="align-middle">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="?lang=sp" data-lang="sp" title="Spanish">
                                            <img src="assets/images/flags/spain.svg" alt="user-image"
                                                class="me-2 rounded" height="18">
                                            <span class="align-middle">Español</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php
                        
                            if (Session::has('user')) {
                                ?>
                    <div class="col-8" style="transform: translateX(60%); margin-top: 3%;">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= Session::get('user')['avatar'] ?>" width="30">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item"><?= Session::get('user')['name'] ?></a></li>
                                <li><a class="dropdown-item"><?= Session::get('user')['email'] ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="?logout=logout"><?= $lang['logout'] ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                            } else {               
                        ?>
                    <div class="col-8 offset-2">
                        <a class="btn btn-lg btn-google btn-block text-uppercase btn-outline" type="button"
                            href="/login-google"><img
                                src="https://img.icons8.com/color/16/000000/google-logo.png"><?= $lang['google-auth'] ?></a>
                    </div>

                    <?php
                                }
                                ?>
                </div>

            </span>
        </div>
    </nav>

    <div class="d-flex" id="wrapper">
    <?php
    
    if (Session::has('user')) {

    
    ?>
        <div class="bg-white" id="sidebar-wrapper">

            <div class="list-group list-group-flush my-3">
                <a href="http://127.0.0.1:8000/cpu-manage?lang=<?= $lng ?>"
                    class="current list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-microchip"></i> <?=$lang["cpu"]?></a>
                <a href="http://127.0.0.1:8000/cpubrand-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-microchip"></i> <?=$lang["cpu-brand"]?></a>
                <a href="http://127.0.0.1:8000/glass-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-mobile-screen"></i> <?=$lang["glass"]?></a>
                <a href="http://127.0.0.1:8000/model-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-mobile"></i> <?=$lang["model"]?></a>
                <a href="http://127.0.0.1:8000/modelbrand-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-brands fa-apple"></i> <?=$lang["model-brand"]?></a>
                <a href="http://127.0.0.1:8000/modelmaterial-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-gem"></i> <?=$lang["model-material"]?></a>
                <a href="http://127.0.0.1:8000/os-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-brands fa-android"></i> <?=$lang["os"]?></a>
                <a href="http://127.0.0.1:8000/screenmaterial-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-display"></i> <?=$lang["screen-material"]?></a>
            </div>
        </div>
        <?php
        
        }
        ?>
        
        <div id="page-content-wrapper">
            <div class="container-fluid px-4">

                <div class="body">
                    <div class="container mt-10">
                        <center>
                            <h2><strong><?= $lang['sub-header'] ?></strong></h2>
                        </center>
                        <form class="mt-5" id="idform" autocomplete="off">
                            <div class="row">
                                <div class="mb-3 col-3 offset-2 autocomplete">
                                    <input type="smart1" class="input1" name="smartphone1" id="idsmart1"
                                        placeholder="<?= $lang['smartphone-one'] ?>">
                                </div>
                                <div class="mb-3 col-3 autocomplete">
                                    <input type="smart2" class="input2" name="smartphone2" id="idsmart2"
                                        placeholder="<?= $lang['smartphone-two'] ?>">
                                </div>
                                <button type="button" onClick="actionCompare()"
                                    class="btn btn-dark col-2 compare"><strong><?= $lang['compare'] ?></strong></button>
                            </div>
                        </form>
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-2 offset-2">
                                    <img class="img-background-one"
                                        src="{{ url('assets/images/companies/oppo.jpg') }}" alt="img-background-two">
                                </div>
                                <div class="col-1 offset-1">
                                    <img class="versus-icon" src="{{ url('assets/images/companies/versus.png') }}"
                                        alt="versus-icon">
                                </div>
                                <div class="col-2 offset-1">
                                    <img class="img-background-two"
                                        src="{{ url('assets/images/companies/redmi.png') }}" alt="img-background-one">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $phones = [];
    
    foreach ($smartphones as $key => $value1) {
        foreach ($value1 as $key => $value2) {
            array_push($phones, $value2);
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="{{ url('assets/js/create.js') }}"></script>
    <script src="{{ url('assets/js/cpu.js') }}"></script>
    <script src="{{ url('assets/js/autocomplete.js') }}"></script>
    <script>
        var smartphones = [
            <?php
            for ($i = 0; $i < count($phones) - 1; $i++) {
                echo '"';
                echo $phones[$i];
                echo '"';
                echo ',';
            }
            
            echo '"';
            echo $phones[count($phones) - 1];
            echo '"';
            ?>
        ];

        autocomplete(document.getElementById("idsmart1"), smartphones);
        autocomplete(document.getElementById("idsmart2"), smartphones);
    </script>
    <?php include 'layouts/footer.php'; ?>
</body>

</html>
