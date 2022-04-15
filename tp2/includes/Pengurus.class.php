<?php

class Pengurus extends DB
{
    function getPengurus(){
        $query = "SELECT * from pengurus";
        return $this->execute($query);
    }
    function getWherePengurus($id_pengurus){
        $query = "SELECT * from pengurus where id_pengurus = $id_pengurus";
        return $this->execute($query);
    }
    function addPengurus($nim, $nama, $semester, $idbidang, $img){
        $query = "INSERT INTO pengurus VALUES (NULL, $nim, '$nama', $semester, $idbidang, '$img')";
        return $this->execute($query);
    }
    function deletePengurus($id_pengurus){
        $query = "DELETE FROM pengurus WHERE id_pengurus='$id_pengurus'";
        return $this->execute($query);
    }
    function updatePengurus($nim, $nama, $semester, $idbidang, $img, $id_pengurus){
        $query = "UPDATE pengurus SET nim=$nim, nama='$nama', semester=$semester, id_bidang=$idbidang, img='$img' where id_pengurus='$id_pengurus'";
        return $this->execute($query);
    }
}
?>