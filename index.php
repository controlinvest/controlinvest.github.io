<!DOCTYPE html>
<html>
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
          <tbody id="divList_body"></tbody>
     </table>
     <?php }?>
     </center>


</body>
<script type="text/javascript" language="javascript">
     function write_table(){
          var x = document.getElementById("divList_body");

     }

</script>


</html>
