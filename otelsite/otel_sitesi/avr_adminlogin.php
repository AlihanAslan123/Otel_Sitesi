<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avrasya Otel</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<form action="avr_adminlogin.php" method="post">
    <div class="giris-kapsayi">
        <h2>Yönetici girişi</h2>
        <?php
            if (isset($_GET["hata"])){
                echo "<p class='hata'>"."Giriş Başarısız</p>";
            }
        ?>
        <form method="post">
            <div class="girdi-grubu">
                <label for="kullaniciAdi">Kullanıcı Adı:</label>
                <input type="text" id="kullaniciAdi" name="kullaniciAdi" required>
            </div>
            <div class="girdi-grubu">
                <label for="sifre">Şifre:</label>
                <input type="password" id="sifre" name="sifre" required>
            </div>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</form>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["kullaniciAdi"]) && isset($_POST["sifre"])) {
            $kullaniciadi = $_POST["kullaniciAdi"];
            $sifre = $_POST["sifre"];
        
            include "baglanti.php";
        
            $kullaniciadi = mysqli_escape_string($connection,$kullaniciadi);
            $sifre = mysqli_escape_string($connection,$sifre);
        
            $sorgu = "SELECT * FROM tbl_yonetici WHERE kullaniciadi = '$kullaniciadi'";
            $result = mysqli_query($connection,$sorgu);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    $user = mysqli_fetch_assoc($result);
        
                    //Sifre hashini doğrula
                    if(password_verify($sifre,$user["sifre"])){
                        $_SESSION['admin_girisi'] = " ";
                        mysqli_close($connection);
                        header("Location: avr_adminhome.php");
                        exit();
                    }
                }else{
                    mysqli_close($connection);
                    header("Location: avr_adminlogin.php?hata");
                    exit();
                }
            }
            else{
                header("Location: avr_adminlogin.php");
            }
        }
    }
?>


</body>
</html>