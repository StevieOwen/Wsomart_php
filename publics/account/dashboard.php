
<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once  '../../includes/session.php';

$item=['price'=>'','name'=>'','img_name'=>'','id'=>''];
$num_item=0;
$total_item_price=0;
try{
    $stm=$conn->prepare("SELECT item_price, item_name, img_name, item.item_id, item_seller from item  join image on item.item_id=image.item_id where (item_seller=:item_seller and item_status=:item_status) ");
    $stm->bindParam(':item_seller',$cust_id);
    $stm->bindParam(':item_status',$status);
    $status="available";
    $stm->execute();
    // $result=$stm->setFetchMode();

    $products=$stm->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($_SESSION['customer']);
    
    $num_item=count($products);
    foreach($products as $product){
        $total_item_price+=$product['item_price'];
    } 

}catch(Exception $e){
    echo $e;
}

if(isset($_POST['delete'])){
    
    $item_id=$_POST['item_id'];
    
    try{
        $stm=$conn->prepare("DELETE from image where item_id=:item_id");
        $stm->bindParam(':item_id',$item_id);
        $stm->execute();

        $stmt=$conn->prepare("DELETE from item where item_id=:item_id");
        $stmt->bindParam(':item_id',$item_id);
        $stmt->execute();

    }catch(Exception $e){

    }
    
} 

if(isset($_POST['mark_sold'])){
    $item_id=$_POST['item_id'];

    try{
        $stm=$conn->prepare("UPDATE item set item_status=:item_status where item_id=:item_id");
    $stm->bindParam(':item_status',$status);
    $stm->bindParam(':item_id',$item_id);

    $status="sold";
    $stm->execute();
    }catch(Exception $e){

    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard|WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/header2.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">

</head>
<body>
    <?php require_once "../../includes/header2.php" ;?>

    <main>
    <div class="card-container ">
        <div class="container">
            <div class="card card_design" >
                <div class="card-body">
                    <h5 class="card-title">Total listed items</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo htmlspecialchars( $num_item) ; ?></h6>
                    
                    
                </div>
            </div>

            <div class="card card_design" style="background-color:#0E2D3E; ">
                <div class="card-body">
                    <h5 class="card-title">Total product value</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo htmlspecialchars($total_item_price)." RWF" ; ?></h6>
                    
                    
                </div>
            </div>

        </div>

        <div class="container">
                <div class="card card_design" style=" background-color:#0E2D3E;">
                <div class="card-body">
                    <h5 class="card-title">Total product likes</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo "12";?></h6>
                    
                    
                </div>
            </div>

            <div class="card card_design">
                <div class="card-body">
                    <h5 class="card-title">Total product click</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?php  echo "120" ;?></h6>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <div class="addsection">
        <div class=addcontainer>
            <h6>Product list</h6>
            <h5><a href="./addproduct.php">Add new product</a></h5>
        </div>
    </div>


    <section class="productlist">
        <?php foreach ($products as $product):  ?>
        <div>
            <div class="card product-container">
                <img src="../../assets/images/<?php echo htmlspecialchars($product['img_name']) ?>" width="25%" class="card-img-top" alt="...">
                <div class="card-body product-infos" >
                    <p class="card-text" style="color:#013F62"><?php echo htmlspecialchars($product['item_name']) ?></p>
                    <p style="opacity:0.7; font-size:0.8rem">price:<?php echo htmlspecialchars($product['item_price'])."RWF" ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="hidden" name="item_id" value="<?php echo $product['item_id']; ?>">   
                        <div class="card-buttons">
                            <button type="submit" name="mark_sold" id="sold" style="background-color:#0F5909;">Mark as sold</button>
                            <button type="submit" name="edit" id="edit" style="background-color:#013F62;">Edit details</button>
                            <button type="submit" name="delete" id="delete" style="background-color:#620102;">Delete</button>
                        
                        </div>
                    </form>
                </div>
                
            </div>
            <hr style="background-color:#D7D7D7;">  
        </div>
        <?php endforeach; ?>
    </section>
    </main>
    <?php require_once "../../includes/footer.php" ;
        render_footer("../home.php", './category.php', '#', "./settings.php")
    ?>  
</body>
</html>