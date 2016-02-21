<?php


  include_once 'database.php';
   // Retrieve data from Query String
   $nome = $_GET['nome'];
   $dob = $_GET['nasc'];


   // Escape User Input to help prevent SQL Injection
   $nome = $database->escape_value($nome);
   $dob =  $database->escape_value($dob);


   //build query
   $query = "SELECT num_carta, SUM(ufc) AS ufc FROM cadastro WHERE Nome_condutor = '$nome' AND data_nascimento = '$dob'";


   //Execute query
   $qry_result = $database->query($query) or die(mysql_error());

   //Build Result String
   $display_string = "<table>";
   $display_string .= "<tr>";
   $display_string .= "<th>CARTA DE CONDUÇÃO</th>";
  // $display_string .= "<th></th>";
   $display_string .= "<th>NUMEROS UFC ACUMULADOS</th>";

   $display_string .= "</tr>";

   // Insert a new row in the table for each person returned
   while($row = $database->fetch_array($qry_result)) {
      $display_string .= "<tr>";
      $display_string .= "<td border: 1px solid black;  >$row[num_carta]</td>";
      $display_string .= "<td border: 1px solid black;  >$row[ufc]</td>";

      $display_string .= "</tr>";
   }
  // echo "Query: " . $query . "<br />";

   $display_string .= "</table>";
   echo $display_string;
?>
