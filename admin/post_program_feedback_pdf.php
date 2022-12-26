<?php 
// Include the main TCPDF library (search for installation path).
include_once('../tcpdf/tcpdf.php');
include 'database.php';
$db = new Database();
$program_id = $_POST['program_id'];
$tour_id = $_POST['tour_id'];
$prog_id = '';
$prog_table = '';
$select_query = '';

if($program_id ==1){
    $prog_table = 'tbl_new_recruite';
    $select_query = " CONCAT(t.f_name,'',t.l_name) as name,f.suggestion,f.id ";
    if($tour_id ==0){
        $prog_id =  $program_id;
    }else{
        $prog_id = $tour_id;
    }
}else{
    $prog_id = $program_id;
    $prog_table = 'tbl_mid_trainee_registration';
    $select_query = 't.name,f.suggestion,f.id';
}

$traning_type = $_POST['traning_type'];
$prog_name = $_POST['prog_name'];
//$prg_name = '';
$suggestion = '';
$sugst = '';

$count = 0;
     
    //$db->select('tbl_post_trng_feedback','t.name,f.suggestion',' f JOIN `tbl_mid_trainee_registration` t ON f.username=t.phone',null,null,null);
    $db->select('tbl_post_trng_feedback',$select_query,' f JOIN '.$prog_table.' t ON f.username=t.phone',null,null,null);
                      
   $res = $db->getResult();

     foreach($res as $suggest){
         //print_r( $feedback);
        $count++;
    $sugst .= '<tr>
      <td style="border: 1px solid black;width:10%">'.$count.'</td>
      <td  style="border: 1px solid black;width:30%">'.$suggest["name"].'</td>
     <td style="border: 1px solid black;width:60%">'. $suggest["suggestion"].'</td>
    </tr>';



     }

     $suggestion =  '<table align="left" width="100%" style="text-align:left;border: 1px solid black;">
                <thead style="font-size: 10px;background-color: rgb(59 67 84);color: #fff;">

                <tr style="border: 1px solid black;" >
                    <th  style="border: 1px solid black; width:10%">Sl No</th>
                    <th  style="border: 1px solid black; width:30%">Name </th>
                    <th  style="border: 1px solid black;width:60%">Suggestions</th>
                    
                </tr>
                </thead>
                <tbody>'
                .$sugst.
                '</tbody>

                </table>';

//echo $suggestion;exit;
class MYPDF extends TCPDF {
    
    public function LoadData() {
       
        $db = new Database();
        $program_id = $_POST['program_id'];
        $data = array();
        $traning_type = $_POST['traning_type'];
        $db->select('tbl_feedback_master','*',null,null,null,null);
            foreach($db->getResult() as $row1){
               
                $sql = "SELECT m.id,m.feedback as name,AVG(d.feedback) as avrage FROM `tbl_post_trng_feedback` p 
                LEFT JOIN `tbl_post_trng_feedback_data` d ON p.id = d.post_feedback_id
                JOIN `tbl_feedback_master` m ON d.feedback_name_id = m.id WHERE p.program_id = '".$program_id."' AND 
                p.trng_type = '".$traning_type."' AND m.feedback = '".$row1['feedback']."' ";
            
            $db->select_sql($sql);
            $res2 = $db->getResult();
            $data[]=$res2;

                
            }
       
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(237, 239, 240);
        $this->SetTextColor(0, 0, 0 );
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B',15);
        // Header
        $w = array(20, 110, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        //print_r($data);
        foreach($data as $row) {
           
            foreach($row as $row_data){
               // print_r($row_data);
                $this->Cell($w[0], 11, $row_data['id'], 1, 0, 'C', $fill);
            $this->Cell($w[1], 11, $row_data['name'], 1, 0, 'L', $fill);
            $this->Cell($w[2], 11, number_format((float)$row_data['avrage'], 1, ".", "") , 1, 0, 'C', $fill);
           
            $this->Ln();
            $fill=!$fill;
            }
            
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}


$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$data = $obj_pdf->LoadData();
// print_r($data);exit;
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('Nicola Asuni');
$obj_pdf->SetTitle('TCPDF Example 003');
$obj_pdf->SetSubject('TCPDF Tutorial');
$obj_pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//$obj_pdf->SetCreator(PDF_CREATOR);

$obj_pdf->SetTitle("Feedback");

// $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);

// $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
 
 // column titles
$header = array('Sl No', 'Feedback Category', 'Rating');
 //$obj_pdf->SetMargins(10, 0, 10, true);
// set some text to print
 $title = '<h2  align="center" style="font-size:18px;">Post Program Feedback</h2> <hr>';
 $obj_pdf->Ln(15.5);
 $obj_pdf->writeHTML($title,true, false, true, false, '');

 $proName = '<p style="font-size:18px;">Program Name : '.$prog_name.'</p>';
 $obj_pdf->Ln(10);
 $obj_pdf->writeHTML($proName,true, false, true, false, '');

 $obj_pdf->Ln(30);
 $obj_pdf->ColoredTable($header, $data);

 $obj_pdf->AddPage();
 $title = '<h2  align="center" style="font-size:18px;">Post Program Trainee Suggestions</h2> <hr>';
 $obj_pdf->Ln(15.5);
 $obj_pdf->writeHTML($title,true, false, true, false, '');
 
 $obj_pdf->Ln(15.5);
 $obj_pdf->writeHTML($suggestion,true, false, true, false, '');

 $obj_pdf->SetX(15);
 
//  $obj_pdf->SetFont('helvetica', 'B', 12);
//  $obj_pdf->writeHTML($duration,true, false, true, false, '');

//$obj_pdf->Output(__DIR__ .'/pdf/tour_report.pdf', 'F');  //save pdf
//$obj_pdf->Output('tour_report.pdf', 'D');
$obj_pdf->Output('feedback.pdf', 'I');


?>