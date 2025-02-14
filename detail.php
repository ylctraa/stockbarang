<?php
require 'function.php';
require 'cek.php';


//Dapetin ID barang yang dipassing di halaman sebelumnya
$idbarang = $_GET['id']; //get id barang
//Get informasi barang berdasarkan database
$get = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);
//set variable
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

//cek ada gambar atau tidak
$gambar = $fetch['image']; //ambil gambar
if($gambar==null){
//jika tidak ada gambar
$img = 'No Photo';
}else{
//jika ada gambar
$img = '<img src="images/'.$gambar.'" class="zommable">';
}


//generate qr
$urlview = 'http://localhost/stokbarang/view.php?id='.$idbarang;
$qrcode = 'https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl='.$urlview.'&choe=UTF-8';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stok - Detail Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <style>
              .zommable{
                width: 350px;
                height: 350px;
              }
              .zommable:hover{
                transform: scale(1.5);
                transition: 0.3s ease;
              }
          </style>
    </head>
       <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Detail Barang</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                Stok Barang
                            </a>

                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Barang Masuk
                            </a>

                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding"></i></div>
                                Peminjaman Barang
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Kelola Admin
                            </a>

                           
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Detail Barang</h1>
                        <div class="card mb-4">
                            <div class="card-header">                                 
                               <h3><?=$namabarang;?></h3>
                               <?=$img;?>
                               <img src="<?=$qrcode;?>">
                            <div class="card-body">

                                </div>

                                <div class="row">
                                    <div class="col">Deskripsi</div>
                                    <div class="col">: <?=$deskripsi;?></div>
                                </div>
                                          
                              <div class="row">
                                    <div class="col">Stock</div>
                                    <div class="col">: <?=$stock;?></div>
                                </div>

                        <br><br><br>

                                <h3>Barang Masuk</h3>

                                <div class="table-responsive">

                                <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                    $ambildatamasuk = mysqli_query($conn, "select * from masuk where idbarang='$idbarang'");
                                        $i = 1;
                                    while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                        $tanggal = $fetch['tanggal'];
                                        $keterangan = $fetch['keterangan'];
                                        $quantity = $fetch['qty'];
                                    
                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>

                                        <?php
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        <br><br>
                      

                          <h3>Barang Keluar</h3>

                                <div class="table-responsive">

                                <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                    $ambildatakeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                        $i = 1;
                                    while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                        $tanggal = $fetch['tanggal'];
                                        $penerima = $fetch['penerima'];
                                        $quantity = $fetch['qty'];
                                    
                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>

                                        <?php
                                            };
                                        ?>
                                    </tbody>
                                </table>
                                </table>
                            </table>
                        </div>
                    </div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>



    <!-- The Modal -->
  <div class="modal fade" id="myModal">
     <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
         <input type="text" name="namabarang" class="form-control" placeholder = "Nama Barang  " required>
         <br>
         <input type="text" name="deskripsi"  class="form-control" placeholder = "Deskripsi Barang" required>
        <br>
        <input type="number" name="stok" class="form-control"  placeholder = "Stock" required>
        <br>
        <input type="file" name="file" class="form-control">
        <br>
         <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
        
        </div>
        </form>
        
      </div>
 </div>
  </div>
</html>
