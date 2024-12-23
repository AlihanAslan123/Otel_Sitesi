<?php
session_start();

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <form action="kontrol.php" method="post">
    <div class="giris-kapsayi">
        <h2>Giriş Yap</h2>
        <?php
            if (isset($_GET["hata"])){
                echo "<p class='hata'>"."Giriş Başarısız</p>";
            }
        ?>
        <form method="post" action="kontrol.php">
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
        <p class="kayit-linki">
            Hesabınız yok mu? <a href="kayitol.php">Kayıt Olun</a>
        </p>
    </div>
    </form>
</body>
</html>
