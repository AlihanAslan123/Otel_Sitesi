<?php
session_start();
include "baglanti.php";

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

    <!--NAVBAR ı koyuyurum-->
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
    
    
    <!-- Hakkımızda yazıları burda-->
    <div class="hakkimizda-bolumu">
        <div class="kapasite">
            <h1>Hakkımızda</h1>
            <p style="margin-bottom:50px;">Biz, misafirlerimize lüks ve konforu sunmayı ilke edinmiş bir oteliz. Müşteri memnuniyetini her şeyin önünde tutarak hizmet veriyoruz. Amacımız, her misafirimizin kendisini evinde gibi hissetmesini sağlamak.</p>

            <div class="hakkimizda-icerik">
                <div class="hakkimizda-metni">
                    <h2>Vizyonumuz</h2>
                    <p>Hedefimiz, her misafire unutulmaz bir deneyim yaşatarak sektördeki lider otel olma yolunda ilerlemektir. Konforlu odalarımız, zengin hizmet seçeneklerimiz ve güler yüzlü personelimizle her zaman yanınızdayız.</p>
                </div>
                <div class="hakkimizda-resim">
                    <img src="resim/otel-ic-1.jpg" alt="Otelimiz" />
                </div>
            </div>

            <div class="hakkimizda-icerik">
                <div class="hakkimizda-resim">
                    <img src="resim/otel-ic-2.jpg" alt="Otelimizin Bir Köşesi" />
                </div>
                <div class="hakkimizda-metni">
                    <h2>Misyonumuz</h2>
                    <p>Misafirlerimize en iyi hizmeti sunmak, kaliteyi her zaman ön planda tutarak, sektördeki tüm standartları aşmak için çalışıyoruz. Her detaya özen göstererek hizmet veriyor ve her ziyaretçimizi özel hissettirmek istiyoruz.</p>
                </div>
            </div>
        </div>
    </div>


     <!-- Yorumlar ve Form Bölümü -->
    <div class="yorumlar">
        <h2>Kullanıcılarımızın Yorumları</h2>
        
        <?php
        
        /* bu sorguda yorumlar tablosu ile kullanıcı tablosu inner join ile birleştirildi. aralarında ilişki var
        yorumlar tablosundaki kullaniciidye göre kullanıcı tablosundaki ilgili kişiyi buluyoruz.
        */
        $sql = "
        SELECT y.id, y.kullaniciid, y.yorum, y.tarih, k.kullaniciadi 
        FROM yorumlar y
        INNER JOIN kullanici k ON y.kullaniciid = k.kullaniciid
        ORDER BY y.tarih DESC";
        $result = mysqli_query($connection,$sql);

        if($result){
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='yorum'>";
                    echo "<p>" . $row['yorum'] . "</p>";
                    echo "<p><strong>" . " ( " . $row['kullaniciadi'] . " )</strong></p>";                
                    echo "<p><small>" . $row['tarih'] . "</small></p>";
                    echo "</div><br>";
                }
            } else {
                echo "<p>Henüz yorum yapılmamış.</p>";
            }
        }else{
            echo "<p>Sorgu hatası.</p>";
        }

        mysqli_close($connection);
        ?>

        <!-- Yorum Formu -->
        <h3>Yorumunuzu Bırakın</h3>
        <?php
        if (!isset($_SESSION['giris_yapildi'])) {
            echo "<p id='girissiz'>Yorum yapabilmek için giriş yapmalısınız.</p>";
        } else {
        ?>
        <form method="POST" action="hakkimizda.php">
            <label for="yorum">Yorum:</label><br>
            <textarea id="yorum" name="yorum" rows="4" cols="50" required></textarea><br><br>
            <button type="submit">Yorumu Gönder</button>
        </form>
        <?php } ?>
    </div>

        <!-- YORUM EKLEME İŞLEmi -->
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            include "baglanti.php";
            $yorum = htmlspecialchars($_POST["yorum"]); // özel html karakterleri girişini engelledim. 
            $kullaniciid = $_SESSION["kullaniciid"]; 
            $yorum_zamani = date("Y-m-d");

            // sql injectiona karşı belirli kontrollerle ekleme işlemini yaptım.
            
            if (!$veri = mysqli_prepare($connection, "INSERT INTO yorumlar (kullaniciid,yorum,tarih) values (?,?,?)")) {
                die("Sorgu hazırlama hatası: " . mysqli_error($connection));
            }
            mysqli_stmt_bind_param($veri,"sss",$kullaniciid,$yorum,$yorum_zamani);
            if(mysqli_stmt_execute($veri)){
                header("refresh:1;url=hakkimizda.php");
                exit();
            }else{
                echo mysqli_stmt_error($veri);
            }
            mysqli_stmt_close($veri);
            mysqli_close($connection);
        }
    ?>
    <br/><br/><br/><br/>
</body>
</html>