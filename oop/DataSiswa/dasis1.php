<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card text-center">
                    <div class="card-body p-4">
                        <h1>DATA SISWA</h1>
                        <?php
                        session_start();

                        // Initialize an array if the array is not initialized yet
                        if (!isset($_SESSION['dataSiswa'])) {
                            $_SESSION['dataSiswa'] = array();
                        }

                        $editIndex = isset($_GET['edit']) ? $_GET['edit'] : -1;
                        $editData = $editIndex != -1 ? $_SESSION['dataSiswa'][$editIndex] : null;

                        if (isset($_POST["kirim"])) {
                            if ($_POST['nama'] == "" && $_POST['nis'] == "" && $_POST['rayon'] == "") {
                                echo "<div class='alert alert-danger text-center'>Data kosong</div>";
                            } else {
                                $siswa = array(
                                    "nama" => $_POST['nama'],
                                    "nis" => $_POST['nis'],
                                    "rayon" => $_POST['rayon']
                                );

                                if ($editIndex != -1) {
                                    $_SESSION['dataSiswa'][$editIndex] = $siswa;
                                } else {
                                    array_push($_SESSION['dataSiswa'], $siswa);
                                }

                                header('Location: ' . $_SERVER['PHP_SELF']);
                                exit;
                            }
                        }

                        if (isset($_POST['hapus_semua'])) {
                            // Clear all data
                            $_SESSION['dataSiswa'] = array();
                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }

                        if (isset($_GET['hapus'])) {
                            $key = $_GET['hapus'];
                            unset($_SESSION['dataSiswa'][$key]);

                            // Reindex the array to avoid issues with sequential keys
                            $_SESSION['dataSiswa'] = array_values($_SESSION['dataSiswa']);

                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }
                        ?>
                        <form action="" method="POST" class="row d-flex align-items-center">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" id="nama" placeholder="masukan nama siswa" name="nama"
                                class="form-control mb-2" value="<?= $editData['nama'] ?? '' ?>">

                            <label for="nis">NIS Siswa</label>
                            <input type="number" id="nis" placeholder="masukan nis siswa" name="nis"
                                class="form-control mb-2" value="<?= $editData['nis'] ?? '' ?>">

                            <label for="rayon">Rayon</label>
                            <input type="text" id="rayon" placeholder="masukan rayon siswa" name="rayon"
                                class="form-control mb-2" value="<?= $editData['rayon'] ?? '' ?>">

                            <div class="col mt-3">
                                <button class="btn btn-primary" type="submit" name="kirim">
                                    <i class='bx bx-plus'></i> <?= $editIndex != -1 ? 'Update' : 'Tambah' ?>
                                </button>
                                <button class="btn btn-danger" type="button" onclick="window.print()">
                                    <i class='bx bx-printer'></i> Print
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    <a href="destroy.php" style="color: white; text-decoration: none;">Reset</a>
                                </button>
                                <button class="btn btn-warning" type="submit" name="hapus_semua">
                                    <i class='bx bx-trash'></i> Hapus Semua
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (!empty($_SESSION['dataSiswa'])) {
        echo "<div class='container mt-3' id='printArea'><ul class='list-group'>";
        foreach ($_SESSION['dataSiswa'] as $key => $value) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo $value["nama"] . " - " . $value["nis"] . " - " . $value["rayon"];
            echo "<div>";
            echo "<a href='?edit=".$key."' class='btn btn-warning btn-sm me-2'>Edit</a>";
            echo "<a href='?hapus=".$key."' class='btn btn-danger btn-sm'>Hapus</a>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>