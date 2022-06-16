<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php

if (!is_array($model) && ($winner == $losser)) {
    $model = [0 => ['Smartphone' => $lang['equals']]];
}

$sesion = null;

if (isset($_SESSION['login'])) {
    $sesion = $_SESSION['login'];
} else {
    $sesion = null;
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $lang['title-comparator'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/create.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/compare.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/autocomplete.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/fontawesome-free-6.1.0-web/css/all.css') }}" />
    <link rel="icon" href="{{ url('assets/images/icon/versus.png') }}">
</head>

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

 ?>

<body class="background">
    <nav class="navbar navbar-light navbar-expand-lg" style="z-index: 5;">
        <div class="container">
            <a class="navbar-brand" href="http://127.0.0.1:8000/?lang=<?= $lng ?>"><?= $lang['home'] ?></a>
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

            <span class="navbar-text">
                <div class="row">
                    <div class="col-2">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url('assets/images/flags/' . $lang['flag'] . '.svg') }}"
                                        alt="user-image" class="me-2 rounded" height="18">
                                    <span class="align-middle"><?= $lang['lang'] ?></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item dropdown-item" href="?lang=en" data-lang="en"
                                            title="English">
                                            <img src="{{ url('assets/images/flags/us.svg') }}" alt="user-image"
                                                class="me-2 rounded" height="18">
                                            <span class="align-middle">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="?lang=sp" data-lang="sp" title="Spanish">
                                            <img src="{{ url('assets/images/flags/spain.svg') }}" alt="user-image"
                                                class="me-2 rounded" height="18">
                                            <span class="align-middle">Español</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php
                    @session_start();

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

        <?php
    
    if (count($session_user) >= 2) {

    
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

        <div class="container mt-5">
            <div id="page-content-wrapper">
                <div class="container-fluid px-4">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $lang['comparation-winner'] ?> <strong
                                    class="winner">{{ $model[0]['Smartphone'] }}</strong></h2>
                        </div>
                        <div class="card-body">
                            <div class="card-content">
                                <?php include 'layouts/comparator-side.php'; ?>
                            </div>
                        </div>

                        {{-- {{ $smartOne }}
            {{ $smartTwo }} --}}
                    </div>
                    <form class="mt-5" autocomplete="off">
                        <div class="row">
                            <div class="mb-3 col-3 offset-2 autocomplete">
                                <input type="smart1" class="input1" name="smartphone1" id="idsmart1"
                                    placeholder="<?= $lang['smartphone-one'] ?>" value="<?php if ($model[0]['Smartphone'] != $lang['equals']) {
                                        echo $model[0]['Smartphone'];
                                    } ?>">
                            </div>
                            <div class="mb-3 col-3 autocomplete">
                                <input type="smart2" class="input2" name="smartphone2" id="idsmart2"
                                    placeholder="<?= $lang['smartphone-two'] ?>">
                            </div>
                            <button type="button" onClick="actionCompare()"
                                class="btn btn-dark col-2 compare"><strong><?= $lang['compare'] ?></strong></button>
                        </div>
                    </form>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="pixel-density"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-pixel-density'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="screen-size"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-screen-size'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="battery-power"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-battery-power'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="ram"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-ram'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="camera"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-camera'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="weight"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-weight'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="card-content">
                                <figure class="highcharts-figure">
                                    <div id="benchmark"></div>
                                    <p class="highcharts-description">
                                        <?= $lang['description-benchmark'] ?>
                                    </p>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="container" style="height: 100px !important;">
        <div id="header"></div>
        <div id="body"></div>
        <div id="footer">
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>





    <script src="{{ url('assets/js/compare.js') }}"></script>
    <script src="{{ url('assets/js/create.js') }}"></script>
    <script src="{{ url('assets/js/autocomplete.js') }}"></script>
    <?php
    $phones = [];
    
    foreach ($smartphones as $key => $value1) {
        foreach ($value1 as $key => $value2) {
            array_push($phones, $value2);
        }
    }
    ?>
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
    <?php include 'layouts/highcharts.php'; ?>
</body>

</html>
