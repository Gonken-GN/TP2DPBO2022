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
if(isset($_GET['delete_key_divisi'])){
    echo "bebas"    ;
    $hapus_divisi = $divisi->getResult();
    $BidangDivisi->getBidangDivisi();
    while(list($id_bidang, $jabatan, $id_divisi2) = $BidangDivisi->getResult()){
        if($id_divisi2 == $_GET['delete_key_divisi']){
            $pengurus->getPengurus();
            while(list($id_pengurus, $nim, $nama, $semester, $id_bidang2, $img) = $pengurus->getResult()){
                if($id_bidang == $id_bidang2){
                    $pengurus->deletePengurus($id_pengurus);
                }
            }
            $BidangDivisi->deleteBidangDivisi($id_bidang);
        }
    }
    $divisi->deleteDivisi($_GET['delete_key_divisi']);
    
    header('location: bidang_divisi.php');
}
while(list($id_divisi, $nama_divisi) = $divisi->getResult()){
    $data .= "<tr>
    <td>". $no ." </td> 
    <td>". $nama_divisi."</td>
    <td><button class='btn btn-danger' name='hapus'><a href='divisi.php?delete_key_divisi=$id_divisi' style='color: white; font-weight: bold; text-decoration: none'>Delete</a>&nbsp</button>
    <button class='btn btn-primary' ><a href='form_divisi.php?update_key_divisi=$id_divisi' style='color: white; font-weight: bold; text-decoration: none'>Update</a></button>
    
    </tr>";
    $no++;
}
$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DATA_TABEL", $data);


$tpl->write();