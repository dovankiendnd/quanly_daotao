<?php
error_reporting(0);
include_once('connect.php');
$admission_number=$_GET['admission_number'];
$course_id=$_GET['course_id'];
$year=$_GET['year'];
$term=$_GET['term'];

//get the students details
$sql2 = "SELECT * FROM studentstable  WHERE admission_number='$admission_number'";

$resultset2 = mysqli_query($db, $sql2) or die("database error:". mysqli_error($db));
while($users3=mysqli_fetch_array($resultset2))
        {
        $name=$users3['sirname']." ".$users3['firstname']." ".$users3['lastname'];
        $adm=$users3['admission_number'];
        $feepayable=$users3['feepayable'];
        }
$sql3 = "SELECT * FROM course  WHERE course_id=$course_id";
$resultset3 = mysqli_query($db, $sql3) or die("database error:". mysqli_error($db));
while($users3=mysqli_fetch_array($resultset3))
        {
        $coursename=$users3['coursename'];
        $course_id=$users3['course_id'];
        }

//calculating the fee paid and the marks
$sqlf = "SELECT * FROM marks  WHERE course_id=$course_id AND admission_number='$admission_number' AND year=$year AND term='$term' ";
// echo $sqlf;
// exit;
$resultsetmarks = mysqli_query($db, $sqlf) or die("database error:". mysqli_error($db));
while($users5 = mysqli_fetch_array($resultsetmarks)){
       $FBM=$users5['FBM'];
        $R_SERVICE=$users5['R_SERVICE'];
        $CT_PB=$users5['CT_PB'];
        $FOOD_SCIENCE=$users5['FOOD_SCIENCE'];
        $FUNDAMENTALS=$users5['FUNDAMENTALS'];
        $FRONT_OFFICE=$users5['FRONT_OFFICE'];
        $COMUNICATION_SKILLS=$users5['COMUNICATION_SKILLS'];
        $COSTING=$users5['COSTING'];
        $HOUSEKEEPING=$users5['HOUSEKEEPING'];
        $FB_PRACTICAL=$users5['FB_PRACTICAL'];
        $average=$users5['average'];
}

//end of calculation process

//looking for average
                                      
                                           
                                                if ($average > "80") {
                                                        $classgrade="DISTINCTION";
                                                    } 
                                                    elseif (($average > "60") && ($average < "80"))
                                                     {
                                                        $classgrade="CREDIT";
                                                    } 
                                                    elseif (($average > "40") && ($average < "60"))
                                                     {
                                                        $classgrade="PASS";
                                                    } 
                                                    elseif (($average > "0") && ($average < "40"))
                                                     {
                                                        $classgrade="FAIL";
                                                    }
                                                     else{
                                                        $classgrade="";
                                                    } 
                                                           
//looking for average
require('fpdf/fpdf.php');
class PDF extends FPDF
{

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Line(0, 600, 210,600);
    $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'L');
    // $tDate=date('l \t\h\e jS');
    //$this->Cell(0, 10, 'Date : '.$tDate, 0, false, 'C', 0, '', 0, false, 'T', 'M');
}
}


$pdf = new PDF();
$pdf->SetAuthor('John Muthama');
$pdf->AliasNbPages();
//set font for the entire document
$pdf->SetFont('Times','B',20);
$pdf->SetTextColor(0,0,0);
//set up a page
$pdf->AddPage('P');
//$pdf->SetDisplayMode(real,'default');
//insert an image and make it a link

//display the title with a border around it
$pdf->SetXY(50,50);
$pdf->Cell(100,5,'Academic Transcript',0,0,'C',0);
//C MEANS CENTERED
//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (10,50);
$pdf->SetFontSize(10);

//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Ln(); //break 
$pdf->Cell(0,10,'Student Name :'.$name ,0,1);
$pdf->Cell(0,10,'Admission Number :'.$adm ,0,1);
$pdf->Cell(0,10,'Course Name :'.$coursename ,0,1);
$pdf->Cell(0,10,'Term :'.$term ,0,1);

//This is teh date included in the submited form i.e printinvloice.php
$date=$_GET['date'];

$pdf->SetXY(150, 55);
$pdf->SetFontSize(10); 
$pdf->Cell(0,10,'Date :'.$date ,0,0,'R',0);

//Put a line here
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break 
$pdf->Ln(4); //break    
$pdf->Ln(4); //break        
$pdf->Line(0, 93, 210, 93);  //Set the line
$pdf->Ln(4); //line Break
$pdf->Cell(0,10,'Subject                                                                                             Marks' ,0,1);

$pdf->SetFont('Times','',10);
$pdf->Line(0, 100, 210, 100);  //Set the line
///marks to appear here
$pdf->Cell(0,10,'Food & Beverage Management                                                           '.$FBM ,0,1);
$pdf->Cell(0,10,'Restaurant Service Theory                                                                   '.$R_SERVICE ,0,1);
$pdf->Cell(0,10,'Culinary Theory                                                                                   '.$CT_PB ,0,1);
$pdf->Cell(0,10,'Food Science                                                                                        '.$FOOD_SCIENCE ,0,1);
$pdf->Cell(0,10,'Fundamentals & the Hospitality Industry                                            '.$FUNDAMENTALS ,0,1);
$pdf->Cell(0,10,'Front Office & Guests Relation                                                           '.$FRONT_OFFICE ,0,1);
$pdf->Cell(0,10,'Communication Skills                                                                         '.$COMUNICATION_SKILLS ,0,1);
$pdf->Cell(0,10,'Costing & Control                                                                               '.$COSTING ,0,1);
$pdf->Cell(0,10,'Housekeeping & Accomodation Studies                                             '.$HOUSEKEEPING ,0,1);
$pdf->Cell(0,10,'Food & Beverage Practical                                                                 '.$FB_PRACTICAL ,0,1);
$pdf->SetFont('','B');
$pdf->Cell(0,10,'Average                                                                                               '.$average ,0,1);

$pdf->Ln(2); //break  
$pdf->Line(0, 200, 210, 200);  //Set the line

/// Begin with regular font
//Output the fee summary values calculated above

$pdf->SetFont('','U');
$pdf->Cell(0,10,'Comment');
$pdf->SetFont('','');
$pdf->Ln();
$pdf->Cell(100,10,"GRADE ATTAINED:  ".$classgrade,1,0,'L',0);

//this ln things are ment to put line breaks great!!!!

$pdf->Ln();
$pdf->SetFont('','');
//change the color from the current blue to black, kudos
$pdf->SetTextColor(0,0,0);
$pdf->Write(10,'Exams Officer                                                       HOD                                                          Principal');
$pdf->Ln();
$pdf->Write(10,'---------------                                                       -------------                                                   --------------');

$pdf->SetXY(150, 220);
$pdf->SetFontSize(10);
$pdf->SetTextColor(255,60,0);
$pdf->SetFont('Times','u',10); 
$pdf->Cell(0,10,'KEY TO GRADES:',0,1,R,0);
$pdf->SetFont('','');
$pdf->Cell(0,10,'DISTINCTION: ABOVE 80',0,1,R,0);
$pdf->Cell(0,10,'CREDI: 60 - 79 ',0,1,R,0);
$pdf->Cell(0,10,'PASS: 40 - 59 ',0,1,R,0);
$pdf->Cell(0,10,'FAIL: BELOW 40',0,1,R,0);

$pdf->SetXY(0, 240);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('','');
$pdf->Ln();
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('','i');
$pdf->Write(10,'NB: This is not a certificate');
$pdf->SetTextColor(0,0,0);
//nore text
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFontSize(10);//set the font size of the last line
$pdf->SetFont('','i');
$pdf->Write(10,'Please contact us immediately if there are any errors in these details');
$pdf->SetTextColor(0,0,0);


$pdf->Output();
?>