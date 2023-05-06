<h3 class='page-header'>Detail Absensi Karyawan Allnowtech</h3>
	<div class='table-responsive'>
	<?php 
		if (isset($_GET['id_karyawan'])) {
			if ($_GET['id_karyawan']!=="") {
				$id_user=$_GET['id_karyawan'];
				include './view/detail_absen.php';
			} else {
				header("location:absensi");
			}
		} else {
			$sql = "SELECT*FROM detail_user ORDER BY sklh_user ASC";
			$query = $conn->query($sql);
			if ($query->num_rows!==0) {
				echo "<table class='table table-striped' style='width:50%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Karyawan</th>
							<th>Divis</th>
							<th>Skill</th>
						</tr>
					</thead>
					<tbody>";
				$no=0;
				while ($get_karyawan = $query->fetch_assoc()) {
					$id_karyawan = $get_karyawan['id_user'];
					$name = $get_karyawan['name_user'];
					$school = $get_karyawan['sklh_user'];
					$no++;
					echo "<tr>
							<td>$no</td>
							<td>$name</td>
							<td>$school</td>
							<td><a href='absensi&id_karyawan=$id_karyawan' title='Absensi $name'>Lihat Absensi</a></td>
						</tr>";
				}
				echo "</tbody></table>";
				$conn->close();
			} else {
				echo "<div class='alert alert-danger'><strong>Tidak ada Karyawan untuk ditampilkan</strong></div>";
			}
		}
	 ?>
</div>