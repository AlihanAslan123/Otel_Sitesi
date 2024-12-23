<?php
session_start();
?>
<!DOCTYPE html>
<html lang="TR-tr">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, inital-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Avrasya Oteli</title>
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
    <div class="hosgeldinust">
        <div class="hhos">
            <h1>Rüya Gibi Bir Konaklama Deneyimi</h1>
            <p>Boğaza yakın otelimizde, konfor ve lüksü bir arada yaşayın. Misafirlerimize eşsiz bir deneyim sunmak için buradayız.</p>
            <div class="btnhos">
                <button class="btn1" onclick="window.location.href='rezervasyon.php'">Rezervasyon Yap</button>
                <button class="btn2" onclick="window.location.href='hakkimizda.php'">Oteli Keşfet</button>
            </div>
        </div>
        <div class="resmh">
            <img src="resim/kopru2.jpg" alt="Lüks Otel Odası">
        </div>
    </div>
    <div class="middle">
        <h1>HİZMETLERİMİZ</h1>
        <div class="mdl">
            <div class="item">
                <img src="resim/wifi.png" alt="Sınırsız İnternet">
                <p>Sınırsız internet</p>
            </div>
            <div class="item">
                <img src="resim/7-24.png" alt="7/24 Hizmet">
                <p>7/24 Hizmet</p>
            </div>
            <div class="item">
                <img src="resim/araba.png" alt="Otopark Hizmeti">
                <p>Otopark Hizmeti</p>
            </div>
            <div class="item">
                <img src="resim/tv.png" alt="TV Hizmeti">
                <p>TV Hizmeti</p>
            </div>
            <div class="item">
                <img src="resim/transfer.png" alt="Havalimanı Transferi">
                <p>Havalimanı transferi</p>
            </div>
            <div class="item">
                <img src="resim/spa.png" alt="Spa Masajı">
                <p>Spa masajı</p>
            </div>
        </div>
    </div>

    
    <div class="rsmm">
        <div class="middle2">
            <img src="resim/oda1.jpg" alt="Resim 1">
            <img src="resim/oda2.jpg" alt="Resim 2">
            <img src="resim/otel1.jpg" alt="Resim 3">
            <img src="resim/restorant.jpg" alt="Resim 4">
            <img src="resim/kahvalti.jpg" alt="Resim 5">
            <img src="resim/restorant.jpg" alt="Resim 6">
        </div>
    
        <div class="about-us">
            <div class="about-us-content">
                <h2>Biz Kimiz?</h2>
                <p><i>Otelimiz, lüks ve konforu bir araya getirerek misafirlerimize unutulmaz bir deneyim sunmaktadır. Eşsiz şehir manzarası, modern tasarımı, ve güler yüzlü personeliyle her ziyaretçi kendini evinde hissedecek. Sunduğumuz imkanlarla tatilinizi ve iş seyahatinizi daha keyifli hale getiriyoruz. Size özel bir deneyim için biz buradayız.</i></p>
            </div>
        </div>
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

    
    </body>
</html>