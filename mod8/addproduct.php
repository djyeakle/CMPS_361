<?php
include 'auth_check.php';
include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['productname'] ?? '');
    $description = trim($_POST['productdescription'] ?? '');
    $price = $_POST['productprice'] ?? '';
    $stocklevel = $_POST['productstocklevel'] ?? '';

    if ($name && $description && is_numeric($price) && is_numeric($stocklevel)) {
        try {
            $query = "insert into products (name,description,price,stock_level)
                      values (:productname,:productdescription,:productprice,:productstocklevel)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':productname' => $name, 
                ':productdescription' => $description, 
                ':productprice' => (float)$price, 
                ':productstocklevel' => (int)$stocklevel
            ]);
            echo "Product added successfully!";
        } catch (PDOException $e) {
            echo "Database error: " . htmlspecialchars($e->getMessage());
        }
    }

}

?>

<html>
    <head>
        <title>Add Product</title>
        <link rel="stylesheet" href="../mod7/login.css">
        <script src="../mod7/home.js"></script>
    </head>
    <body>
        <h1>Add a Product</h1>
        <form method="POST">
            <label>Product Name:</label>
            <input type="text" name="productname" required><br><br>

            <label>Product Description:</label>
            <input type="text" name="productdescription" required><br><br>

            <label>Product Price:</label>
            <input type="text" name="productprice" required><br><br>

            <label>Product Stock Level:</label>
            <input type="text" name="productstocklevel" required><br><br>

            <button type="submit">Submit</button><br><br>

        </form>
        <button onclick=viewProducts() class="back">Back</button>
    </body>
</html>