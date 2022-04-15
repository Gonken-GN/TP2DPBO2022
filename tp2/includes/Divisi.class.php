<?php

class Divisi extends DB
{
    function getDivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }
    function getWhereDivisi($id_divisi){
        $query = "SELECT * FROM divisi where id_divisi = $id_divisi";
        return $this->execute($query);
    }
    function addDivisi($nama_divisi){
        $query = "INSERT INTO divisi VALUES(NULL, '$nama_divisi')";
        return $this->execute($query);
    }
    function deleteDivisi($id_divisi){
        $query = "DELETE FROM divisi where id_divisi = $id_divisi";
        return $this->execute($query);
    }
    function updateDivisi($id_divisi, $nama_divisi){
        $query = "UPDATE divisi set nama_divisi='$nama_divisi' where id_divisi=$id_divisi";
        return $this->execute($query);
    }
}
?>