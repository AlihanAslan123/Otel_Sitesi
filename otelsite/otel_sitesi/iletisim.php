<?php
session_start();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>İletişim</title>
</head>
<body>

    <div class="navbarust">
        <div id="navbar1">
            <div id="sol">
                <a href="https://www.instagram.com/" target="_blank"><img src="resim/instagram.png" width="30px"/></a>
            </div>
            <div id="sag">
                <a href="https://wa.me/9011111111111" target="_blank"><img src="resim/whatsapp.png" width="30px"></a>
                <span>E-MAIL: info@avrasyaotel.com | TEL:+1111111111</span>
            </div>
        </div>
        <div class="navbar">
            <span>AVRASYA OTELİ</span>
            <table><tr>
                <td><a href="index.php">Anasayfa</a></td>
                <td><a href="hakkimizda.php">Hakkımızda</a></td>
                <td><a href="iletisim.php">İletişim</a></td>
                <td><a href="rezervasyon.php">Rezervasyon</a></td>
                <td>
                    <?php
                        if(isset($_SESSION['kullaniciadi'])){
                            echo "<a href='logout.php' class='button' style='background-color:rgb(252, 33, 33)'>Çıkış Yap</a>";
                        }else{
                            echo "<a href='login.php' class='button'>Giriş Yap</a>";
                        }
                    ?>
                </td>
            </tr></table>
        </div>
    </div>


    <div class="iletisim-bilgileri">
        <div class="bilgi-ogesi">
            <h2 class="bilgi-baslik">Adres</h2>
            <p class="bilgi-metni">Avrasya Oteli, İstanbul, Türkiye</p>
        </div>

        <div class="bilgi-ogesi">
            <h2>Harita</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3032.6652894160177!2d28.98084021512927!3d41.02471617929274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cacd50b5c254cf%3A0x8d87a5cc7b2645a9!2zMTIzIM6Yb2xlaywgTnDDoWxvaywgI0lzdGFuYnVsLCBUdXJrZXkgMjAgMzk4OA!5e0!3m2!1str!2str!4v1642094726065!5m2!1str!2str" width="600" height="450" style="border:0;"></iframe>
        </div>

        <div class="bilgi-ogesi">
            <h2>İletişim Bilgileri</h2><br/><br/>
            <p><strong>Email:</strong> info@avrasyaotel.com</p><br/>
            <p><strong>Telefon:</strong> +1111111111</p>
        </div>
    </div>

    <div class="iletisim-formu">
        <h2 class="form-baslik">Bize Mesaj Gönderin</h2>
        <form action="iletisim.php" method="POST" class="mesaj-formu">
            <label class="lbl">Adınız:</label>
            <input type="text" id="isim" name="isim" class="txt" required>

            <label class="lbl">E-posta:</label>
            <input type="email" id="email" name="email" class="txt" required>

            <label class="lbl">Mesajınız:</label>
            <textarea id="mesaj" name="mesaj" rows="4" class="txt" required></textarea>

            <button type="submit" class="gonder-btn">Gönder</button>
        </form>
    </div>
    


    <div class="navbaralt">
        <div class="navbaraltaciklama">
            <div class="footer-email">
                <h4>Email</h4>
                <p>info@reotel.com</p>
            </div>
            <div class="footer-address">
                <h4>Adres</h4>
                <p>123 Örnek Sokak, İstanbul, Türkiye</p>
            </div>
            <div class="footer-map">
                <h4>Harita</h4>
                <!-- Google Maps iframe -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3032.6652894160177!2d28.98084021512927!3d41.02471617929274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cacd50b5c254cf%3A0x8d87a5cc7b2645a9!2zMTIzIM6Yb2xlaywgTnDDoWxvaywgI0lzdGFuYnVsLCBUdXJrZXkgMjAgMzk4OA!5e0!3m2!1str!2str!4v1642094726065!5m2!1str!2str" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <?php
        include "baglanti.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["isim"]) && isset($_POST["email"]) && isset($_POST["mesaj"]))
            {   
                // trim ile başlangıç ve bitişteki boşlukları kaldırıyoruz.
                $isim = htmlspecialchars(trim($_POST["isim"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $mesaj = htmlspecialchars(trim($_POST["mesaj"]));

                // sql injection için güvenli veri ekleme
                $veri = mysqli_prepare($connection,"INSERT INTO tbl_mesaj (mesaj,isim,mail) values (?,?,?)");
                mysqli_stmt_bind_param($veri,"sss",$mesaj,$isim,$email);
                if(mysqli_stmt_execute($veri)){
                    echo "<script>alert('MESAJINIZ BAŞARIYLA GÖNDERİLDİ');</script>";
                }
                mysqli_stmt_close($veri);
                mysqli_close($connection);
            }
        }

    ?>


</body>
</html>