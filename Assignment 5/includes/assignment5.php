<?php echo $PHP_SELF;

First:<input type="text" size="12" maxlength="12" name="First">:<br />
Last :<input type="text" size="12" maxlength="36" name="Last">:<br />


<textarea rows="5" cols="20" name="Comment" wrap="physical">Enter Comment!</textarea>:<br />



Select a Level of Education:<br />
<select name="Department">
<option value="STEM">STEM</option>
<option value="ART">ART</option>
<option value="Education">Education</option></select>:<br />

Gender residence::<br />
Male:<input type="checkbox" value="Male" name="food[]">:<br />
Female:<input type="checkbox" value="Female" name="food[]">:<br />
Tumbler:<input type="checkbox" value="Something from Tumbler" name="food[]">:<br />

<form action="" method="post">
<input type="Punk" name="radio" value="Punk">Punk
<input type="Rock" name="radio" value="Rock">Rock
<input type="Country" name="radio" value="Country">Country
<input type="submit" name="submit" value="Get Selected Values" />
</form>
<?php
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
echo "You have selected :".$_POST['radio'];  //  Displaying Selected Value
}


?>



