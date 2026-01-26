<?php 
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once  '../../includes/session.php';

try{
    $stm=$conn->prepare("SELECT DISTINCT categoriename, cat_id from categories");
    $stm->execute();
    $categories=$stm->fetchAll(PDO::FETCH_ASSOC); 

}catch(Exception $e){

}

if(isset($_POST["cat1"])){
   $_SESSION['category']="House Furnitures";
   header("Location:products_category.php");

}elseif(isset($_POST["cat2"])){
    $_SESSION['category']="Shoes and Clothes";
    header("Location:products_category.php");

}elseif(isset($_POST["cat3"])){
    $_SESSION['category']="Electronics";    
    header("Location:products_category.php");

}elseif(isset($_POST["cat4"])){
    $_SESSION['category']="Makeup and Beauty";    
    header("Location:products_category.php");

}elseif(isset($_POST["cat5"])){
    $_SESSION['category']="Others";
    header("Location:products_category.php");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category| WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header2.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/category.css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
   <?php require_once "../../includes/header2.php" ;?>

   <!-- searchbar -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="search-container">
            <button type="submit" name="search">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>    
            <input type="text" placeholder="Browse categories" name="search_value" class="search-input">
        </div>  
    </form>
    <br>

    <main>

        <h5 style="font-size:1rem; margin-left:10px;">Product categories</h5 style="font-size:1rem; margin-left:10px;">

       <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="categories-grid">
             <?php foreach($categories as $category):?>
            <div class="card categorie-card" >
                <div class="card-body">
                    <button type="submit" name="<?php echo htmlspecialchars($category['cat_id']) ?>" class="card-title"><?php echo htmlspecialchars($category['categoriename'])?></button>
                    <!-- <input type="hidden" name="<?php echo htmlspecialchars($category['categoriename'])?>" value="<?php echo htmlspecialchars($category['categoriename'])?>"> -->
                </div>
            </div>
            <?php endforeach ?>
            
        </div>
       </form>
    </main>

   



   <?php require_once "../../includes/footer.php" ;
        render_footer("../home.php", '#', './dashboard.php', "./settings.php")
    ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>