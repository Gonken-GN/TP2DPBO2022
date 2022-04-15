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
if(isset($_GET['delete_key'])){
    echo "bebas"    ;
    $hapus_bidang_divisi = $BidangDivisi->getResult();
    $pengurus->getPengurus();
    while(list($id_pengurus, $nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult()){
        if($id_bidang == $_GET['delete_key']){
            $pengurus->deletePengurus($id_pengurus);
        }
    }
    $BidangDivisi->deleteBidangDivisi($_GET['delete_key']);
    
    header('location: bidang_divisi.php');
}
while(list($id_bidang, $jabatan, $id_divisi) = $BidangDivisi->getResult()){
    $divisi->getWhereDivisi($id_divisi);
    $nama_divisi = $divisi->getResult();
    $data .= "<tr>
    <td>". $no ." </td> 
    <td>". $jabatan."</td>
    <td>". $nama_divisi['nama_divisi']."</td>
    <td><button class='btn btn-danger' name='hapus'><a href='bidang_divisi.php?delete_key=$id_bidang' style='color: white; font-weight: bold; text-decoration: none'>Delete</a>&nbsp</button>
    <button class='btn btn-primary' ><a href='form_bidang_divisi.php?update_key=$id_bidang' style='color: white; font-weight: bold; text-decoration: none'>Update</a></button>
    
    </tr>";
    $no++;
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/bidang_divisi.html");
$tpl->replace("DATA_TABEL", $data);


$tpl->write();