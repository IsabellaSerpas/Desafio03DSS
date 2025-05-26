
<?php
require_once "../public/fpdf/fpdf.php";

class PDF extends FPDF {
    function Header() {
        $this->SetFont("Arial", "B", 16);
        $this->Cell(0, 10, "Reporte Trimestral de Asistencia y Disciplina", 0, 1, "C");
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont("Arial", "I", 10);
        $this->Cell(0, 10, "Pagina " . $this->PageNo(), 0, 0, "C");
    }
}
?>