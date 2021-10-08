<?php session_start(); ?>
<?php require_once "../includes/database.php";?>
<?php
    if(!isset($_GET['id'])){
        header('location:../includes/index.php');
    }elseif(!isset($_SESSION['user_id']) or !isset($_SESSION['email']) or $_SESSION['user_type'] != "user" ){
        header('location:login.php');

    }else{
        $u_id=$_SESSION['user_id'];
        $p_id=$_GET['id'];
        $o_id=0;
        $q0="select o_id from order_details where p_id=:p_id and u_id=:u_id and status=:st";
        $chkOrder=$connect->prepare($q0);
        $chkOrder->execute([':p_id'=>$p_id,':u_id'=>$u_id,':st'=>0]); 
        $orderDetails=$chkOrder->fetch(PDO::FETCH_OBJ);
        
        if($chkOrder->rowCount()==0){
            $sql="insert into order_details (p_id,u_id,o_qty) values(:p_id,:u_id,:o_qty)";
            $add=$connect->prepare($sql);
            $add->execute([':p_id'=>$p_id,':u_id'=>$u_id,':o_qty'=>1]);
        }else{
           $o_id=$orderDetails->o_id;

        }
        
        
        $q1="select * from product where p_id=:id "; // product details
        $query1=$connect->prepare($q1);
        $query1->execute([":id"=>$p_id]);
        $p_details=$query1->fetch(PDO::FETCH_OBJ);



        if($_SERVER['REQUEST_METHOD']=='POST'){
            $qty=$_REQUEST['p_qty'];
            $cust_name=$_REQUEST['cust_name'];
            $d_pin=$_REQUEST['d_pin'];
            $h_no=$_REQUEST['h_no'];
            $d_area=$_REQUEST['d_area'];
            $d_city=$_REQUEST['d_city'];
            $d_state=$_REQUEST['d_state'];
            $mobile=$_REQUEST['mobile'];
            $totalAmount=$_REQUEST['amount'];
            $q2="update order_details set o_qty=:qty,d_name=:name,d_pin=:pin,d_hno=:h_no,
                d_area=:area,d_city=:city,d_state=:state,c_no=:contact,amount=:amount where o_id=:o_id";
            $query2=$connect->prepare($q2);
            if($query2->execute([':qty'=>$qty,':name'=>$cust_name,':pin'=>$d_pin,':h_no'=>$h_no,':area'=>$d_area,':city'=>$d_city,':state'=>$d_state,':contact'=>$mobile,':amount'=>$totalAmount,'o_id'=>$o_id])){
                $_SESSION['o_id']=$o_id;
                header('location:payment.php');
            }
        }
               
        
    }
?>


<?php include_once "../includes/header.php"; ?>
<center>
    <div class="card" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center"><?=$p_details->title; ?></h3>
            <img src="../images/<?=$p_details->image; ?>" style="max-width: 300px;" class="card-img img-fluid d-block mx-auto" alt="">
            
            <h5 class="card-text text-center">Please Fill The Form to Complete Your order</h5>
            <form action="" method="post" name="buy_form" onsubmit="return buyNow()">
                <div class="form-group input-group ">
                    <input name="p_qty" autocomplete=""  oninput="calTotalPrice()" class="form-control" value="1" type="number">
                </div>
                <div class="form-group input-group ">    
                    <input name="cust_name" autocomplete="" class="form-control" placeholder="Enter Customer name" type="text">
                </div>
                <div class="form-group input-group ">
                    <input name="d_pin" autocomplete="" class="form-control" placeholder="Enter Your Pin Code" type="text">
                </div>
                <div class="form-group input-group ">
                    <input name="h_no" autocomplete="" class="form-control" placeholder="Enter Your House No " type="text">
                </div> 
                <div class="form-group input-group wi">   
                    <input name="d_area" autocomplete="" class="form-control" placeholder="Enter Your Area" type="text">
                </div>
                <div class="form-group input-group ">
                    <input name="d_city" autocomplete="" class="form-control" placeholder="Enter Your City" type="text">
                </div>
                <div class="form-group input-group ">
                    <input name="d_state" autocomplete="" class="form-control" placeholder="Enter Your State" type="text">
                </div>
                <div class="form-group input-group ">
                    <input name="mobile" autocomplete="" class="form-control" placeholder="Enter Your contact Number" type="text">
                </div>
                <input name="price" type="hidden" value="<?=$p_details->price; ?>">
                <div class="form-group input-group ">
                    <p>Total Amount =</p><input name="amount" id="totalAmount" value="<?=$p_details->price; ?>" readonly></input>
                </div>
                <div class="form-group input-group ">
                    <button type="submit" class="btn btn-block btn-danger">Complete Payment</button>
                </div>
            </form>
        </div>
    </div>
</center>


<?php include_once "../includes/footer.php"; ?>
