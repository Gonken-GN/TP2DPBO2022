<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");
include("includes/Bidang_divisi.class.php");
include("includes/pengurus.class.php");

$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$BidangDivisi = new Bidang_Divisi($db_host, $db_user, $db_pass, $db_name);
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
$BidangDivisi->open();
$divisi->open();
$data = null;
$no = 1;
$divisi->getDivisi();
if(isset($_GET['update_key_divisi'])){
    $key = $_GET['update_key_divisi'];
    $divisi->getWhereDivisi($key);
    list($id_bidang, $nama_divisi) = $divisi->getResult();
    if(isset($_POST['submit'])){
        
        $nama_divisi_post = $_POST['nama_divisi'];
        $divisi->updateDivisi($key, $nama_divisi_post);
        header('location: divisi.php');
    }
}else if(isset($_GET['id_add_divisi'])){
    echo "Submit Pos Add Recod";
    $nama_divisi = null;
    $divisi->getDivisi();
    
    if(isset($_POST['submit'])){
        
        $nama_divisi_post = $_POST['nama_divisi'];
        $divisi->addDivisi($nama_divisi_post);
        header('location: divisi.php');
    }
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/divisi_form.html");
$tpl->replace("DATA_Nama_divisi", $nama_divisi);
$tpl->write();