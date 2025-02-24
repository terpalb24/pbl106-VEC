<?php 
    include "service/autoload.php";
    check_login();
    $id_user = $_SESSION['id_user'];
    $id_acara = $db->real_escape_string($_GET['id']);
    $acara_sql = "SELECT * FROM acara WHERE id_acara='$id_acara'";
    $group_sql = "SELECT * FROM `group` WHERE id_acara='$id_acara'";
    $result_acara = $db->query($acara_sql);
    $result_group = $db->query($group_sql);
    $data_acara = $result_acara->fetch_assoc();
    if ($data_acara['id_user'] !== $id_user) {
        header("location: dashboard");
        exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event | <?php echo htmlspecialchars($data_acara['nama_acara']); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/logo.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
        const table = $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ],
            ajax: {
                url: 'fetch_data.php?id=<?php echo $data_acara['id_acara']; ?>',
                type: 'GET',
                data: function(d) {
                    const selectedGroup = $('#inputGroupSelect01').val();
                    d.id_group = selectedGroup !== null ? selectedGroup : '';
                },
                dataSrc: ''
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'nama' },
                { data: 'nama_group' }
            ]
        });
        $('#submitFilter').on('click', function() {
            table.ajax.reload();
        });
        setInterval(() => {
            table.ajax.reload(null, false); 
        }, 10000);
    });
    </script>

    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
    <main>
    
        <div class="main-content">
            <article class="blog active" data-page="blog">
                <header>
                    <h2 class="h2 article-title"><?php echo htmlspecialchars($data_acara['nama_acara']); ?></h2>
                </header>
                <section class="about-text">
                    <p><?php echo htmlspecialchars($data_acara['deskripsi_acara']); ?></p>
                </section>

                <div class="wrapper">
                    <form action="acara.php?id=<?php echo $data_acara['id_acara']; ?>" method="POST">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Filter</label>
                            </div>
                            <select name="id_group" class="custom-select" id="inputGroupSelect01">
                                <option value="">ALL</option>
                                <?php
                                if ($result_group->num_rows > 0) {
                                    while ($data_group = $result_group->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $data_group['id_group']; ?>"><?php echo $data_group['nama_group']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <button id="submitFilter" name="filter" class="form-btn2" type="button" data-form-btn>
                                <ion-icon name="filter-outline"></ion-icon>
                                <span>Submit</span>
                            </button>
                            <button onclick="window.location.href='acara.php?id=<?php echo $data_acara['id_acara']; ?>'" type="reset" class="form-btn2" data-form-btn>
                                <ion-icon name="refresh-outline"></ion-icon>
                                <span>Reset</span>
                            </button>
                        </div>
                    </form>
                </div>

                <table id="myTable" class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Group</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Data di tampilkan dengan ajax -->
                    </tbody>
                </table>

                <div class="btnreg">
                    <p>Link Absent: <a href="absent.php?id=<?php echo $data_acara['id_acara']; ?>">https://vec.pbl.web.id/absent.php?id=<?php echo $data_acara['id_acara']; ?></a></p>
                    <input type="hidden" id="qrText" value="https://vec.pbl.id/absent.php?id=<?php echo $data_acara['id_acara']; ?>" />
                </div>
                <div id="imgBox">
                    <img src="" id="qrImage">
                    <button onclick="downloadQR()" class="form-btn" type="button" data-form-btn>
                        <span>Download QR</span>
                        <ion-icon name="download-outline"></ion-icon>
                    </button>
                </div>
                <div class="bungkus-button">
                    <button class="form-btn11" type="button" onclick="generateQR()" data-form-btn>
                        <ion-icon name="share-outline"></ion-icon>
                        <span>Generate QR</span>
                    </button>
                </div>
                <br>
                <button onclick="window.location.href='dashboard'" class="form-btn" type="button" data-form-btn>
                    <ion-icon name="arrow-back-outline"></ion-icon>
                    <span>BACK</span>
                </button>
            </article>
        </div>
    </main>
    <script>
        let imgBox = document.getElementById("imgBox");
        let qrImage = document.getElementById("qrImage");
        let qrText = document.getElementById("qrText");
        function generateQR() {
            if (qrText.value.length > 0) {
                qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + qrText.value;
                imgBox.classList.add("show-img");
            }
        }
        function downloadQR() {
            // Pastikan gambar QR code sudah dihasilkan
            if (qrImage.src) {
                // Buat link download sementara
                const link = document.createElement('a');
                link.href = qrImage.src+'&download=1';
                
                // Simulasikan klik pada link
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                Swal.fire({  
                    position: "top-end",  
                    icon: "error",  
                    toast: true,  
                    title: "Please create a QR code first",  
                    background: "#212529",  
                    showConfirmButton: false,  
                    timer: 1500  
                }); 
            }
        }
    </script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

    <!-- #link -->
    <?php include "layout/link.php" ?>
</body>
</html>