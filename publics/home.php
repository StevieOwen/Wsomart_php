<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../includes/dbconnexion.php'; // Load DB;
require_once "../includes/session.php";

$noproduct="";
$item=['name'=>'','price'=>'','image'=>''];
$activeCat = null;
$id="";
if(isset($_POST['cat1'])){
        $activeCat = 'cat1';
        try{
        $stm=$conn->prepare("SELECT item_name, item.item_id, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
        $stm->bindParam(':item_category', $category);
        $category="house furnitures";
        $stm->execute();
        $products=$stm->fetchAll(PDO::FETCH_ASSOC);
        if(empty($products)){
        $noproduct="Nothing found!";
        }
    }catch(Exception $e){

    }
}elseif(isset($_POST['cat2'])){
    $activeCat = 'cat2';
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, item.item_id, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $category="shoes and clothes";
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }

}catch(Exception $e){

}
}elseif(isset($_POST['cat3'])){
    $activeCat = 'cat3';
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, item.item_id, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $category="electronics";
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}elseif(isset($_POST['cat4'])){
    $activeCat = 'cat4';
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, item.item_id, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $category="makeup and beauty";
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}elseif(isset($_POST['cat5'])){
    $activeCat = 'cat5';
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, item.item_id, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $category="others";
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}elseif(isset($_POST['search'])){
   $searchTerm = "%" . $_POST['search_value'] . "%";
try{
    $stm=$conn->prepare("SELECT item_name, item_price,item.item_id, img_name from item join image on item.item_id=image.item_id WHERE item_category LIKE :item_category OR item_name LIKE :item_name");
    $stm->bindParam(':item_name', $searchTerm);
    $stm->bindParam(':item_category', $searchTerm);
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}else{
    $activeCat = 'cat';
    try{
        $stm=$conn->prepare("SELECT item_name,item.item_id, item_price, img_name from item join image on item.item_id=image.item_id");
        $stm->execute();
        $products=$stm->fetchAll(PDO::FETCH_ASSOC);
        if(empty($products)){
        $noproduct="Nothing found!";
        }
        
    }catch(Exception $e){

    }
}

if(isset($_POST['view'])){
    $_SESSION['item']= $_POST['item_id'];
    Header("Location:./account/productview.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home| WSOMART</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/header2.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
     <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
    <?php require_once "../includes/header2.php" ; ?>

     <!-- searchbar -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="search-container">
            <button type="submit" name="search">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>    
            <input type="text" placeholder="Search for a product" name="search_value" class="search-input">
        </div>  
    </form>

        <!-- Carousel -->
    <div class="mycarousel">
        <div class="container mt-5">
          <div id="sokoCarousel" class="carousel slide custom-carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#sokoCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#sokoCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#sokoCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row align-items-center carousel-content">
                            <div class="col-md-6 text-white ps-md-5">
                                <h4 class="display-4 fw-bold mb-4" style="font-size:6.5vw; text-align:center;">Furnish your room in Kigali</h4>
                                <a href="./account/category.php" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">Browse Items</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="../assets/images/carousel/pngimg.com - bed_PNG17418.png" class="img-fluid hero-img" alt="Furniture">
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row align-items-center carousel-content">
                            <div class="col-md-6 text-white ps-md-5">
                                <h4 class="display-4 fw-bold mb-4" style="font-size:6.5vw; text-align:center;">Leaving soon? Sell your gear</h4>
                                <a href="./account/dashboard.php" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">List an Item</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="../assets/images/carousel/pngimg.com - sofa_PNG6968.png" class="img-fluid hero-img" alt="Electronics">
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row align-items-center carousel-content">
                            <div class="col-md-6 text-white ps-md-5">
                                <h4 class="display-4 fw-bold mb-4" style="font-size:6.5vw; text-align:center;">Want to buy second hand products?</h4>
                                <a href="./account/category.php" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">Browse items</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="../assets/images/carousel/appliances-993782_1280.png" class="img-fluid hero-img" alt="Electronics">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- categorie navbar -->
     
    <div class="container py-4">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <!-- Category Pills -->
            <div class="category-pills">
                <button type="submit" name="cat" id="cat" class="category-pill <?php echo ($activeCat === 'cat') ? 'active' : '' ?>" data-category="all">All</button>
                <button type="submit" name="cat1" id="cat1" class="category-pill <?php echo ($activeCat === 'cat1') ? 'active' : '' ?>" data-category="house furnitures">House Furnitures</button>
                <button type="submit" name="cat2" id="cat2" class="category-pill <?php echo ($activeCat === 'cat2') ? 'active' : '' ?>" data-category="clothes">Clothes & Shoes</button>
                <button type="submit" name="cat3" id="cat3" class="category-pill <?php echo ($activeCat === 'cat3') ? 'active' : '' ?>" data-category="Electronics">Electronics</button>
                <button type="submit" name="cat4" id="cat4" class="category-pill <?php echo ($activeCat === 'cat4') ? 'active' : '' ?>" data-category="beauty">Makeup & Beauty</button>
                <button type="submit" name="cat5" id="cat5" class="category-pill <?php echo ($activeCat === 'cat5') ? 'active' : '' ?>" data-category="others">Others</button>
            </div>
        </form>

     <!-- products grid -->
        
        <div class="products-grid" id="popularProducts">
            <div><p><?php echo $noproduct; ?></p></div>
            <?php  foreach($products as $product): ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <div class="product-card">
                        <img src="../assets/images/<?php echo htmlspecialchars($product['img_name'])?>" alt="<?php echo htmlspecialchars($product['item_name'])?>" class="product-image">
                        <div class="product-name"><?php echo htmlspecialchars($product['item_name'])?></div>
                        <div class="product-footer">
                            <span class="product-price"><?php echo htmlspecialchars($product['item_price'])." Rwf"?></span>
                            <span><button type="submit" name="view"> View more></button></span>
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($product['item_id'])?>">
                            <!-- <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button> -->
                        </div>
                </div>
                </form>
            <?php endforeach?>
        

        </div>
        
        
    </div>


   
     <?php require_once "../includes/footer.php" ;
        render_footer("#", "./account/category.php","./account/dashboard.php", "./account/settings.php");    
    ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../assets/js/home.js"></script>
</body>
</html>