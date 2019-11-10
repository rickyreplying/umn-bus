<?php
require 'koneksi.php';
require 'components/header.php';
?>

<body>
    <div class="container">
        <div class="alert alert-success">
            <strong>Ini tiket kamu...</strong> semoga perjalananmu menyenangkans :)
        </div>
    </div>
    <?php
    require 'db-init.php';
    $userID = $_SESSION['penggunaID'];
    $bid = $_GET['bis'];
    $seat = $_GET['seat'];
    $sql_instance = "SELECT * FROM tiket JOIN rute ON tiket.ruteID = rute.ruteID WHERE penggunaID=" . $userID . " AND busID=" . $bid . " AND noKursi=" . $seat . ";";
    $result = $koneksi->query($sql_instance);
    $row = $result->fetch_assoc();
    $qr_pass = '<<RINCIAN TIKET>>
    <Journey Date - ' . $row['tglBerangkat'] . '>
    <Route ID - ' . $row['ruteID'] . '><Seat Number - ' . $row['noKursi'] . '>
    <Passenger ID - ' . $row['penggunaID'] . '>
    <<Semoga Selamat Sampai Tujuan!>>';
    echo '<center><div class="container-fluid">
					<div class="card bg-info text-white" style="width:30%">
						<br><br>
						<center><img class="card-img-top" src="qr_gen.php?id=' . $qr_pass . '" alt="Card image"><center>
					  <div class="card-body">
					    <center><h3 class="card-title">BusKaro Digital Ticket</h3>
					    <h4 class="card-text">Journey Date - ' . $row['tglBerangkat'] . '</h4>
							<h4 class="card-text">Route ID - ' . $row['ruteID'] . ' </h4>
							<h4 class="card-text">Departure at - <strong> ' . $row['wktBerangkat'] . ' </strong>  from <strong> ' . $row['asal'] . ' </strong></h4>
							<h4 class="card-text">Arrival at - <strong> ' . $row['wktTiba'] . ' </strong>  near <strong> ' . $row['tujuan'] . ' </strong></h4>
							<h4 class="card-text">Seat Number - <strong> ' . $row['noKursi'] . ' </strong></h4>
							<h4 class="card-text">Passenger ID - ' . $row['penggunaID'] . ' </h4>
							<br><br>
					  </div>
					</div>
				</div></center>'

    ?>
</body>