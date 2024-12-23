<?php
include "baglanti.php";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avrasya Otel</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="giris-kapsayi">
        <h2>Kayit OL</h2>
        <?php
            if(isset($_GET["hata"]) && $_GET["hata"] == 1){
                echo "<p class='hata'>Şifreler uyuşmuyor.";
            }
            if(isset($_GET["hata"]) && $_GET["hata"] == 2){
                echo "<p class='hata'>Kayıt sırasında hata !!";
            }
        ?>
        <form action="kayitol.php" method="post">
            <div class="girdi-grubu">
                <label for="kullaniciAdi">Kullanıcı Adı:</label>
                <input type="text" id="kullaniciAdi" name="kullaniciAdi" required><br/>
            </div>
            <div class="girdi-grubu">
                <label for="sifre">Şifre:</label>
                <input type="password" id="sifre" name="sifre" required><br/><br/>
                <label for="sifre">Şifre Tekrar:</label>
                <input type="password" id="sifre" name="sifre2" required><br/><br/>
                <label for="sifre">Mail:</label>
                <input type="email" id="email" name="email" required><br/>
            </div>
            <button type="submit">Kayit OL</button>
        </form>
        <p class="kayit-linki">
            Hesabınız var mı? <a href="login.php">Oturum Açın</a>
        </p>
    </div>
    </form><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <?php
        if(isset($_POST["kullaniciAdi"]) && isset($_POST["sifre"]) && isset($_POST["sifre2"]) && isset($_POST["email"])){
            if($_POST["sifre"] != $_POST["sifre2"]){
                header("Location: kayitol.php?hata=1");
            }
            else
            {
                $kullaniciadi = $_POST["kullaniciAdi"];
                $sifre = $_POST["sifre"];
                $hashli_sifre = password_hash($sifre,PASSWORD_BCRYPT); // bcrypt algoritması ile veriyi hashliyorum.
                $email = $_POST["email"];
                // sql injectiona karşı prepared statements koruması
                $xxx = mysqli_prepare($connection,"INSERT INTO kullanici (kullaniciadi,sifre,kullanicimail) values (?,?,?)");
                mysqli_stmt_bind_param($xxx,"sss",$kullaniciadi,$hashli_sifre,$email);
                if(mysqli_stmt_execute($xxx)){
                    echo "<script>alert('Ekleme başarılı');</script>";
                    header("Location: login.php");
                }else{
                    header("Location: kayitol.php?hata=2");
                }
                mysqli_stmt_close($xxx);
            }
        }
        mysqli_close($connection);
    ?>
</body>
</html>
