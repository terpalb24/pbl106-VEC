<?php
include "service/autoload.php";
check_login();
$id_user = $_SESSION['id_user'];
$id_acara = $db->real_escape_string($_GET['id']);

$absent_sql = "SELECT DISTINCT `peserta`.id_peserta, `peserta`.id_acara, `peserta`.id_group, `peserta`.nama, `group`.nama_group FROM `peserta` JOIN `group` ON `peserta`.`id_group` = `group`.`id_group` WHERE `peserta`.`id_acara` = $id_acara";

if (!empty($_GET['id_group'])) {
    $id_group = $db->real_escape_string($_GET['id_group']);
    $absent_sql .= " AND `peserta`.`id_group`='$id_group'";
}

$result_absent = $db->query($absent_sql);
$data = [];

if ($result_absent && $result_absent->num_rows > 0) {
    while ($row = $result_absent->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>