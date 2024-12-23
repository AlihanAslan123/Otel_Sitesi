<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href = "style.css">
    <title>Avrasya Otel</title>
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


    
    <?php
        // eğer kullanıcı giriş yapmamışsa teşfik ediyoruz.
        if(!isset($_SESSION['kullaniciadi'])){
            echo "<p id='bilgilendirme'>***  &nbsp;Sitemize kayıt olarak indirimlerden haberdar olabilirsiniz.&nbsp; ***</p>";
        }


        if(!isset($_SESSION['odatek'])){
            // oda fiyatlarını çekiyoruz
            include "baglanti.php";
            $sorgu = mysqli_query($connection,"SELECT DISTINCT oda_tipi, fiyati FROM fiyatlar");
            if($sorgu){
                while($kayit=mysqli_fetch_assoc($sorgu)){
                    if($kayit["oda_tipi"] == "Tek Kişilik Oda"){
                        $_SESSION['odatek'] =$kayit["fiyati"];
                    }else if($kayit["oda_tipi"] == "Çift Kişilik Oda"){
                        $_SESSION['odacift'] =$kayit["fiyati"];
                    }else if($kayit["oda_tipi"] == "Kral Dairesi"){
                        $_SESSION['odakral'] =$kayit["fiyati"];
                    }
                }
            }else{
                echo mysqli_error($connection);
            }
            mysqli_close($connection);
        }
        
    ?>
    
    
    <div class="rzv">
        <div>
            <p id="odatip">Tek kişilik odamız</p>
            <img src="resim/otel2.jpg" width="60%">
            <p id="odatip">Fiyat: <?php echo $_SESSION['odatek']." TL"; ?></p>
        </div>
        <div>
            <p id="odatip">Çift kişilik odamız</p>
            <img src="resim/otel1.jpg" width="68%">
            <p id="odatip">Fiyat: <?php echo $_SESSION['odacift']." TL"; ?></p>
        </div>
        <div style="border: 3px dashed goldenrod;">
            <p id="odatip">Kral Dairesi</p>
            <img src="resim/kraldairesi.jpg" width="70%">
            <p id="odatip">Fiyat: <?php echo $_SESSION['odakral']." TL"; ?></p>
        </div>
    </div>

    <div class="rzv_form">
        <form action="rezervasyon.php" method="POST">
            <div>
                <label>Oda Tipi:</label>
                <select id="oda-tipi" name="oda-tipi">
                    <option value="Tek Kişilik Oda">Tek Kişilik Oda</option>
                    <option value="Çift Kişilik Oda">Çift Kişilik Oda</option>
                    <option value="Kral Dairesi">Kral Dairesi</option>
                </select>
            </div>
            <div class="form-grup">
                <label>Adınızı giriniz:</label>
                <input type="text" name="isim" required>
            </div>
            <div class="form-grup">
                <label>Telefon Numarası:</label>
                <input type="tel" name="telefon" required>
            </div>
            <div style="display:flex; align-items:center; justify-content:space-between;">
                <div>
                <label>Başlangıç tarihi:</label>
                <input type="date" id="baslangicd" name="baslangicd" required>
                </div><div>
                <label>Bitiş tarihi:</label>
                <input type="date" id="bitisd" name="bitisd" required></div>
            </div>

            <button type="submit">Odayı Tut</button>
        </form>
    </div>

    <!-- bitiş tarihi başlangıçtan önce seçilmesin diye yazılan bir script -->
    <script>
        document.getElementById("baslangicd").addEventListener("change", function() {

            var baslangicTarihi = new Date(this.value);
            
            var bitisTarihi = document.getElementById("bitisd");
            
            baslangicTarihi.setDate(baslangicTarihi.getDate() + 1);
        
            bitisTarihi.min = baslangicTarihi.toISOString().split('T')[0];
        });
    </script>



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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $Odatipi=$_POST["oda-tipi"];
            $telefon=$_POST["telefon"];
            $name = $_POST["isim"];
            $baslangicd = $_POST["baslangicd"];
            $bitisd = $_POST["bitisd"];

            $xxz = mysqli_prepare($connection,"INSERT INTO rezervasyonlar (isim, telefon, oda_tipi, giris_tarihi, cikis_tarihi) 
            VALUES (?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param($xxz,"sssss",$name,$telefon,$Odatipi,$baslangicd,$bitisd);

            if(mysqli_stmt_execute($xxz)){
                echo "<script>alert('İşlem başarılı');</script>";
            }else{
                echo mysqli_error($connection);
            }

            mysqli_close($connection);
            
        }
    
    ?>

    
</body>
</html>