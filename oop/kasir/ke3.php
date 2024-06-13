<<?php
session_start();


function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item["sub_total"];
    }
    return $total;
}


function printReceipt($cart, $total) {
    
    $receiptHTML = '<html><head><title>Receipt</title></head><body>';
    $receiptHTML .= '<h1>Receipt</h1>';
    $receiptHTML .= '<table>';
    $receiptHTML .= '<tr><th>Kode Barang</th><th>Nama Barang</th><th>Harga</th><th>Quantity</th><th>Sub-Total</th></tr>';
    
    
    foreach ($cart as $item) {
        $receiptHTML .= '<tr>';
        $receiptHTML .= '<td>' . $item["kode_barang"] . '</td>';
        $receiptHTML .= '<td>' . $item["nama_barang"] . '</td>';
        $receiptHTML .= '<td>' . $item["harga"] . '</td>';
        $receiptHTML .= '<td>' . $item["quantity"] . '</td>';
        $receiptHTML .= '<td>' . $item["sub_total"] . '</td>';
        $receiptHTML .= '</tr>';
    }
    
   
    $receiptHTML .= '<tr><td colspan="4">Total</td><td>' . $total . '</td></tr>';
    
   
    $receiptHTML .= '</table>';
    $receiptHTML .= '</body></html>';
    
    
    echo $receiptHTML;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $tgl_transaksi = $_POST["tgl_transaksi"];
  $kode_barang = $_POST["kode_barang"];
  $nama_barang = $_POST["nama_barang"];
  $harga = $_POST["harga"];
  $quantity = $_POST["quantity"];

  
  $sub_total = $harga * $quantity;


  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }
  $_SESSION["cart"][] = array(
    "kode_barang" => $kode_barang,
    "nama_barang" => $nama_barang,
    "harga" => $harga,
    "quantity" => $quantity,
    "sub_total" => $sub_total
  );

  header("Location: kasir.php");
  exit;
}


if (isset($_POST["bayar"])) {
   
    $total = calculateTotal($_SESSION["cart"]);

    
    printReceipt($_SESSION["cart"], $total);

    
    unset($_SESSION["cart"]);
}


if (isset($_GET["hapus"])) {
    $index = $_GET["hapus"];
    if (isset($_SESSION["cart"][$index])) {
        unset($_SESSION["cart"][$index]);
    }
    
    header("Location: ke3.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style>
    body {
      font-family: sans-serif;
    }

    .container {
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }

    .form-container {
      width: 40%;
    }

    .cart-container {
      width: 50%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <h1>GROSIR BAROKAH</h1>
      <form method="post">
        <label for="tgl_transaksi">Tgl. Transaksi</label>
        <input type="text" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo date("d F Y"); ?>">

        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" required>

        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" required>

        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" required>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="1" required>

        <button type="submit">Tambah</button>
      </form>
    </div>

    <div class="cart-container">
      <h2>Keranjang Belanja</h2>
      <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Quantity</th>
              <th>Sub-Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION["cart"] as $index => $item): ?>
              <tr>
                <td><?php echo $item["kode_barang"]; ?></td>
                <td><?php echo $item["nama_barang"]; ?></td>
                <td><?php echo $item["harga"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td><?php echo $item["sub_total"]; ?></td>
                <td><a href="?hapus=<?php echo $index; ?>">Hapus</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <p>Total: <?php echo calculateTotal($_SESSION["cart"]); ?></p>
        <form method="post">
          <button type="submit" name="bayar">Bayar</button>
        </form>
      <?php else: ?>
        <p>Keranjang belanja kosong.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
