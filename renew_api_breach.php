<html>

</html>
<?php

//generamos una password automática
function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890123456788901234554.*..**....**..**';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 10; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

function randomUser() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyz';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 15; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}


$name = randomUser();
$password = randomPassword();

echo "<h3> Renew BreachDirectory API</h3>";
echo "Step 1: Create account on BreachDirectory <a href='https://rapidapi.com/auth/sign-up?referral=/rohan-patra/api/breachdirectory' target='_blank'>Here</a><br>";
echo "Step 2: Use this generated user and password to register: <br>";
echo "<ul><li><b>Generated name:</b>".$name."</li>";
echo "<li><b>Generated password:</b> ".$password."</li></ul>";
echo "Step 3: Use this online mail generator to create account <a href='https://tempmail.dev/es/Gmail' target='_blank'>Here</a>";

?>
