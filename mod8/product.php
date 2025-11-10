<?php
    include 'auth_check.php';
    $pdo = include 'connection.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $limit = 5;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $totalQuery = $pdo->query("select count(*) from products");
    $totalProducts = $totalQuery->fetchColumn();

    $query = "select * from products order by product_id limit :limit offset :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPages = ceil($totalProducts / $limit);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="./product.css">
    </head>
    <body>
        <h1>Products</h1>
        <center><table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Level</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?></td>
                        <td><?= htmlspecialchars($product['stock_level']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table></center>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i === $page ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>

        <br>
        <form action="addproduct.php">
            <button type="submit" class="add">Add a Product</button>
        </form>
        <form action="../mod7/home.php">
            <button type="submit" class="home">Home</button>
        </form>
        
    </body>
</html>