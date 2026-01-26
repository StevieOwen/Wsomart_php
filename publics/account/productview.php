<?php 
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;

$item_id="";
if(isset($_SESSION['item'])){
    $item_id= $_SESSION['item'];
}

try{

    $stm=$conn->prepare("SELECT item_name, item_description, item_price, img_name, cust_first_name, cust_last_name, cust_phone,cust_address from publication join item on publication.item_id=item.item_id join customer on publication.seller_id=customer.cust_id join image on publication.img_id=image.img_id where item.item_id=:item_id ");
    $stm->bindParam(':item_id',$item_id);
    $stm->execute();
    $result=$stm->fetch(PDO::FETCH_ASSOC) ;
    
}catch(Exception $e){

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../../assets/css/productview.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="product-container">
        <!-- Image Carousel -->
        <div class="image-carousel">
            <div class="carousel-nav">
                <button class="nav-btn" onclick="previousSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn">
                    <i class="far fa-heart"></i>
                </button>
            </div>

            <div class="carousel-slides">
                <div class="carousel-slide active">
                    <img src="../../assets/images/<?php echo $result['img_name']?>" alt="Yellow Couch" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="../../assets/images/<?php echo $result['img_name']?>" alt="Yellow Couch View 2" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="../../assets/images/<?php echo $result['img_name']?>" alt="Yellow Couch View 3" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="../../assets/images/<?php echo $result['img_name']?>" alt="Yellow Couch View 4" class="carousel-image">
                </div>
            </div>

            <div class="carousel-indicators">
                <span class="indicator-dot active" onclick="goToSlide(0)"></span>
                <span class="indicator-dot" onclick="goToSlide(1)"></span>
                <span class="indicator-dot" onclick="goToSlide(2)"></span>
                <span class="indicator-dot" onclick="goToSlide(3)"></span>
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <div class="product-header">
                <h1 class="product-title"><?php echo $result['item_name']?></h1>
                <p class="product-price"><?php echo $result['item_price']?></p>
            </div>
            <p class="product-author"><?php echo $result['cust_first_name']." ".$result['cust_last_name']?></p>

            <h2 class="section-title">Description</h2>
            <p class="description-text">
                <?php echo $result['item_description']?>
            </p>
           

            <div class="action-buttons">
                <button class="btn-availability">
                    <i class="fas fa-comment"></i>
                    Is this still Available?
                </button>
                <button class="btn-like">
                    <i class="fas fa-thumbs-up"></i>
                    Like This
                </button>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/product_view.js"></script>
</body>
</html>