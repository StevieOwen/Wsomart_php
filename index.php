<?php
require_once __DIR__ . '/vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/includes/dbconnexion.php'; // Load DB;

$noproduct="";
$item=['name'=>'','price'=>'','image'=>''];
if(isset($_POST['cat1'])){
        try{
        $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
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
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
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
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
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
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
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
    try{
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category=:item_category");
    $stm->bindParam(':item_category', $category);
    $category="others";
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}elseif(isset($_POST['cat'])){

    try{
        $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id");
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
    $stm=$conn->prepare("SELECT item_name, item_price, img_name from item join image on item.item_id=image.item_id WHERE item_category LIKE :item_category OR item_name LIKE :item_name");
    $stm->bindParam(':item_name', $searchTerm);
    $stm->bindParam(':item_category', $searchTerm);
    $stm->execute();
    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(empty($products)){
        $noproduct="Nothing found!";
    }
    }catch(Exception $e){

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>WSOMart</title>
    <link rel="stylesheet" href="./assets/css/index.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body >
   <header class="header"> 
    <h3>WSOMART   <svg width="24" style="color:#013F62" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M2.787 2.28a.75.75 0 0 1 .932.507l.55 1.863h14.655c1.84 0 3.245 1.717 2.715 3.51l-1.655 5.6c-.352 1.193-1.471 1.99-2.715 1.99H8.113c-1.244 0-2.362-.797-2.715-1.99L2.281 3.212a.75.75 0 0 1 .506-.931M6.25 19.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0m8 0a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0'/></svg></h3>

    <p><span><a href="./publics/Auth/login.php">Login</a></span> / <span><a href="./publics/Auth/registration.php">Register</a></span></p>

   </header>

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
                                <a href="/buy" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">Browse Items</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="./assets/images/carousel/pngimg.com - bed_PNG17418.png" class="img-fluid hero-img" alt="Furniture">
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row align-items-center carousel-content">
                            <div class="col-md-6 text-white ps-md-5">
                                <h4 class="display-4 fw-bold mb-4" style="font-size:6.5vw; text-align:center;">Leaving soon? Sell your gear</h4>
                                <a href="/sell" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">List an Item</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="./assets/images/carousel/pngimg.com - sofa_PNG6968.png" class="img-fluid hero-img" alt="Electronics">
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row align-items-center carousel-content">
                            <div class="col-md-6 text-white ps-md-5">
                                <h4 class="display-4 fw-bold mb-4" style="font-size:6.5vw; text-align:center;">Want to buy second hand products?</h4>
                                <a href="/sell" class="btn btn-dark btn-lg rounded-pill px-5 car-btn" style="font-size:3.5vw; ">Browse items</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="./assets/images/carousel/appliances-993782_1280.png" class="img-fluid hero-img" alt="Electronics">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- categorie navbar -->
    <div class="cat-nav">

        
    <button type="button" id="dropdown-btn" > <span> Display All Categories </span> <span> <img id="but-icon" src="./assets/icon/down.png" alt=""></span></button>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <ul id="cat-menu" class="hidden">
                <li><button type="submit" name="cat" class="but-menu">All</button></li>
                <li><button type="submit" name="cat1" class="but-menu">House Furniture</button></li>
                <li><button type="submit" name="cat2" class="but-menu">Shoes and Clothes</button></li>
                <li><button type="submit" name="cat3" class="but-menu">Electronics</button></li>
                <li><button type="submit" name="cat4" class="but-menu">Makeup and Beauty</button></li>
                <li><button type="submit" name="cat5" class="but-menu">Others</button></li>
            </ul>
        </form>
    </div>

     <!-- products grid -->

    <div class="products-grid">

        <div><p><?php echo $noproduct; ?></p></div>
        <?php  foreach($products as $product): ?>
        <div class="card product-card" style="border-radius:12px;" >
            <img src="./assets/images/<?php echo htmlspecialchars($product['img_name'])?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?php echo htmlspecialchars($product['item_name'])?></p>
                <p class="card-text" style="font-size:0.7rem;"><?php echo htmlspecialchars($product['item_price'])." Rwf"?></p>
            </div>
        </div>  
            <?php endforeach?>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="./assets/js/index.js"></script>
</body>
</html>