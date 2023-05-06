<h3 class='page-header'>Catatan Kegiatan Karyawan Allnowtech</h3>
	<div class='table-responsive'>
	<?php 
		if (isset($_GET['id_karyawan'])) {
			if ($_GET['id_karyawan']!=="") {
				$id_user=$_GET['id_karyawan'];
				include './view/note.php';
			} else {
				header("location:catatan");
			}
		} else {
			$sql = "SELECT*FROM detail_user ORDER BY sklh_user ASC";
			if ($conn->query($sql)->num_rows!==0) {
				echo "<table class='table table-striped' style='width:50%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Karyawan</th>
							<th>Divisi</th>
							<th>Skill</th>
						</tr>
					</thead>
					<tbody>";
				$query_karyawan = $conn->query($sql);
				$no=0;
				while ($get_karyawan = $query_karyawan->fetch_assoc()) {
					$id_karyawan= $get_karyawan['id_user'];
					$name = $get_karyawan['name_user'];
					$school = $get_karyawan['sklh_user'];
					$no++;
					echo "<tr>
							<td>$no</td>
							<td>$name</td>
							<td>$school</td>
							<td><a href='catatan&id_karyawan=$id_karyawan' title='Catatan $name'>Lihat Catatan</a></td>
						</tr>";
				}
				$conn->close();
				echo "</tbody></table>";
			} else {
				echo "<div class='alert alert-danger'><strong>Tidak ada Karyawan untuk ditampilkan</strong></div>";
			}
		}
	 ?>
</div>