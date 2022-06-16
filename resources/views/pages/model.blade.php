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

$str_arr = explode(',', $replace2);

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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <img src="<?= 'assets/images/flags/' . $lang['flag'] . '.svg' ?>" alt="user-image"
                                        class="me-2 rounded" height="18">
                                    <span class="align-middle"><?= $lang['lang'] ?></span>
                                </a>
                                {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item dropdown-item" href="?lang=en" data-lang="en"
                                            title="English">
                                            <img src="assets/images/flags/us.svg" alt="user-image" class="me-2 rounded"
                                                height="18">
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
                    <i class="fa-solid fa-microchip"></i> <?= $lang['cpu'] ?></a>
                <a href="http://127.0.0.1:8000/cpubrand-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-microchip"></i> <?= $lang['cpu-brand'] ?></a>
                <a href="http://127.0.0.1:8000/glass-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-mobile-screen"></i> <?= $lang['glass'] ?></a>
                <a href="http://127.0.0.1:8000/model-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-mobile"></i> <?= $lang['model'] ?></a>
                <a href="http://127.0.0.1:8000/modelbrand-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-brands fa-apple"></i> <?= $lang['model-brand'] ?></a>
                <a href="http://127.0.0.1:8000/modelmaterial-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-gem"></i> <?= $lang['model-material'] ?></a>
                <a href="http://127.0.0.1:8000/os-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-brands fa-android"></i> <?= $lang['os'] ?></a>
                <a href="http://127.0.0.1:8000/screenmaterial-manage?lang=<?= $lng ?>"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-display"></i> <?= $lang['screen-material'] ?></a>
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
                                <div class="col-sm-8">
                                    <h2><b><?= $lang['model-list'] ?></b></h2>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-info add-new" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"><i class="fa fa-plus"></i>
                                        </i><?= $lang['add-new'] ?></button>
                                </div>
                            </div>
                        </div>
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" width="100">Id</th>
                                    <th scope="col" width="100">Serie</th>
                                    <th scope="col" width="100">Year</th>
                                    <th scope="col" width="100">Screen Size</th>
                                    <th scope="col" width="100">Pixel Density</th>
                                    <th scope="col" width="100">Battery Power</th>
                                    <th scope="col" width="100">RAM</th>
                                    <th scope="col" width="100">ResolutionX</th>
                                    <th scope="col" width="100">ResolutionY</th>
                                    <th scope="col" width="100">Front Main Camera</th>
                                    <th scope="col" width="100">Back Main Camera</th>
                                    <th scope="col" width="100">Weight</th>
                                    <th scope="col" width="100">Waterproof</th>
                                    <th scope="col" width="100">Refresh Rate</th>
                                    <th scope="col" width="100">Id OS</th>
                                    <th scope="col" width="100">Id Model Material</th>
                                    <th scope="col" width="100">Id Glass</th>
                                    <th scope="col" width="100">Id CPU</th>
                                    <th scope="col" width="100">Id Model Brand</th>
                                    <th scope="col" width="100">Status</th>
                                    <th scope="col" width="100">Available</th>
                                    <th scope="col" width="100" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $array2 = [];
                            foreach ($identi as $key => $value) {
                                    array_push($array2, $value);
                                    foreach ($value as $key2 => $value2) {
                                        {{-- echo $value2; --}}
                                    }
                            }
                            ?>
                                <?php
                                $array = [];
                                $id = null;
                                foreach ($model as $key => $value) {
                                    array_push($array, $value);
                                    echo '<tr>';
                                    foreach ($value as $key2 => $value2) {
                                        echo '<td>';
                                        echo $value2;
                                        echo '</td>';
                                        if ($key2 == 'idModel') {
                                            $id = $value2;
                                        }
                                    }
                                    echo '<td>';
                                    echo '<div class="text-center">';
                                    echo '<div class="btn-group">';
                                    echo '<button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#editModal" id="' . $id . '" onClick="edit_model(this.id)" value="' . $id . '" >' . $lang['edit'] . '</button>';
                                    echo '<button class="btn btn-danger btnDelete" data-bs-toggle="modal" data-bs-target="#deleteModal" id="' . $id . '" onClick="delete_model(this.id)" value="' . $id . '"  >' . $lang['delete'] . '</button>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>

                                <script type="text/javascript">
                                    // Using PHP implode() function
                                    var passedArray = <?php echo json_encode($array); ?>;
                                    var passedArray2 = <?php echo json_encode($array2); ?>;
                                </script>

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
                        <?= $lang['add-model'] ?>
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        id="buttonClose" aria-label="Close"></button>
                </div>
                <form action="http://localhost/apirest-comparator/public/store-model" method="post" id="formulario">
                    <div class="modal-body">
                        <div class="w-600-disabled">
                            <input type="text" class="form-control mt-1 w-400" name="serie" id=""
                                placeholder="Serie" />
                                <input type="year" class="form-control mt-1 w-400" name="year" id=""
                                placeholder="Year" />
                            <input type="numeric" class="form-control mt-1 w-400" name="screensize" id=""
                                placeholder="Screen Size (inches)" />
                            <input type="Number" class="form-control mt-1 w-400" name="pixeldensity" id=""
                                placeholder="Pixel Density (ppi)" />
                            <input type="Number" class="form-control mt-1 w-400" name="batterypower" id=""
                                placeholder="Battery Power (mAh)" />
                            <input type="Number" class="form-control mt-1 w-400" name="ram" id=""
                                placeholder="RAM (GB)" />
                            <input type="Number" class="form-control mt-1 w-400" name="resolutionx" id=""
                                placeholder="ResolutionX (pixels)" />
                            <input type="Number" class="form-control mt-1 w-400" name="resolutiony" id=""
                                placeholder="ResolutionY (pixels)" />
                            <input type="Number" class="form-control mt-1 w-400" name="frontmaincamera" id=""
                                placeholder="Front Main Camera (MP)" />
                            <input type="Number" class="form-control mt-1 w-400" name="backmaincamera" id=""
                                placeholder="Back Main Camera (MP)" />
                            <input type="numeric" class="form-control mt-1 w-400" name="weight" id=""
                                placeholder="Weight (g)" />
                                <input type="Number" class="form-control mt-1 w-400" name="refreshrate" id=""
                                placeholder="Refresh Rate (Hz)" />

                            <select class="form-select  mt-1 w-400" name="waterproof"
                                aria-label="Default select example">
                                <option value="0" selected><?= $lang['not-waterproof'] ?></option>
                                <option value="1"><?= $lang['waterproof'] ?></option>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idscreenmaterial" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($screen as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idScreenMaterial'] . '">' . $value['Material'] .'</option>';
                            }

                            
                            ?>
                            </select>


                            <select class="form-select  mt-1 w-400" name="idos" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($os as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idOS'] . '">' . $value['os'] . ' '. $value['osversion'] .'</option>';
                            }

                            
                            ?>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idmodelmaterial" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($modelmaterial as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idModelMaterial'] . '">' . $value['Material'] . '</option>';
                            }

                            
                            ?>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idglass" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($glass as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idGlass'] . '">' . $value['Glass'] . '</option>';
                            }

                            
                            ?>
                            </select>

                            <select class="form-select  mt-1 w-400" name="idcpu" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($cpu as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idCPU'] . '">' . $value['CPUModel'] . '</option>';
                            }

                            
                            ?>
                            </select>
                            <select class="form-select  mt-1 w-400" name="idmodelbrand" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($modelbrand as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idModelBrand'] . '">' . $value['Brand'] . '</option>';
                            }

                            
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg">
                            <?= $lang['send-data'] ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">
                        <?= $lang["edit"] ?>
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        id="buttonClose" aria-label="Close"></button>
                </div>
                <form action="http://localhost/apirest-comparator/public/update-model" method="post" id="formulario">
                    <div class="modal-body">
                        <div class="w-600-disabled">
                            <input type="text" class="form-control mt-1 w-400" name="serie" id="edit_serie"
                                placeholder="Serie" />
                                <input type="year" class="form-control mt-1 w-400" name="year" id="edit_year"
                                placeholder="Year" />
                            <input type="numeric" class="form-control mt-1 w-400" name="screensize" id="edit_screensize"
                                placeholder="Screen Size (inches)" />
                            <input type="Number" class="form-control mt-1 w-400" name="pixeldensity" id="edit_pixeldensity"
                                placeholder="Pixel Density (ppi)" />
                            <input type="Number" class="form-control mt-1 w-400" name="batterypower" id="edit_batterypower"
                                placeholder="Battery Power (mAh)" />
                            <input type="Number" class="form-control mt-1 w-400" name="ram" id="edit_ram"
                                placeholder="RAM (GB)" />
                            <input type="Number" class="form-control mt-1 w-400" name="resolutionx" id="edit_resolutionx"
                                placeholder="ResolutionX (pixels)" />
                            <input type="Number" class="form-control mt-1 w-400" name="resolutiony" id="edit_resolutiony"
                                placeholder="ResolutionY (pixels)" />
                            <input type="Number" class="form-control mt-1 w-400" name="frontmaincamera" id="edit_frontmaincamera"
                                placeholder="Front Main Camera (MP)" />
                            <input type="Number" class="form-control mt-1 w-400" name="backmaincamera" id="edit_backmaincamera"
                                placeholder="Back Main Camera (MP)" />
                            <input type="numeric" class="form-control mt-1 w-400" name="weight" id="edit_weight"
                                placeholder="Weight (g)" />

                            <input type="Number" class="form-control mt-1 w-400" name="refreshrate" id="edit_refreshrate"
                                placeholder="Refresh Rate (Hz)" />
                            <select class="form-select  mt-1 w-400" name="waterproof"
                                aria-label="Default select example">
                                <option value="0" selected><?= $lang['not-waterproof'] ?></option>
                                <option value="1"><?= $lang['waterproof'] ?></option>
                            </select>

                            <select class="form-select  mt-1 w-400" name="available" aria-label="Default select example">
                                <option value="1" selected><?=$lang["available"]?></option>
                                <option value="0"><?=$lang["not-available"]?></option>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idscreenmaterial" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($screen as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idScreenMaterial'] . '">' . $value['Material'] .'</option>';
                            }

                            
                            ?>
                            </select>


                            <select class="form-select  mt-1 w-400" name="idos" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($os as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idOS'] . '">' . $value['os'] . ' '. $value['osversion'] .'</option>';
                            }

                            
                            ?>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idmodelmaterial" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($modelmaterial as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idModelMaterial'] . '">' . $value['Material'] . '</option>';
                            }

                            
                            ?>
                            </select>
                            
                            <select class="form-select  mt-1 w-400" name="idglass" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($glass as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idGlass'] . '">' . $value['Glass'] . '</option>';
                            }

                            
                            ?>
                            </select>

                            <select class="form-select  mt-1 w-400" name="idcpu" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($cpu as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idCPU'] . '">' . $value['CPUModel'] . '</option>';
                            }

                            
                            ?>
                            </select>
                            <select class="form-select  mt-1 w-400" name="idmodelbrand" aria-label="Default select example">
                            <?php
                            $array = [];
                            $id = null;
                            foreach ($modelbrand as $key => $value) {
                                array_push($array, $value);
                                foreach ($value as $key2 => $value2) {
                                    

                                }
                            }
                            $array = json_decode(json_encode($array), true);
                            foreach ($array as $key => $value) {
                                echo '<option value="' . $value['idModelBrand'] . '">' . $value['Brand'] . '</option>';
                            }

                            
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg" name="id" id="get_id_update" value="">
                            <?= $lang['send-data'] ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}


    <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">
                        <?= $lang["delete"] ?>
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearForm()"
                        id="buttonClose" aria-label="Close"></button>
                </div>
                <form action="http://localhost/apirest-comparator/public/delete-model" method="post" id="formulario">
                    <div class="modal-body">
                        <div class="w-600-disabled">
                            <input type="text" class="form-control mt-1 w-400" name="id_mostrar" placeholder="CPU Model" id="id_mostrar" disabled />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark btn-lg" name="id" id="id_send_model_delete" value="">
                            <?= $lang["send-data"] ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
    <script src="{{ url('assets/js/model.js') }}"></script>
    <div id="container" style="height: 100px !important;">
        <div id="header"></div>
        <div id="body"></div>
        <div id="footer">
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>
</body>

</html>
