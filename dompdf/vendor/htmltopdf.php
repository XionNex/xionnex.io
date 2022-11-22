<?php
$html='
<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="UTF-8">
        <title>Generate HTML to PDF</title>
        <style>
        *{text-align:center;}
        </style>
    </head>
<body>
    <h1>Generate HTML to PDF</h1>
<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>S.No,</th>
        <th>Name</th>
        <th>Branch</th>
    </tr>
    <tr>
        <td>2</td>
        <td>Vivek Guptdw</td>
        <td>Computer Science</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Vivek Gupta</td>
        <td>Computer Science & Eng.</td>
    </tr>
</table>
</body>
</html>';

require 'vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf= new Dompdf();
$dompdf->loadhtml('html');
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream("playerofcode",array("Attachment=>1"));

?>