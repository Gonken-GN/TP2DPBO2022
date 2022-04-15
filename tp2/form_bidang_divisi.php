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
$BidangDivisi->getBidangDivisi();
if(isset($_GET['update_key'])){
    $key = $_GET['update_key'];
    $BidangDivisi->getWhereBidangDivisi($key);
    list($id_bidang, $jabatan, $id_divisi) = $BidangDivisi->getResult();
    $divisi->getDivisi();
    while(list($id_divisi2, $nama_divisi) = $divisi->getResult()){
        $data .= "<option value='".$id_divisi2."'"; 
        if($id_divisi == $id_divisi2){
            $data .= " selected='selected'";
        }
        $data .= ">". $nama_divisi. "</option>";
    }
    if(isset($_POST['submit'])){
        
        $jabatan_post = $_POST['jabatan'];
        $id_divisi_post = $_POST['id_divisi'];
        $BidangDivisi->updateBidangDivisi($key, $jabatan_post, $id_divisi_post);
        header('location: bidang_divisi.php');
    }
}else if(isset($_GET['id_add_divisi'])){
    echo "Submit Pos Add Recod";
    $jabatan = null;
    $divisi->getDivisi();
    while(list($id_divisi2, $nama_divisi) = $divisi->getResult()){
        $data .= "<option value='".$id_divisi2."'"; 
        $data .= ">". $nama_divisi. "</option>";
    }
    if(isset($_POST['submit'])){
        
        $jabatan_post = $_POST['jabatan'];
        $id_divisi_post = $_POST['id_divisi'];
        echo "==========".$jabatan_post. $id_divisi_post;
        $BidangDivisi->addBidangDivisi($jabatan_post, $id_divisi_post);
        header('location: bidang_divisi.php');
    }
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/bidang_divisi_form.html");
$tpl->replace("DATA_Jabatan", $jabatan);
$tpl->replace("DATA_Divisi", $data);
$tpl->write();