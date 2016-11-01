<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('FPDF_FONTPATH','./font/');
require('FPDF.php');

class Pdf extends FPDF
{
    function Header(){
        $reportName=$_SESSION["report_name"];
        $this->Image('assets/img/buet-logo.png',15,15,18);
        $this->Image('assets/img/logo.png',175,15,18);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);

        // Title
        $this->Cell(35,20,'Dept. of Computer Science and Engineering',0,0,'C');
        $this->SetFont('Arial','',12);
        // Move to the right
        $this->Cell(35);
        $this->Ln(10);
        $this->Cell(195,10,'Bangladesh University of Engineering and Technology',0,0,'C');
        $this->SetFont('Arial','U',11);
        $this->Ln(10);
        $this->Cell(190,10,''.$reportName ,0,0,'C');
        $this->Ln(8);
    }
    function Footer() {
        $this->SetY(-15);
        $lebar = $this->w;
        $this->SetFont('Arial','I',8);
        $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
        $this->SetY(-15);
        $this->SetX(0);
        $this->Ln(1);
        $hal = 'Page : '.$this->PageNo().' of {nb}';
        $this->Cell($this->GetStringWidth($hal ),10,$hal );
        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
        $tanggal  = 'Printed : '.date('d-m-Y  h:i-a').' ';
        $this->Cell($lebar-$this->GetStringWidth($hal )-$this->GetStringWidth($tanggal)-20);
        $this->Cell($this->GetStringWidth($tanggal),10,$tanggal );

    }
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
    function UsersTable($header, $w, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(6);
        $this->SetDrawColor(10, 20, 20);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        //$fill = false;
        $i=1;
        foreach ($data as $row) {
            $this->Row(array($i, $row["username"],$row["full_name"],$row["role"]));
            $i++;
        }
    }
    function SummeryFeedbackTable($header, $w, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(6);
        $this->SetDrawColor(10, 20, 20);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B');
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $i=1;
        $each_avg=0;
        foreach ($data as $row) {
            $total=($row["count4"])+($row["count3"])+($row["count2"])+($row["count1"])+($row["count0"]);
            $points=(($row["count4"])*5)+(($row["count3"])*4)+(($row["count2"])*3)+(($row["count1"])*2)+(($row["count0"])*1);
            if($total!=0){
                $each_avg+=($points/$total);
                $each=$points/$total;
            }
            else $each='N/A';

            $this->Row(array($i, $row["question"],$row["count4"],$row["count3"],$row["count2"],$row["count1"],$row["count0"], $each));
            $i++;
        }
        $this->Ln();
        $this->Cell(50, 7, 'Overall Average Point: '.round($each_avg/($i-1),2), 1, 0, 'C', true);

    }
    function CourseFeedbackGivenList($header, $w, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(6);
        $this->SetDrawColor(10, 20, 20);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $i=1;
        foreach ($data as $row) {
            $this->Row(array($i, $row["student_id"], $row["full_name"]));
            $i++;
        }

    }

}
?>