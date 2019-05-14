<div id="order_form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                Order ID: <input type="text" name="supplement_orders_id" id="supplement_orders_id" size="16" maxlength="16" value="<?php if(isset($supplement_orders_id)) echo $supplement_orders_id; ?>"/>
                User ID: <input type="text" name="user_id" id="user_id" size="16" maxlength="16" value="<?php if(isset($user_id)) echo $user_id; ?>"/>
                </div>
 
            <?php
            $month_array = array(0 =>'','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $day_array = range(1,31);
            $year_array = range(2014, 2064); 
            ?>
            <div>
                <fieldset><legend>Payment Day:</legend>
                    Month<select name="month" id="month">
                        <?php
                        for ($i = 0; $i < count($month_array); $i++){
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
        <input type="hidden" name="hidden_field" value="form submitted" />
        <input type="submit" value="Submit" />
        <input type="reset" value="Reset" />
        </div>
    </form>
</div>