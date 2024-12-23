<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["cxz"])){
        include "baglanti.php";
        $id = $_POST["cxz"];
        $sorgu = mysqli_query($connection,"DELETE FROM rezervasyonlar where id=$id");
        if($sorgu){
            header("Location: avr_adminhome.php");
        }else{
            echo "<h2>SORGU HATASI</h2>";
        }
        mysqli_close($connection);
    }
}

?>