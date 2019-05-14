<!doctype html>
<html>
<head>
<title>Apex Predator Supplement</title>
</head>
<body>
<div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
        Game Type: <select name="supplement_type" id="supplement_type" size="1">
            <option value="JYM" <?php if(isset($supplement_type) && ($supplement_type=='JYM')) echo "selected='selected'"; ?> >JYM </option>
            <option value="BSN" <?php if(isset($supplement_type) && ($supplement_type=='BSN')) echo "selected='selected'"; ?>>BSN</option>
            <option value="Myofusion"<?php if(isset($supplement_type) && ($supplement_type=='Myofusion')) echo "selected='selected'"; ?>>Myofusion</option>
            <option value="Muscle Milk"<?php if(isset($supplement_type) && ($supplement_type=='Muscle Milk')) echo "selected='selected'"; ?>>Muscle Milk</option>
            <option value="Kaged Muscle"<?php if(isset($supplement_type) && ($supplement_type=='Kaged Muscle')) echo "selected='selected'"; ?>>Kaged Muscle</option>
            <option value="Optimum Nutrtion"<?php if(isset($supplement_type) && ($supplement_type=='Madden 15')) echo "selected='selected'"; ?>>Optimum Nutrtion</option>
            
        </select> 
        Supplement Quantity: <input type="text" name="type_quantity" id="type_quantity" <?php if (isset($type_quantity)) echo $type_quantity; ?>
        </div>
        <div>
            <fieldset>
                <legend>Credit Card</legend>
                Visa <input type="radio" name="type" id="visa" value="visa" <?php if(isset($type)&&($type=='visa')) echo "checked='checked'"  ?>/>
                Master Card <input type="radio" name="type" id="master" value="master" <?php if(isset($type)&&($type=='master')) echo "checked='checked'"  ?> />
                American Express <input type="radio" name="type" id="american_express" value="american_express" <?php if(isset($type)&&($type=='american_express')) echo "checked='checked'"  ?>/>
                Discover <input type="radio" name="type" id="discover" value="discover" <?php if(isset($type)&&($type=='discover')) echo "checked='checked'"  ?> />
                <div>
                Credit Card #: <input type="text" name="no" id="no" size="16" maxlength="16" value="<?php if(isset($no)) echo $no; ?>"/>
                Security Code #: <input type="text" name="security_code" id="security_code" size="3" maxlength="3" value="<?php if(isset($security_code)) echo $security_code; ?>"/>
                </div>
            </fieldset>
         </div>
            <?php
            $month_array = array(1 =>'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $day_array = range(1,31);
            $year_array = range(2014, 2064); 
            ?>
            <div>
                <fieldset><legend>Payment Day:</legend>
                    Month<select name="month" id="month">
                        <?php
                        for ($i = 1; $i <= count($month_array); $i++){
                            if(isset($month) && $month==$month_array[$i]) {
                                 echo "<option value='$month_array[$i]' selected = 'selected'>$month_array[$i]</option>";
                                 } else {
                                 echo "<option value='$month_array[$i]'>$month_array[$i]</option>";                                 
                                 }
                        }
                        ?>
                    </select>
                    Day <select name="day" id="day">
                        <?php    
                        $j =0;
                        while($j < count($day_array)){
                            if(isset($day) && ($day==$day_array[$j])) {
                                echo "<option value='$day_array[$j]' selected='selected'>$day_array[$j]</option>";
                            } else {
                                echo "<option value='$day_array[$j]'>$day_array[$j]</option>";
                            }
                            $j++;
                        }
                        ?>
                    </select>
                    Year <select name="year" id="year">
                        <?php
                        foreach($year_array as $value){
                            if(isset($year) && ($year==$value)) {
                                echo "<option value='$value' selected='selected'>$value</option>";
                            } else {
                                echo "<option value='$value'>$value</option>";
                            }
                        }
                        ?>
                    </select>                                        
                </fieldset>            
            </div>
             
            <div>   
            <fieldset>
            <legend>Shipping Information</legend>
            UPS <input type="radio" name="carrier" id="ups" value="ups" <?php if(isset($carrier))echo "checked='checked'"; ?>/>
            USPS <input type="radio" name="carrier" id="usps" value="usps" <?php if(isset($carrier))echo "checked='checked'"; ?> />
            FEDEX <input type="radio" name="carrier" id="fedex" value="fedex" <?php if(isset($carrier)) echo "checked='checked'"; ?>/>
            <div>
            Method :
            <select id="shipping_method" name="shipping_method" size="1">
                <option value="ground" <?php if(isset($shipping_method) && ($shipping_method=='ground'))
                    echo "selected='selected'"; ?>                
                >Ground</option>
                <option value="express"<?php if(isset($shipping_method) && ($shipping_method=='express'))
                    echo "selected='selected'"; ?>  >Express</option>
            </select>
            </div>
            </fieldset>       
        </div>
         
        <fieldset><legend> Shipping and Billing Address</legend>
        <div>
            House #: <input type="text" name="house" id="house"
            <?php if(isset($house)) echo 'value="'.$house.'"'; ?>
            />
        </div>
         <div>
            Street Name: <input type="text" name="street" id="street"
            <?php if(isset($street)) echo 'value="'.$street.'"'; ?>
            />
        </div>
         <div>
            City Name: <input type="text" name="city" id="city"
            <?php if(isset($city)) echo 'value="'.$city.'"'; ?>
            />
        </div>
        <div>
        <?php $states_array = array('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL', 'IN', 'IA',  'KS','KY','LA','ME','MD', 'MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK', 'OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY');
?>
        State:
        <select id="state" name="state">  
          <?php for($i= 0; $i < count($states_array); $i++) {
                if(isset($state)&&$state == $states_array[$i]) {
                    echo "<option value=\"$states_array[$i]\" selected=\"selected\">$states_array[$i]</option";
                } else {
                    echo "<option value=\"$states_array[$i]\">$states_array[$i]</option>"; 
                }
            } ?>
            </select>
            </div>
            <div>
            Zip Code: <input type="text" name="zip" id="zip"
            <?php if(isset($zip)) echo 'value="'.$zip.'"'; ?>
            />
            </div>
            </fieldset>
             
             
            <div>
                Instructions:<br/>
                <textarea name="instructions" id="instructions" rows="5" cols="50"><?php if(isset($instructions)) { 
                    echo $instructions;
                    } else { 
                    echo "Special Delivery Instructions...";} ?></textarea>     
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