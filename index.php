<!DOCTYPE html>
<html>
<?php
if(isset($_GET['ticker'])){
     $conn = mysqli_connect("35.198.52.0","updater","update","spreadsheet");
     mysqli_set_charset($conn,'utf8');
     $ticker = $_GET['ticker'];
     $date_purchase = $_GET['date_purchase'];
     $quantity = $_GET['quantity'];

     $today_date = date('Y-m-d');
     $one_year_ago = $dateMinusOneYear = date("Y-m-d", strtotime("-1 year", strtotime($today_date)));

     $sql_ticker_id = "SELECT id FROM tickers WHERE ticker='$ticker'";
     $result_ticker_id = mysqli_query($conn, $sql_ticker_id);
     $data_ticker_id = mysqli_fetch_array($result_ticker_id);
     $ticker_id = $data_ticker_id['id'];


     $sql_dividends_since_purchase = "SELECT value FROM dividends WHERE ticker_id='$ticker_id' AND date_announced>='$date_purchase' AND date_paid<='$today_date' ORDER BY date_paid DESC";
     $result_since_purchase = mysqli_query($conn, $sql_dividends_since_purchase);
     $total_received = 0;
     while($data_since_purchase = mysqli_fetch_array($result_since_purchase)){
          $total_received = $total_received + $data_since_purchase['value'];
     }

     $sql_dividends_year = "SELECT value FROM dividends WHERE ticker_id='$ticker_id' AND date_paid>='$one_year_ago' AND date_paid<='$today_date' ORDER BY date_paid DESC";
     $result_total_year = mysqli_query($conn, $sql_dividends_year);
     $total_year = 0;
     while($data_total_year = mysqli_fetch_array($result_total_year)){
          $total_year = $total_year + $data_total_year['value'];
     }

     $sql_dividends_year = "SELECT * FROM dividends WHERE ticker_id='$ticker_id' AND date_paid>='$one_year_ago' AND date_paid<='$today_date' ORDER BY date_paid DESC";
}

?>
<head>
<title>Proventos</title>
</head>
<body>

     <center>
     <h1>Proventos</h1>
     <form class="" action="index.php" method="get">
          <label for="ticker">Código do ativo:</label>
          <input type="text" name="ticker" id='ticker' placeholder="Ex.: ITSA4" required><br><br>
          <label for="date_purchase">Data de compra: </label>
          <input type="date" name="date_purchase"  id='date_purchase'><br><br>
          <label for="quantity">Quantidade: </label>
          <input type="number" name="quantity" id='quantity'><br><br>
          <input type="submit" name="go" onclick="check_ticker()" value="Ver">
     </form>
     <br><br><br><br><br><br>
     <h2><?php echo("Total recebido desde a compra: R$ $total_received"); ?></h2>
     <h2><<?php echo("Total recebido no ano: R$ $total_year"); ?></h2>
     <?php if(isset($_GET['ticker'])){ ?>
     <table id="divList">
          <tr>
               <th>Data de Anúncio</th>
               <th>Tipo de Provento</th>
               <th>Data de Pagamento</th>
               <th>Valor pago</th>
          </tr>
          <?php
               $result_dividend_year = mysqli_query($conn, $sql_dividends_year);
               while($data_dividends_year = mysqli_fetch_array($result_dividend_year)){
                    $tDateAnnounce = $data_dividends_year['date_announced'];
                    $tDatePaid = $data_dividends_year['date_paid'];
                    $type = $data_dividends_year['type'];
                    $tValue = $data_dividends_year['value'];
                    $value = number_format($tValue, 2, ',', '.');
                    $date_announce = strftime('%d-%m-%Y', strtotime($tDateAnnounce));
                    $date_paid = strftime('%d-%m-%Y', strtotime($tDatePaid));
               ?> <tr>
                    <td> <?php echo($date_announce); ?></td>
                    <td> <?php echo($type); ?> </td>
                    <td> <?php echo($date_paid); ?> </td>
                    <td> <?php echo("R$ $value") ?> </td>
               </tr>
          <?php }
          ?>
          <tbody id="divList_body"></tbody>
     </table>
     <?php }?>
     </center>


</body>
<script src="build-table.js"></script>


</html>
