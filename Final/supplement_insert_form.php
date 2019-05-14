<html>
<head>
    <title>Apex Predator Supplements</title>
</head>
<body>
<div id="order_form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
        Game Type: <select name="supplement_type" id="supplement_type" size="1">
            <option value="JYM " <?php if(isset($supplement_type) && ($supplement_type=='JYM')) echo "selected='selected'"; ?> >JYM </option>
            <option value="BSN" <?php if(isset($supplement_type) && ($supplement_type=='BSN')) echo "selected='selected'"; ?>>BSN</option>
            <option value="Myofusion"<?php if(isset($supplement_type) && ($supplement_type=='Myofusion')) echo "selected='selected'"; ?>>Myofusion</option>
            <option value="Muscle Milk"<?php if(isset($supplement_type) && ($supplement_type=='Muscle Milk')) echo "selected='selected'"; ?>>Muscle Milk</option>
            <option value="Kaged Muscle"<?php if(isset($supplement_type) && ($supplement_type=='Kaged Muscle')) echo "selected='selected'"; ?>>Kaged Muscle</option>
            <option value="Optimum Nutrtion"<?php if(isset($supplement_type) && ($supplement_type=='Optimum Nutrtion')) echo "selected='selected'"; ?>>Optimum Nutrtion</option>
            
</select> 
</div>
<?php
$supplement_quantity_array = range(1,1000);
?>
<div>
    Supplement Quantity: <select name="supplement_quantity" id="supplement_quantity">
        <?php
        foreach($supplement_quantity_array as $value){
            echo"<option value='$value'";
            if (isset($supplement_quantity)&&($supplement_quantity==$value)) { echo "selected='selected'";}
            echo ">$value</option>";
            }
            ?>
            </select>
     </div>
      
     <div>
        Price: <input type="text" name="price" id="price" size="20" maxlength="30" value="<?php if(isset($price)) {
            echo $price;
        }?>" />
        </div>
      
     <div>
        Photo: <input type="file" name="photo" id="photo"size="20" maxlength="30" />
     </div>
  <div>
   <input type="hidden" name="hidden_field" value="form submitted" />
        <input type="submit" value="Submit" />
        <input type="reset" value="Reset" />
        </div>
    </form>
    </div>
    </body>
    </html>