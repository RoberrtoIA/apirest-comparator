<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php

$sesion = null;

if (isset($_SESSION['login'])) {
    $sesion = $_SESSION['login'];
} else {
    $sesion = null;
}

?>


<?php 

$json = null;

if (is_file(__DIR__ . '/user.json')) {

        $fichero = __DIR__ . '/user.json';
        // Abre el fichero para obtener el contenido existente
        $actual = file_get_contents($fichero);
        
        $json = json_encode($actual);
}


$replace1 = str_replace('\\', '', $json);
$replace2 = str_replace('""', '', $replace1);
$replace2 = substr($replace2, 1, -1);
$replace2 = str_replace('name', '', $replace2);
$replace2 = str_replace('email', '', $replace2);
$replace2 = str_replace('avatar', '', $replace2);
$replace2 = str_replace('"', '', $replace2);
$replace2 = str_replace(':', '', $replace2);
$replace2 = str_replace('https', 'https:', $replace2);

$str_arr = explode (",", $replace2);

$session_user = $str_arr;


if (count($session_user) < 2) {
    header('Location: http://127.0.0.1:8000/redirect');
    die();
}
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title><?= $lang['title'] ?></title>
    <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/create.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/compare.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/autocomplete.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/fontawesome-free-6.1.0-web/css/all.css') }}" />
    <link rel="icon" href="{{ url('assets/images/icon/versus.png') }}">
</head>

<body class="background">

    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="http://127.0.0.1:8000/?lang=<?= $lng ?>"><?= $lang['home'] ?></a>
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= $lang['new-phone'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $lang['brands-recorded'] ?>0</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $lang['new-cpu'] ?></a>
                </li>
            </ul>

            <span class="navbar-text">
                <div class="row">
                    <div class="col-2">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= "assets/images/flags/" . $lang["flag"] . ".svg" ?>" alt="user-image" class="me-2 rounded" height="18">
                                    <span class="align-middle"><?= $lang['lang'] ?></span>
                                </a>
                                {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item dropdown-item" href="?lang=en" data-lang="en" title="English">
                                            <img src="assets/images/flags/us.svg" alt="user-image" class="me-2 rounded" height="18">
                                            <span class="align-middle">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="?lang=sp" data-lang="sp" title="Spanish">
                                            <img src="assets/images/flags/spain.svg" alt="user-image" class="me-2 rounded" height="18">
                                            <span class="align-middle">Español</span>
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                        </ul>
                    </div>
                    <?php

                    if ((count($session_user) >= 2)) {
                                ?>

                    <div class="col-8" style="transform: translateX(60%); margin-top: 3%;">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= $str_arr[2] ?>" width="30">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item"><?= $str_arr[0] ?></a></li>
                                <li><a class="dropdown-item"><?= $str_arr[1] ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="http://127.0.0.1:8000/?logout=logout">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php
                            } else {               
                        ?>
                    <div class="col-8 offset-2">
                        <a class="btn btn-lg btn-google btn-block text-uppercase btn-outline" type="button"
                            href="http://127.0.0.1:8000/login-google"><img
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
        <!-- Sidebar -->
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
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bars fs-4 me-3" id="menu-toggle" style="color:rgba(29, 42, 51, 255);"></i>
                    <h2 class="fs-2 m-0 second-text"></h2>
                </div>
            </nav>

            <div class="container-fluid px-4">
                

                <div class="table-responsive d-flex">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-8"><h2><b><?=$lang['os-list']?></b></h2></div>
                            </div>
                        </div>
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" width="50">Id</th>
                                    <th scope="col" width="100">OS</th>
                                    <th scope="col" width="100">OS version</th>
                                    <th scope="col" width="100">Score</th>
                                    <th scope="col" width="100">Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    foreach ($os as $key => $value) {
                                        echo '<tr>';
                                        foreach ($value as $key2 => $value2) {
                                            echo '<td>';
                                            echo $value2;
                                            echo '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->

    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">
                        Add Operating System
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        id="buttonClose" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="formulario">
                    <div class="modal-body">
                        <div class="w-600-disabled">
                            <input type="text" class="form-control mt-1 w-400" name="" id=""
                                placeholder="OS" />
                            <input type="number" class="form-control mt-1 w-400" name="" id=""
                                placeholder="OS Version" />
                            <input type="number" class="form-control mt-1 w-400" name="" id=""
                                placeholder="Score" />
                            <input type="number" class="form-control mt-1 w-400" name="" id=""
                                placeholder="Available" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg">
                            Enviar datos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script src="assets/js/create.js"></script>
    <div id="container" style="height: 100px !important;">
        <div id="header"></div>
        <div id="body"></div>
        <div id="footer">
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>
</body>

</html>