<?php
include_once('../tcpdf/tcpdf.php');
include 'database.php';
$db = new Database();

$syllabus_id = 1;
$term = '';
//echo "SELECT * FROM `tbl_term_master` wHERE syllabus_id='".$syllabus_id."' AND status = 1";
$selctsyl=$db->select_sql("SELECT * FROM `tbl_term_master` wHERE syllabus_id='".$syllabus_id."' AND status = 1 ");
foreach($db->getResult() as $selctsyl){  

    $term .= '<ul style="list-style-type: none;" align="center"><li style="font-size:12px;">'.$selctsyl['term'].'</li></ul>';
}

$durm=0;
$durw=0;
$selctterms=$db->select_sql("SELECT * FROM `tbl_term_master` wHERE syllabus_id='".$syllabus_id."' AND status = 1 ");

foreach($db->getResult() as $rowselctterm){ 
    if($rowselctterm['duration_type']=='1'){
        $durm=$durm+$rowselctterm['duration'];
    }else{
        $durw=$durw+$rowselctterm['duration'];
        $durwmo=floor($durw/4);
        $durm=$durm+$durwmo;
        $durw1=$durw%4;
        $durw=$durw1;
    }
}


 $duration =  '<table align="left" width="100%" style="text-align:left;">
                 <tr>
                    <td colspan="2"><h5>(A) <u>DURATION</u></h5></td>
                </tr>
                <tr>
                  
                   <td>
                        <ul>
                            <li>'.'TOTAL DURATION -'. $durm .' MONTHS '.$durw.' WEEKS '.'</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</td>
                    <th>
                        <ul>
                            <li style="font-size:12px;">CLASSIFICATION OF DURATION</li>
                            <ul>'.
                               
                                    $selctterms=$db->select_sql("SELECT * FROM `tbl_term_master` where syllabus_id='".$syllabus_id."' AND status = 1 ");
                                foreach($db->getResult() as $rowselctterm1){ 
                                   // print_r($rowselctterm1);
                                    
                                    '<li style="font-size:12px;">'. $rowselctterm1['term'].' - '. $rowselctterm1['duration'].''. $b = echo  ($rowselctterm1['duration_type'] == 1) ? 'MONTHS' : 'WEEKS' .' </li>';
                                 } 
                            '</ul>
                        </ul>
                    </th>
                </tr>

                </table>';


 echo $duration;
 
 exit;

// create new PDF document

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       
        // Set font
        // $this->SetFont('helvetica', 'B', 20);
      
         //$this->Cell(0, 15, 'MDRAFM', 0, false, 'C', 0, '', 0, false, 'M', 'M');
         //$this->Cell(0, 7, 'MDRAFM ', 0, 1, 'C');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
       $this->SetY(-15);
        // Set font
       $this->SetFont('helvetica', 'I', 8);
        // Page number
       $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('Nicola Asuni');
$obj_pdf->SetTitle('TCPDF Example 003');
$obj_pdf->SetSubject('TCPDF Tutorial');
$obj_pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//$obj_pdf->SetCreator(PDF_CREATOR);

$obj_pdf->SetTitle("Syllabus");

$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);

$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$obj_pdf->SetDefaultMonospacedFont('helvetica');

//set margins
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 10);

$obj_pdf->AddPage();
// $obj_pdf->SetFillColor(100, 0,0,0);
// $obj_pdf->Cell(0, 7, 'MDRAFM ', 1, 1, 'C');
 
 
 //$obj_pdf->SetMargins(10, 0, 10, true);
// set some text to print
 $html = '<h2  align="center" >Syllabus For O.F.S Probationers</h2>';
 $obj_pdf->Ln(15.5);
 $obj_pdf->writeHTML($html,true, false, true, false, '');
 $obj_pdf->Ln(15.5);
 $html = '<div align="center"><img src="../images/logo-Copy.png" alt="test alt attribute"  width="100" height="130" border="0" /><div>';

 $obj_pdf->writeHTML($html,true, false, true, false, '');
 //$obj_pdf->AddPage();
 $obj_pdf->Ln(15.5);
 $obj_pdf->SetMargins(10, 10, 23, true);
 $obj_pdf->writeHTML($term,true, false, true, false, '');

 $obj_pdf->Ln(75.5);
 $obj_pdf->SetMargins(0, 10, 10, true);
 $obj_pdf->SetFont('helvetica', 'B', 13);
 $obj_pdf->Cell(0, 7, 'Madhusudan Das Regional Academy Of Financial Management', 0, 1, 'C');
 
 $obj_pdf->SetFont('helvetica', '', 13);
 $obj_pdf->Cell(0, 7, 'Chandrasekharpur,Bhubaneswar-23', 0, 1, 'C');

 $obj_pdf->SetFont('helvetica', '', 13);
 $obj_pdf->Cell(0, 7, 'Website - www.madhusudanacademy.odisha.gov.in', 0, 1, 'C');
 $obj_pdf->Cell(0, 7, 'Email - dirmdrafm.od@gov.in, mdrafm_orissa@redifmail.com ', 0, 1, 'C');
 $obj_pdf->Cell(0, 7, 'TeleFax - ( 0674 )-2300394 ', 0, 1, 'C');

 $obj_pdf->AddPage();
 $obj_pdf->SetFont('helvetica', 'B', 13);
 $obj_pdf->Cell(0, 7, 'Syllabus For O.F.S Probationers', 0, 1, 'C');

 $obj_pdf->Ln(15.5);
 $obj_pdf->SetX(15);
 //$obj_pdf->Cell(0, 7, '(A)DURATION', 0, 1,'');
 $obj_pdf->SetFont('helvetica', 'B', 12);
 $obj_pdf->writeHTML($duration,true, false, true, false, '');

//$obj_pdf->Output(__DIR__ .'/pdf/tour_report.pdf', 'F');  //save pdf
//$obj_pdf->Output('tour_report.pdf', 'D');
$obj_pdf->Output('tour_report.pdf', 'I');

?>
