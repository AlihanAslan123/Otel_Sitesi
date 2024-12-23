<?php
session_start();
// kontrol php
if (isset($_POST["kullaniciAdi"]) && isset($_POST["sifre"])) {
    $kullaniciadi = htmlspecialchars($_POST["kullaniciAdi"]); // htmlspecialchars:html girişlerine karşı önlem alır. xss önlem 
    $sifre = htmlspecialchars($_POST["sifre"]);

    include "baglanti.php";

    $kullaniciadi = mysqli_escape_string($connection,$kullaniciadi);
    $sifre = mysqli_escape_string($connection,$sifre);

    $sorgu = "SELECT * FROM kullanici WHERE kullaniciadi = '$kullaniciadi'";
    $result = mysqli_query($connection,$sorgu);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result);    

            //Sifre hashini doğrula
            if(password_verify($sifre,$user["sifre"])){
                $_SESSION['giris_yapildi'] = " ";
                $_SESSION['kullaniciid'] = $user["kullaniciid"];
                $_SESSION['kullaniciadi'] = $user["kullaniciadi"];
                $_SESSION['kullanicimail'] = $user["kullanicimail"];
                mysqli_close($connection);
                header("Location: index.php");
                exit();
            }
        }else{
            mysqli_close($connection);
            header("Location: login.php?hata");
            exit();
        }
    }
    else{
        header("Location: index.php");
    }
}

?>