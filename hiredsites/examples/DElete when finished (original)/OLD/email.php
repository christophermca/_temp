
<?

$destination="droscoe@comcast.net";
$name=$_POST['name'];
$email=$_POST['email'];
$mes=$_POST['comments'];
$subject="Message from $name" ;
$mes="Name : $name\n
Email: $email\n
Comments: $mes\n";
mail($destination,$subject,$mes); ?>
