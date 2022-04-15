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
$tpl = new Template("templates/submit_pengurus.html");
if(isset($_GET['id_hapus'])){
    $pengurus->deletePengurus($_GET['id_hapus']);
    header('location: index.php');
}
if(isset($_GET['id_update'])){
    $key = $_GET['id_update'];
    $pengurus->getWherePengurus($_GET['id_update']);
    list($id_pengurus, $nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult();
    $BidangDivisi->getBidangDivisi();
    while(list($id_bidang2, $jabatan, $id_divisi) = $BidangDivisi->getResult()){
        $divisi->getWhereDivisi($id_divisi);
        $namadivisi = $divisi->getResult();
        
        $data .= "<option value='".$id_bidang2."'"; 
        if($id_bidang == $id_bidang2){
            $data .= " selected='selected'";
        }
        $data .= ">" . $jabatan. " ". $namadivisi['nama_divisi'] . "</option>";
    }
    if(isset($_POST['submit'])){
        $nimPost = $_POST['nim'];
        $namaPost = $_POST['nama'];
        $semesterPost = $_POST['semester'];
        $id_bidangPost = $_POST['jabatan_divisi'];
        $img = $_FILES['img']['name']; 
        $tmp = $_FILES['img']['tmp_name'];
        $imgPost = "img/default.jpg";
        $path = "img/".$img;
        if(move_uploaded_file($tmp, $path)){
            $pengurus->updatePengurus($nimPost, $namaPost, $semesterPost, $id_bidangPost, $path, $key);
        }else{
            $pengurus->updatePengurus($nimPost, $namaPost, $semesterPost, $id_bidangPost, $imgPost, $key);
        }
        header('location: index.php');
    }
    
}
if(isset($_GET['id_submit'])){
    $nim = null;
    $nama = null;
    $semester = null;
    $BidangDivisi->getBidangDivisi();
    while(list($id_bidang2, $jabatan, $id_divisi) = $BidangDivisi->getResult()){
        $divisi->getWhereDivisi($id_divisi);
        $namadivisi = $divisi->getResult();
        $data .= "<option value='".$id_bidang2."'"; 
        $data .= ">" . $jabatan. " ". $namadivisi['nama_divisi'] ."</option>";
        
    }
    if(isset($_POST['submit'])){
        $nimPost = $_POST['nim'];
        $namaPost = $_POST['nama'];
        $semesterPost = $_POST['semester'];
        $id_bidangPost = $_POST['jabatan_divisi'];
        $img = $_FILES['img']['name']; 
        $tmp = $_FILES['img']['tmp_name'];
        $imgPost = "img/default.jpg";
        $path = "img/".$img;
        if(move_uploaded_file($tmp, $path)){
            $pengurus->addPengurus($nimPost, $namaPost, $semesterPost, $id_bidangPost, $path);
        }else{
            $pengurus->addPengurus($nimPost, $namaPost, $semesterPost, $id_bidangPost, $imgPost);
        }
        header('location: index.php');
    }
}

$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl->replace("DATA_NIM", $nim);
$tpl->replace("DATA_Nama", $nama);
$tpl->replace("DATA_Semester", $semester);
$tpl->replace("DATA_Jabatan", $data);

$tpl->write();