<?php

class Bidang_Divisi extends DB
{
    function getBidangDivisi()
    {
        $query = "SELECT * FROM bidang_divisi";
        return $this->execute($query);
    }
    function getWhereBidangDivisi($id_bidang){
        $query = "SELECT * FROM bidang_divisi where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function deleteBidangDivisi($id_bidang){
        $query = "DELETE FROM bidang_divisi where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function updateBidangDivisi($id_bidang, $jabatan, $id_divisi){
        $query = "UPDATE bidang_divisi SET jabatan='$jabatan', id_divisi=$id_divisi where id_bidang = $id_bidang";
        return $this->execute($query);
    }
    function addBidangDivisi($jabatan, $id_divisi){
        $query = "INSERT INTO bidang_divisi VALUES (NULL,'$jabatan',$id_divisi)";
        return $this->execute($query);
    }   
}
?>