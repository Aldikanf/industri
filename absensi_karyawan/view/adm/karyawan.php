<h3 class='page-header'>Daftar Karyawan Allnowtech</h3>
<?php 
if (isset($_GET['st'])) {
        if ($_GET['st']==1) {
            echo "<div class='alert alert-warning'><strong>Berhasil Disimpan.</strong></div>";
        } elseif ($_GET['st']==2) {
            echo "<div class='alert alert-danger'><strong>Gagal Menyimpan.</strong></div>";
        } elseif ($_GET['st']==3) {
            echo "<div class='alert alert-success'><strong>Berhasil dihapus.</strong></div>";
        } elseif ($_GET['st']==4) {
            echo "<div class='alert alert-danger'><strong>Data tidak boleh kosong.</strong></div>";
        } elseif ($_GET['st']==5) {
            echo "<div class='alert alert-danger'><strong>Gagal dihapus.</strong></div>";
        }
    }
 ?>
    <div class='table-resfponsive'>
    <?php 
        if (isset($_GET['id_karyawan'])) {
            if ($_GET['id_karyawan']!=="") {
                $id_user=$_GET['id_karyawan'];
                include './view/adm/edit_karyawan.php';
            } else {
                header("location:karyawan");
            }
        } else {
$limit = 10;
$start = 1;
$slice = 9;
$self_server = "./karyawan";
$q = "SELECT * FROM detail_user ORDER BY id_user ASC";
$r = $conn->query($q);
$totalrows = $r->num_rows;

if(!isset($_GET['pn']) || !is_numeric($_GET['pn'])){
    $page = 1;
} else {
    $page = $_GET['pn'];
}

$numofpages = ceil($totalrows / $limit);
$limitvalue = $page * $limit - ($limit);

$q = "SELECT*FROM detail_user ORDER BY sklh_user ASC LIMIT $limitvalue, $limit";
//jika user nakal paging lebih dari data yg dimiliki
$cek_page = $conn->query($q);
if ($cek_page->num_rows != 0) {
    if ($r = $conn->query($q)) {
   
    if ($r->num_rows!==0) {
            echo "<table class='table table-striped' style='width:70%'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Divisi</th>
                            <th>Skill</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $query_karyawan = $conn->query($q);
                    $no=0;
                    while ($get_karyawan = $query_karyawan->fetch_assoc()) {
                        $id_karyawan = $get_karyawan['id_user'];
                        $name = $get_karyawan['name_user'];
                        $school = $get_karyawan['sklh_user'];
                        $no++;
                        echo "<tr>
                                <td>$no</td>
                                <td>$name</td>
                                <td><strong>$school</strong></td>
                                <td><a href='karyawan&id_karyawan=$id_karyawan' title='Edit $name'>Edit info</a> &bullet; <a style='cursor:pointer' onclick='hapusKaryawan($id_karyawan)' >Hapus Karyawan</a></td>
                            </tr>";
                    }
                   // $conn->close();
                    echo "</tbody></table>";
                       
                    } else {
                        echo "<hr />";
                    }

                } else {
                    echo "<div class='alert alert-danger'><strong>Terjadi kesalahan.</strong></div>";
                }
                
                $sql_cek_row = "SELECT*FROM detail_user";
                $q_cek = $conn->query($sql_cek_row);
                $hitung = $q_cek->num_rows;
                if ($hitung >= $limit) {
                    echo "<hr><ul class='pagination'>";
                   if($page!= 1){
                        $pageprev = $page - 1;
                        echo '<li><a href="'.$self_server.'&pn='.$pageprev.'"><<</a></li>';
                    }else{
                        echo "<li><a><<</a></li>";
                    }

                    if (($page + $slice) < $numofpages) {
                        $this_far = $page + $slice;
                    } else {
                        $this_far = $numofpages;
                    }

                    if (($start + $page) >= 10 && ($page - 10) > 0) {
                        $start = $page - 10;
                    }

                    for ($i = $start; $i <= $this_far; $i++){
                        if($i == $page){
                            echo "<li class='active'><a>".$i."</a></li> ";
                        }else{
                            echo '<li><a href="'.$self_server.'&pn='.$i.'">'.$i.'</a></li> ';
                        }
                    }

                    if(($totalrows - ($limit * $page)) > 0){
                        $pagenext = $page + 1;
                        echo '<li><a href="'.$self_server.'&pn='.$pagenext.'">>></a></li>';
                    }else{
                        echo "<li><li><a>>></a></li>";
                    }
                    echo "</ul>";
                }
            } else {
                echo "<div class='alert alert-danger'><strong>Tidak ada data untuk ditampilkan</strong></div>";
            }
        }
     ?>
</div>
<script src="lib/js/sweetalert2.min.js"></script> <link rel="stylesheet" type="text/css" href="lib/js/sweetalert2.css">
    <script>
        function hapusKaryawan(id_karyawan) {
            var id = id_karyawan;
            swal({
                title: 'Anda Yakin?',
                text: 'Semua data Karyawan akan dihapus!',type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                closeOnConfirm: true
            }, function() {
                    window.location.href="./model/proses.php?del_karyawan="+id;
                });
        }
    </script>
<!-- <script>
function confirmSubmit() {
    var msg;
    msg = "Apakah Anda Yakin Akan Menghapus Data ? ";
    var agree=confirm(msg);
    if (agree)
    return true ;
    else
    return false ;
}
</script> -->