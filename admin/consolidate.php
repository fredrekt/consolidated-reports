<?php

include_once '../dbconnect.php';
    //library for reading excel files
    include_once "../Classes/PHPExcel.php";

//new 
$excel = new PHPExcel();
//selecting active sheet
$excel->setActiveSheetIndex(0);
$selectQry = "select * from consolidate";
$execQry = mysqli_query($db,$selectQry);
$row = 4;
while($data = mysqli_fetch_object($execQry)){
  $excel->getActiveSheet()
  ->setCellValue('A'.$row, $data->gradeandsection)
  ->setCellValue('B'.$row, $data->teacher)
  ->setCellValue('C'.$row, $data->eng_m)
  ->setCellValue('D'.$row, $data->eng_mps)
  ->setCellValue('E'.$row, $data->math_m)
  ->setCellValue('F'.$row, $data->math_mps)
  ->setCellValue('G'.$row, $data->fil_m)
  ->setCellValue('H'.$row, $data->fil_mps)
  ->setCellValue('I'.$row, $data->sci_m)
  ->setCellValue('J'.$row, $data->sci_mps)
  ->setCellValue('K'.$row, $data->mtb_m)
  ->setCellValue('L'.$row, $data->mtb_mps)
  ->setCellValue('M'.$row, $data->aral_m)
  ->setCellValue('N'.$row, $data->aral_mps)
  ->setCellValue('O'.$row, $data->mapeh_m)
  ->setCellValue('P'.$row, $data->mapeh_mps)
  ->setCellValue('Q'.$row, $data->epp_m)
  ->setCellValue('R'.$row, $data->epp_mps)
  ->setCellValue('S'.$row, $data->esp_m)
  ->setCellValue('T'.$row, $data->esp_mps)
  ;
  //increment row
  $row++;
}
//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

//table headers
$excel->getActiveSheet()
->setCellValue('A1' , 'GR & Section')
->setCellValue('B1' , 'Name of Teachers')
//for subjects
->setCellValue('C1' , 'ENGLISH')
->setCellValue('E1' , 'MATHEMATICS')
->setCellValue('G1' , 'FILIPINO')
->setCellValue('I1' , 'SCIENCE')
->setCellValue('K1' , 'MTB-MLE')
->setCellValue('M1' , 'ARAL. PAN')
->setCellValue('O1' , 'MAPEH')
->setCellValue('Q1' , 'EPP')
->setCellValue('S1' , 'ESP')
//for mean and mps
->setCellValue('C2' , 'M')
->setCellValue('D2' , 'MPS')
->setCellValue('E2' , 'M')
->setCellValue('F2' , 'MPS')
->setCellValue('G2' , 'M')
->setCellValue('H2' , 'MPS')
->setCellValue('I2' , 'M')
->setCellValue('J2' , 'MPS')
->setCellValue('K2' , 'M')
->setCellValue('L2' , 'MPS')
->setCellValue('M2' , 'M')
->setCellValue('N2' , 'MPS')
->setCellValue('O2' , 'M')
->setCellValue('P2' , 'MPS')
->setCellValue('Q2' , 'M')
->setCellValue('R2' , 'MPS')
->setCellValue('S2' , 'M')
->setCellValue('T2' , 'MPS')
->setCellValue('U1' , 'TOTAL')
->setCellValue('W1' , 'AVERAGE')
->setCellValue('U2' , 'M')
->setCellValue('V2' , 'MPS')
->setCellValue('W2' , 'M')
->setCellValue('X2' , 'MPS')

;

//merging title 
$excel->getActiveSheet()->mergeCells('A1:A3');
//$excel->getActiveSheet()->mergeCells('D3:E3');
$excel->getActiveSheet()->mergeCells('B1:B3');
//subjects
$excel->getActiveSheet()->mergeCells('C1:D1');
$excel->getActiveSheet()->mergeCells('E1:F1');
$excel->getActiveSheet()->mergeCells('G1:H1');
$excel->getActiveSheet()->mergeCells('I1:J1');
$excel->getActiveSheet()->mergeCells('K1:L1');
$excel->getActiveSheet()->mergeCells('M1:N1');
$excel->getActiveSheet()->mergeCells('O1:P1');
$excel->getActiveSheet()->mergeCells('Q1:R1');
$excel->getActiveSheet()->mergeCells('S1:T1');
//Mean and MPS
$excel->getActiveSheet()->mergeCells('C2:C3');
$excel->getActiveSheet()->mergeCells('D2:D3');
$excel->getActiveSheet()->mergeCells('E2:E3');
$excel->getActiveSheet()->mergeCells('F2:F3');
$excel->getActiveSheet()->mergeCells('G2:G3');
$excel->getActiveSheet()->mergeCells('H2:H3');
$excel->getActiveSheet()->mergeCells('I2:I3');
$excel->getActiveSheet()->mergeCells('J2:J3');
$excel->getActiveSheet()->mergeCells('K2:K3');
$excel->getActiveSheet()->mergeCells('L2:L3');
$excel->getActiveSheet()->mergeCells('M2:M3');
$excel->getActiveSheet()->mergeCells('N2:N3');
$excel->getActiveSheet()->mergeCells('O2:O3');
$excel->getActiveSheet()->mergeCells('P2:P3');
$excel->getActiveSheet()->mergeCells('Q2:Q3');
$excel->getActiveSheet()->mergeCells('R2:R3');
$excel->getActiveSheet()->mergeCells('S2:S3');
$excel->getActiveSheet()->mergeCells('T2:T3');
//total
$excel->getActiveSheet()->mergeCells('U1:V1');
$excel->getActiveSheet()->mergeCells('W1:X1');
$excel->getActiveSheet()->mergeCells('U2:U3');
$excel->getActiveSheet()->mergeCells('V2:V3');
$excel->getActiveSheet()->mergeCells('W2:W3');
$excel->getActiveSheet()->mergeCells('X2:X3');

//calculations
//total sum
$excel->getActiveSheet()
->setCellValue(
    'U4',
    '=SUM(C4,E4,G4,I4,K4,M4,O4,Q4,S4)'
);

$excel->getActiveSheet()
->setCellValue(
    'V4',
    '=SUM(D4,F4,H4,J4,L4,N4,P4,R4,T4)'
);
//average
$excel->getActiveSheet()
->setCellValue(
    'W4',
    '=AVERAGE(C4,E4,G4,I4,K4,M4,O4,Q4,S4)'
);

$excel->getActiveSheet()
->setCellValue(
    'X4',
    '=AVERAGE(D4,F4,H4,J4,L4,N4,P4,R4,T4)'
);


//manual override

$excel->getActiveSheet()
->setCellValue(
    'U5',
    '=SUM(C5,E5,G5,I5,K5,M5,O5,Q5,S5)'
);

$excel->getActiveSheet()
->setCellValue(
    'V5',
    '=SUM(D5,F5,H5,J5,L5,N5,P5,R5,T5)'
);
$excel->getActiveSheet()
->setCellValue(
    'U6',
    '=SUM(C6,E6,G6,I6,K6,M6,O6,Q6,S6)'
);

$excel->getActiveSheet()
->setCellValue(
    'V6',
    '=SUM(D6,F6,H6,J6,L6,N6,P6,R6,T6)'
);
//average
$excel->getActiveSheet()
->setCellValue(
    'W5',
    '=AVERAGE(C5,E5,G5,I5,K5,M5,O5,Q5,S5)'
);

$excel->getActiveSheet()
->setCellValue(
    'X5',
    '=AVERAGE(D5,F5,H5,J5,L5,N5,P5,R5,T5)'
);

//average
$excel->getActiveSheet()
->setCellValue(
    'W6',
    '=AVERAGE(C6,E6,G6,I6,K6,M6,O6,Q6,S6)'
);

$excel->getActiveSheet()
->setCellValue(
    'X6',
    '=AVERAGE(D6,F6,H6,J6,L6,N6,P6,R6,T6)'
);

//batch 6


$excel->getActiveSheet()
->setCellValue(
    'U7',
    '=SUM(C7,E7,G7,I7,K7,M7,O7,Q7,S7)'
);

$excel->getActiveSheet()
->setCellValue(
    'V7',
    '=SUM(D7,F7,H7,J7,L7,N7,P7,R7,T7)'
);

//average
$excel->getActiveSheet()
->setCellValue(
    'W7',
    '=AVERAGE(C7,E7,G7,I7,K7,M7,O7,Q7,S7)'
);

$excel->getActiveSheet()
->setCellValue(
    'X7',
    '=AVERAGE(D7,F7,H7,J7,L7,N7,P7,R7,T7)'
);

//end batch 6


//batch 7


$excel->getActiveSheet()
->setCellValue(
    'U8',
    '=SUM(C8,E8,G8,I8,K8,M8,O8,Q8,S8)'
);

$excel->getActiveSheet()
->setCellValue(
    'V8',
    '=SUM(D8,F8,H8,J8,L8,N8,P8,R8,T8)'
);

//average
$excel->getActiveSheet()
->setCellValue(
    'W8',
    '=AVERAGE(C8,E8,G8,I8,K8,M8,O8,Q8,S8)'
);

$excel->getActiveSheet()
->setCellValue(
    'X8',
    '=AVERAGE(D8,F8,H8,J8,L8,N8,P8,R8,T8)'
);

//end batch 7



//batch 8


$excel->getActiveSheet()
->setCellValue(
    'U9',
    '=SUM(C9,E9,G9,I9,K9,M9,O9,Q9,S9)'
);

$excel->getActiveSheet()
->setCellValue(
    'V9',
    '=SUM(D9,F9,H9,J9,L9,N9,P9,R9,T9)'
);

//average
$excel->getActiveSheet()
->setCellValue(
    'W9',
    '=AVERAGE(C9,E9,G9,I9,K9,M9,O9,Q9,S9)'
);

$excel->getActiveSheet()
->setCellValue(
    'X9',
    '=AVERAGE(D9,F9,H9,J9,L9,N9,P9,R9,T9)'
);

//end batch 8

//batch 9


$excel->getActiveSheet()
->setCellValue(
    'U10',
    '=SUM(C10,E10,G10,I10,K10,M10,O10,Q10,S10)'
);

$excel->getActiveSheet()
->setCellValue(
    'V10',
    '=SUM(D10,F10,H10,J10,L10,N10,P10,R10,T10)'
);

//average
$excel->getActiveSheet()
->setCellValue(
    'W10',
    '=AVERAGE(C10,E10,G10,I10,K10,M10,O10,Q10,S10)'
);

$excel->getActiveSheet()
->setCellValue(
    'X10',
    '=AVERAGE(D10,F10,H10,J10,L10,N10,P10,R10,T10)'
);

//end batch 9

//loop the code -> the code


//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('C1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('E1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('G1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('I1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('K1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('M1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('O1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('Q1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('S1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('B1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
        ),
    )
);

// STYLE FOR Mean and MPS
$excel->getActiveSheet()->getStyle('C2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('D2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('E2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('F2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('G2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('H2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('I2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('J2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('K2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('L2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('M2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('N2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('O2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('P2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('Q2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('R2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('S2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('T2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

//TOTAL STYLING

$excel->getActiveSheet()->getStyle('U1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('W1')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('U2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('V2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('W2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);

$excel->getActiveSheet()->getStyle('X2')->applyFromArray(
    array(
        'font' => array(
            'size'=>10,
            'bold'=>true,
            
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
);



// $excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
//     array(
//         'font' => array(
//             'bold'=>true
//         ),
//         'borders' => array(
//             'allborders'=>array(
//                 'style'=>PHPExcel_Style_Border::BORDER_THIN
//             )
//         )
//     )
// );


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="ConsolidatedReport.xlsx"');
header('Cache-Control: max-age=0');

$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->save('php://output');

?>