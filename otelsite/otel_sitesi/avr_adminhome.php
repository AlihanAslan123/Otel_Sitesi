<?php
    session_start();
    if(!isset($_SESSION['admin_girisi'])){
        header("Location:index.php");
        die("<h1>404 Not Found</h1>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avrasya Otel</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="ustnavbar">
        <a href="logout.php" style="position:absolute; left:10px;top:5; "><button style="width:130x;height:32px;">Çıkış Yap</button></a>
        <h2> YÖNETİCİ PANELİ </h2>
    </div>

    <div class="fiyat">
        <h3>Fiyatlar</h3>
        <form action="avr_adminhome.php" method="post">
            <label>Tek kişilik oda fiyatı: </label>
            <input type="text" name="tek"><br><br>
            <label>Çift kişilik oda fiyatı: </label>
            <input type="text" name="cift"><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Kral dairesi fiyatı: </label>
            <input type="text" name="kral"><br><br>
            <button type="submit">Güncelle</button>
        </form>
    </div>

    <?php
        include "baglanti.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["tek"]) && isset($_POST["cift"]) && isset($_POST["kral"])){
                $fiyattek=trim($_POST["tek"]);
                $fiyatcift=trim($_POST["cift"]);
                $fiyatkral=trim($_POST["kral"]);
                $veri = mysqli_prepare($connection,"update fiyatlar set fiyati = CASE 
                WHEN oda_tipi = 'Tek Kişilik Oda' THEN ? 
                WHEN oda_tipi = 'Çift Kişilik Oda' THEN ?
                WHEN oda_tipi = 'Kral Dairesi' THEN ?
                ELSE fiyati
                END;
                ");
                mysqli_stmt_bind_param($veri,"sss",$fiyattek,$fiyatcift,$fiyatkral);
                if(mysqli_stmt_execute($veri)){
                    echo "<script>alert('FİYATLAR GÜNCELLENDİ');</script>";
                }else{
                    echo mysqli_error($connection);
                }
                mysqli_stmt_close($veri);
                mysqli_close($connection);
            }
        }
    ?>

    
    <div class="kullanici">
        <h3>Gönderilen Mesajlar</h3>
        <?php
            include "baglanti.php";
            $sorgu = mysqli_query($connection,"Select * from tbl_mesaj");
            if($sorgu){
                while($kayit=mysqli_fetch_assoc($sorgu)){
                    echo "<div class='msj'>";
                    echo "<span class='ism'>İsim: " . $kayit["isim"] . "</span>";
                    echo "<span class='mail'>Mail: " . $kayit["mail"] . "</span>";
                    echo "<span class='msj'>Mail: " . $kayit["mesaj"] . "</span>";
                    echo "<span class='sil'>
                    <form method='POST' action='avr_adminhome.php'>
                    <input type='hidden' name='id' value='".$kayit['id'].
                    "'><button type='submit'>Mesajı sil</button></form></span>";
                    echo "</div>";
                }
            }
        ?>
    </div>

    <?php
        // MESAJ SİLME
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["id"])){
                include "baglanti.php";
                $id = $_POST["id"];
                if(is_numeric($id)){
                    $sorgu = mysqli_query($connection,"DELETE FROM tbl_mesaj WHERE id = $id");
                    if($sorgu){
                        echo "<script>alert('Mesaj Silindi');</script>";
                        header("Location: avr_adminhome.php");
                        exit;
                    }else{
                        echo "<script>alert('".mysqli_error($connection)."');</script>";
                    }
                    mysqli_close($connection);
                }
            }
        }
    ?>



    <div class="kullanici">
        <h3>Siteye kayıtlı kullanıcı bilgileri</h3>
        <?php
            include "baglanti.php";
            $sorgu = mysqli_query($connection,"Select * from kullanici");
            if($sorgu){
                while($kayit=mysqli_fetch_assoc($sorgu)){
                    echo "<div class='kullanici_ic'>";
                    echo "<span class='adi'>İsim: " . $kayit["kullaniciadi"] . "</span>";
                    echo "<span class='mail'>Mail: " . $kayit["kullanicimail"] . "</span>";
                    echo "<form action='avr_adminhome.php' method='POST'>
                    <input type='hidden' name='kkid' value='".$kayit["kullaniciid"]."'>";
                    echo "<span class='sil'><button type='submit'>Kullanıcıyı sil</button></span></form>";
                    echo "</div>";
                }
            }else{
                echo "<h1>SORGU HATASI</h1>";
            }
        ?>
    </div>

    <?php
        // Kullanıcı SİLME
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["kkid"])){
                include "baglanti.php";
                $id = $_POST["kkid"];
                if(is_numeric($id)){
                    $sorgu = mysqli_query($connection,"DELETE FROM kullanici WHERE kullaniciid = $id");
                    if($sorgu){
                        echo "<script>alert('Kullanici Silindi');</script>";
                        header("Location: avr_adminhome.php");
                        exit;
                    }else{
                        echo "<script>alert('".mysqli_error($connection)."');</script>";
                    }
                    mysqli_close($connection);
                }
            }
        }
    ?>

    <div class="admrezervasyonlar">
        <?php
            include "baglanti.php";
            $s = mysqli_query($connection, "SELECT * FROM rezervasyonlar");
            if($s){                
                if(mysqli_num_rows($s)>0){
                    echo "<h2>Rezervasyonlar</h2>";
                    while($kayit=mysqli_fetch_assoc($s)){
                        echo "<div>";                        
                        echo "<p><strong>Adi:</strong> ".$kayit["isim"]."</p>";
                        echo "<p><strong>Telefonu:</strong> ".$kayit["telefon"]."</p>";
                        echo "<p><strong>Oda tipi:</strong> ".$kayit["oda_tipi"]."</p>";
                        echo "<p><strong>Giriş tarihi:</strong> ".$kayit["giris_tarihi"]."</p>";
                        echo "<p><strong>Çıkış tarihi:</strong> ".$kayit["cikis_tarihi"]."</p>";
                        echo "<form action='rzvsil.php' method='POST'>";
                        echo "<input name='cxz' type='hidden' value='".$kayit["id"]."'>";
                        echo "<button type='submit'>Sil</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                }else{
                    echo "<p>Kayıtlı Rezervasyon bulunmamaktadır.</p>";
                }

            }else{
                echo "<script>alert('Sorgu hatası');</script>";
            }
        ?>
    </div>


</body>
</html>