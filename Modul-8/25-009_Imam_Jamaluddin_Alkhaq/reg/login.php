<?php
session_start();
include '../config.php';

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: ../index.php");
    exit;
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $pesan = "Username dan password wajib diisi!";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['level'] == 1 || $row['level'] == 2) {
                $_SESSION['login']    = true;
                $_SESSION['id_user']  = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['nama']     = $row['nama'];
                $_SESSION['level']    = $row['level'];

                header("Location: ../index.php");
                exit;
            } else {
                $pesan = "Level user tidak diizinkan mengakses sistem ini.";
            }
        } else {
            $pesan = "Kombinasi username dan password salah.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5" style="max-width: 400px;">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Login Sistem Penjualan</h4>
            </div>
            <div class="card-body">
                <?php if ($pesan != ""): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($pesan); ?>
                </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter the username" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter the password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>