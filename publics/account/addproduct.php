<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once "../../includes/checkinput.php";
require_once "../../includes/session.php";

$item=['item_id'=>'','item_created_at'=>'','item_status'=>'available', 'item_deadline'=>'' ,'name'=>'','brand'=>'','material'=>'', 'price'=>'', 'quantity'=>1 , 'category'=>'','description'=>'','image'=>'','image_temp'=>''];
$errors=['name'=>'','price'=>'','category'=>'','image'=>''];
$folder='';
$publication=['pub_id'=>'','pub_created_at'=>''];
if(isset($_POST['additem'])){
    // check if the user provided the name of item
    if(empty($_POST['item_name'])){
        $errors['name']="Item name is required";
    }else{
        $item['name']=checkinput($_POST['item_name']);
    }
    // check if the user provided the price of the item
    if(empty($_POST['item_price'])){
        $errors['price']="Item price is required";
    }else{
        $item['price']=checkinput($_POST['item_price']);
    }

    // check if the user provided the category of the item
    if(empty($_POST['item_category']) || $_POST['item_category']=="Product category"){
        $errors['category']="The category is required";
    } else{
        $item['category']=checkinput($_POST['item_category']);
    }
   

    // check if the user provided an image for the item
    if(isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK){
        $item['image']=$_FILES['item_image']['name'];
        $item['image_temp']=$_FILES['item_image']['tmp_name'];
        $folder="../../assets/images/".$item['image'];
        if(move_uploaded_file($item ['image_temp'], $folder)){

        }else{
            $errors['image']="image not uploaded";
        }
    }

    if(!empty($_POST['item_brand'])){
        $item['brand']=$_POST['item_brand'];
    }

    if(!empty($_POST['item_material'])){
        $item['material']=$_POST['item_material'];
    }

    if(!empty($_POST['item_quantity'])){
        $item['quantity']=$_POST['item_quantity'];
    }
    if(!empty($_POST['item_description'])){
        $item['description']=$_POST['item_description'];
    }
    if(!empty($_POST['item_deadline'])){
        $item['item_deadline']=$_POST['item_deadline'];
    }else{
        $item['item_deadline']="2026-12-30";
    }

    $item['item_id']='item_'.random_int(100000, 999999);
    $item['item_created_at']=date("Y-m-d H:i:s");

    $num_error=0;

    foreach($errors as $error){
        if(!empty($error)){
            $num_error+=1;
        }
    }

    if($num_error==0){
        try{
            $stm=$conn->prepare("INSERT into item(item_id, item_name, item_brand, item_material, item_price, item_quantity, item_seller, item_status, item_description, item_category, item_deadline, item_created_at) values(:item_id, :item_name, :item_brand, :item_material, :item_price, :item_quantity, :item_seller, :item_status, :item_description, :item_category, :item_deadline, :item_created_at)");
            $datas=[
            ':item_id'=>$item['item_id'], 
            ':item_name'=>$item['name'], 
            ':item_brand'=>$item['brand'], 
            ':item_material'=>$item['material'], 
            ':item_price'=>$item['price'], 
            ':item_quantity'=>$item['quantity'], 
            ':item_seller'=>$cust_id, 
            ':item_status'=>$item['item_status'], 
            ':item_description'=>$item['description'], 
            ':item_category'=>$item['category'], 
            ':item_deadline'=>$item['item_deadline'], 
            ':item_created_at'=>$item['item_created_at']
            ];
            $stm->execute($datas);

            $img_id="img_".random_int(100000,999999);

            $stmt=$conn->prepare("INSERT INTO image(img_name, item_id, img_id) VALUES(:img_name, :item_id, :img_id)");
            $stmt->bindParam(':img_name',$item['image']);
            $stmt->bindParam(':item_id',$item['item_id']);
            $stmt->bindParam(':img_id',$img_id);
            $stmt->execute();
            
            $publication['pub_created_at']=date("Y-m-d H:i:s");
            $publication['pub_id']="pub_".random_int(100000,999999);

            $stmt1=$conn->prepare("INSERT INTO publication(publication_id,item_id ,seller_id,publication_created_at, img_id) values(:publication_id, :item_id,:seller_id,:publication_created_at, :img_id) ");
            $stmt1->bindParam(':publication_id',$publication['pub_id']);
            $stmt1->bindParam(':item_id',$item['item_id']);
            $stmt1->bindParam(':seller_id',$cust_id);
            $stmt1->bindParam(':publication_created_at',$publication['pub_created_at']);
            $stmt1->bindParam(':img_id',$img_id);
            $stmt1->execute();
            header("Location: ./successpage.php");
        }catch(Exception $e){
            echo $e;
        }
    }    
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header2.css" >
    <link rel="stylesheet" href="../../assets/css/addproduct.css" >
    <link rel="stylesheet" href="../../assets/css/footer.css">

    <title></title>
</head>
<body>
    <?php require_once "../../includes/header2.php" ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
         <h4>LIST A NEW PRODUCT</h4>
        <div class="form-container">

        <!-- Item name -->
            <div class="error"><?php echo $errors['name']; ?></div>
            <div class="mb-3 input-wrapper">
                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Product name. Example: Shoes, T-shirt...">
            </div>

            <!-- Item brand -->
            <div class="mb-3 input-wrapper">
                <input type="text" class="form-control" name="item_brand" id="item_brand" placeholder="Product brand. Example: Nike, addidas...">
            </div>
            <!-- Item material -->
            <div class="mb-3 input-wrapper">
                <input type="text" class="form-control" name="item_material" id="item_material" placeholder="Product material. Example: wood, leather ...">
            </div>

            <!-- product price -->
            <div class="error"><?php echo $errors['price']; ?></div>
            <div class="mb-3 input-wrapper">
                <input type="text" class="form-control" id="item_price" name="item_price" placeholder="Product price. Example: 10000 Rwf...">
            </div>

            <!-- product quantity -->
            <div class="mb-3 input-wrapper">
                <input type="text" class="form-control" id="item_quantity" name="item_quantity" placeholder="Product quantity. Example:2,3...">
            </div>

            <!-- item category -->
            
            <div class="form-floating input-wrapper ">
                <div class="error"><?php echo $errors['category']; ?></div>
                <select class="form-select" id="item_category" name="item_category" aria-label="Floating label select example">
                    <option selected>Product category</option>
                    <option value="house furnitures">House Furnitures</option>
                    <option value="shoes and clothes">Shoes & Clothes</option>
                    <option value="electronics">Electronics</option>
                    <option value="makeup and beauty">Makeup & Beauty</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <!-- item description -->
            <div class="mb-3 input-wrapper">
                <textarea class="form-control" name="item_description" aria-label="With textarea" placeholder="Here you can add more information about your product "></textarea>
            </div>

            <!-- file image -->
            <div class="error"><?php echo $errors['image']; ?></div>
            <div class="input-group mb-3 input-wrapper">
                <input type="file" class="form-control" name="item_image" id="product_image">
            </div>

            <!-- item deadline -->
            <div class="mb-3 input-wrapper"> 
                <label for="item_deadline" class="form-label">Add a deadline if you are leaving soon</label><br>
                <input type="date" class="form-control" id="item_deadline" name="item_deadline">
            </div>

            <div class="submitbut">
                <input type="submit" value="Add new product" name="additem" id="additem">
            </div>


        </div>
    </form>
    <?php require_once "../../includes/footer.php" ;
        render_footer("../home.php", '#', "./dashboard.php", "./settings.php")
    ?>
</body>
</html>