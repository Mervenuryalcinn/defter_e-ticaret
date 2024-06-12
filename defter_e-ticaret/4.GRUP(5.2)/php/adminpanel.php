<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link rel="icon" href="../image/favicon-96x96.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/webproje.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sb-admin.css">
  
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #ffe6f9;" >

<div style="background-color: #ffe6f9;" id="wrapper" >
    <!-- Sidebar -->
    <ul style=   "   background-color: hsl(315, 77%, 86%);" class="sidebar navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="adminpanel.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Admin</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="urunler.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Ürünler</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="kullanicilar.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Kullanıcılar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="admingiris.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Çıkış</span>
            </a>
        </li>
    </ul>

    <?php
     include('../inc/dbBaglan.php'); 
     
    // Veritabanından verileri çekme
    $sorgu = $conn->prepare("SELECT id, adminAdi FROM admin");
    $sorgu->execute();
    $sorgu->bind_result($id, $adminAdi);
    ?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Adminler</li>
            </ol>
            <a class="btn btn-primary" href="adminEkle.php">Yeni Admin Ekle</a> <br><br>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Adminler
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin Adı</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Admin Adı</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php while ($sorgu->fetch()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($id) ?></td>
                                    <td><?= htmlspecialchars($adminAdi) ?></td>
                                    <td><a class="btn btn" href="adminGüncelle.php?id=<?= htmlspecialchars($id) ?>"><span class="fa fa-edit fa-2x"></span></a></td>
                                    <td>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sil<?= htmlspecialchars($id) ?>"><span class="fa fa-trash fa-2x"></span></a>
                                        <!-- Silme Modal -->
                                        <div class="modal fade" id="sil<?= htmlspecialchars($id) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"><b><?= htmlspecialchars($adminAdi) ?></b> adlı kullanıcıyı silmek istediğinizden emin misiniz?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary pull-left mx-4" type="button" data-dismiss="modal">İptal</button>
                                                        <a class="btn btn-danger pull-right mx-4" href="adminsil.php?id=<?= htmlspecialchars($id) ?>">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#content-wrapper -->
</div>
<!-- /#wrapper -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
<?php
$sorgu->close();
$conn->close();
include('../inc/footer.php');
?>