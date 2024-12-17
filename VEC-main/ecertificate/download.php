<?php
    
    try {
        require("fpdf/fpdf.php");
        header('content-type: application/pdf');
        $id_peserta = $_GET['id_peserta'];
        $pdf = new FPDF();
        $pdf->SetTitle('Certificate');
        $pdf->AddPage('L','A5');
        $pdf->Image("certificate/$id_peserta.jpg", 0,0,210,148);
        ob_end_clean();
        $pdf->Output('I'); 
    }catch (exception $e) {
        var_dump($e->getMassage());
    }
   
?>