<?php

  function get_data_from_db()
  {
    # code...
    //we will store table data in html
    $output = '';

    //connect with database
    $conn = mysqli_connect("localhost","root","","thanaaa");



    //fetching data
    $query = "SELECT * FROM bangladesh_district_list";

    //execute query
       //1st parameter is for database string and 2nd parameter is for your excutable query
    $executeQuery = mysqli_query($conn, $query);

    //now fetch data from variable $excuteQuery
    /*function mysqli_fetch_array() it will convert $excuteQuery
      into an associative array and store into $row variable
    */
    while ($row = mysqli_fetch_array($executeQuery) )
    {
        # code...
        /*now we will print data into table format and
         store it into ouput variable
        */

        $output .= '
            <tr>
              <td>'.$row['id'].'</td>
              <td>'.$row["district_name"].'</td>
              <td>'.$row["status"].'</td>
              <td>'.$row["districtCode"].'</td>
              <td>'.$row["divisionCode"].'</td>
            </tr>
        ';
    }

    return $output;

  }

  //if anyone clicks on the button
  if (isset($_POST["create_pdf"]))
  {
    # code...
    require_once("tcpdf/tcpdf.php");

    //creating new document
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    //set the document information
    $obj_pdf->SetCreator(PDF_CREATOR);

    //define the title of the document
    $obj_pdf->SetTitle("Testing with TCPDF");


    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');

    //distance of footer
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);

    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);

    //distance from the bottom is the second parameter
    $obj_pdf->SetAutoPageBreak(true, 10);

    $obj_pdf->SetFont('helvetica','',12);
    $obj_pdf->AddPage();

    //storing html code in content
    $content = '';

    $content .= '
     <h3 align="center">Bangladesh District List</h3><br />
          <table border="1" cellspacing = "0" cellpadding = "5">
          <tr>
               <th width="5%">ID</th>
               <th width="30%">District Name</th>
               <th width="10%">Status</th>
               <th width="20%">District Code</th>
               <th width="20%">Division Code</th>
          </tr>
      ';

      //add data to $content variable
      $content .= get_data_from_db();

      $content .= '</table>';

      //after generating a pdf file data will be printed on pdf in html format
      $obj_pdf->writeHTML($content);

      $obj_pdf->Output("sample.pdf", 'I');

  }

  ?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>tcpdf</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  </head>
  <body>

    <h1 style="text-align: center">Test1 with TCPDF</h1>

    <div class="container" style="width:700px;">
         <h3 align="center">Bangladesh District List</h3><br />
         <div class="table-responsive">
              <table class="table table-bordered">
                   <tr>
                        <th width="5%">ID</th>
                        <th width="30%">District Name</th>
                        <th width="10%">Status</th>
                        <th width="20%">District Code</th>
                        <th width="20%">Division Code</th>
                   </tr>

                   <?php
                      echo get_data_from_db();
                   ?>

              </table>
            
              <form method="post">
                   <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />
              </form>
         </div>
    </div>

  </body>
</html>
