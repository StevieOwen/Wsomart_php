<?php 
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;

$category='';
$noproduct="";
if(isset($_SESSION['category'])){
    $category= $_SESSION['category'];
}

try{
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id where item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    
}catch(Exception $e){

}
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products |WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header2.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/category.css">
    <link rel="stylesheet" href="../../assets/css/products_category.css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php require_once "../../includes/header2.php" ?>

    
    <!-- searchbar -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="search-container">
            <button type="submit" name="search">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>    
            <input type="text" placeholder="Browse Products" name="search_value" class="search-input">
        </div>  
    </form>
    <br>

    <h5><?php echo $category; ?></h5>
    <div class="products-grid" id="popularProducts">
            <div><p><?php echo $noproduct; ?></p></div>
            <?php  foreach($products as $product): ?>
            <div class="product-card">
                    <img src="../../assets/images/<?php echo htmlspecialchars($product['img_name'])?>" alt="<?php echo htmlspecialchars($product['item_name'])?>" class="product-image">
                    <div class="product-name"><?php echo htmlspecialchars($product['item_name'])?></div>
                    <div class="product-footer">
                        <span class="product-price"><?php echo htmlspecialchars($product['item_price'])." Rwf"?></span>
                        <!-- <button class="favorite-btn" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button> -->
                    </div>
            </div>
            <?php endforeach?>
        

    </div>

     <?php require_once "../../includes/footer.php" ;
        render_footer("../home.php", './category.php', './dashboard.php', "./settings.php")
    ?>  
</body>
</html>