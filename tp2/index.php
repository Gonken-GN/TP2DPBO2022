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
    if(isset($_GET['id_pengurus'])){
        $pengurus->getWherePengurus($_GET['id_pengurus']);
        (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult());
        $BidangDivisi->getWhereBidangDivisi($id_bidang);
        $jabatan = $BidangDivisi->getResult();
        $divisi->getWhereDivisi($jabatan['id_divisi']);
        $iddivisi = $divisi->getResult();
        $data .= "
        <div class='col-md-4'>
        <div class='card-columns' style='margin-top: 15px;'>
            <div class='card' style='place-items: center; align-items: center;justify-items: center;'>
            <a href='index.php?id_pengurus=". $id_pengurus ."'style='text-decoration: none; color: black;'>
                <img class='card-img-top' src='". $img ."' alt='Card image cap' style='width: 200px; height: 200px; object-fit: cover; margin-top: 15px;'>
                <div class='card-body'>
                    <h4 class='card-title' style='text-align: center; margin-bottom: 10px; text-decoration: none; color: black;'>". $nama ."</h4>
                    <h6 class='card-subtitle text-muted' style='text-align: center; margin-bottom: 10px; text-decoration: none; color: black;'>". $jabatan['jabatan'] ."</h6>
                    <p class='card-text p-y-1' style='text-align: center; margin-bottom: 10px; font-weight: bold; text-decoration: none; color: black;'>". $iddivisi["nama_divisi"] ."</p>
                    <button class='btn btn-danger' name='hapus' ><a href='pengurus.php?id_hapus=" . $id_pengurus . "' style='color: white; font-weight: bold; text-decoration: none'>Hapus</a></button>
                    <button class='btn btn-success' ><a href='pengurus.php?id_update=" . $id_pengurus .  "' style='color: white; font-weight: bold; text-decoration: none'>Update</a></button>
                </div>
                </a>
            </div>
        </div>
    </div>";
    
    }else{
        $pengurus->getPengurus();
        while (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult()) {
            $BidangDivisi->getWhereBidangDivisi($id_bidang);
            $jabatan = $BidangDivisi->getResult();
            $divisi->getWhereDivisi($jabatan['id_divisi']);
            $iddivisi = $divisi->getResult();
            $data .= "
            <div class='col-md-4'>
                <div class='card-columns' style='margin-top: 15px;'>
                    <div class='card' style='place-items: center; align-items: center;
                    justify-items: center;'>
                    <a href='index.php?id_pengurus=". $id_pengurus ."'style='text-decoration: none; color: black;'>
                        <img class='card-img-top' src='". $img ."' alt='Card image cap' style='width: 200px; height: 200px; object-fit: cover; margin-top: 15px;'>
                        <div class='card-body'>
                            <h4 class='card-title' style='text-align: center; margin-bottom: 10px; text-decoration: none; color: black;'>". $nama ."</h4>
                            <h6 class='card-subtitle text-muted' style='text-align: center; margin-bottom: 10px; text-decoration: none; color: black;'>". $jabatan['jabatan'] ."</h6>
                            <p class='card-text p-y-1' style='text-align: center; margin-bottom: 10px; font-weight: bold; text-decoration: none; color: black;'>". $iddivisi["nama_divisi"] ."</p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>";
        }
    }
    
    


$pengurus->close();
$BidangDivisi->close();
$divisi->close();
$tpl = new Template("templates/index.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
