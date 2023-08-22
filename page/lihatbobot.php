<?php
$listWeight=array(
    array("nama"=>"0 - Sangat Rendah","nilai"=>0),
    array("nama"=>"0.25 - Rendah","nilai"=>0.25),
    array("nama"=>"0.5 - Tengah","nilai"=>0.5),
    array("nama"=>"0.75 - Tinggi","nilai"=>0.75),
    array("nama"=>"1 - Sangat Tinggi","nilai"=>1),
);
$id=htmlspecialchars(@$_GET['id']);
$querylihat="SELECT id_jenisbarang,bobot,id_bobotkriteria,id_kriteria,kriteria.namaKriteria AS namaKriteria FROM bobot_kriteria INNER JOIN kriteria USING(id_kriteria) WHERE id_jenisbarang='$id'";
$execute2=$konek->query($querylihat);
if ($execute2->num_rows == 0){
    header('location:./?page=bobot');
}
?>
<!-- judul -->
<div class="panel-top">
    <b class="text-green">Detail data</b>
</div>
<form>
    <div class="panel-middle">
        <div class="group-input">
            <?php
            $query="SELECT namaBarang FROM jenis_barang WHERE id_jenisbarang='$id'";
            $execute=$konek->query($query);
            $data=$execute->fetch_array(MYSQLI_ASSOC);
            ?>
            <div class="group-input">
                <label for="jenisbarang">Jenis Barang</label>
                <input class="form-custom" value="<?php echo $data['namaBarang'];?>" disabled type="text" autocomplete="off" required name="jenisbarang" id="jenisbarang" placeholder="jenisbarang">
            </div>
        </div>
        <?php
        $execute2=$konek->query($querylihat);
        while($data=$execute2->fetch_array(MYSQLI_ASSOC)){
            echo "<div class=\"group-input\">
                    <label for=\"$data[namaKriteria]\">$data[namaKriteria]</label>
                    <input type='hidden' value=\"$data[id_bobotkriteria]\" name=\"id[]\">
                    <select class=\"form-custom\" disabled required name=\"bobot[]\" id=\"$data[namaKriteria]\">";
                $query3="SELECT id_nilaikriteria,keterangan,nilai FROM nilai_kriteria WHERE id_kriteria='$data[id_kriteria]'";
                $execute3=$konek->query($query3);
                    if ($execute3->num_rows > 0){
                        while ($data3=$execute3->fetch_array(MYSQLI_ASSOC)){
                            // foreach ($listWeight as $key) {
                                if ($data3['nilai']==$data['bobot']) {
                                    $selected="selected";
                                }else{
                                    $selected=null;
                                }
                                echo "<option $selected value=\"$data3[nilai]\">$data3[nilai] ($data3[keterangan])</option>";
                            // }
                        }
                    }
            echo "</select>
            </div>
                ";
        }
        ?>
    </div>
    <div class="panel-bottom">
    </div>
</form>