<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user'){
    $showLogin = true;
} else {
    $showLogin = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faqja ime</title>
</head>
<body>
<?php
if($showLogin){
    echo "Ju lutem logohuni për të vazhduar.";
} else {
    echo "Mirësevini në faqen e porosive!";
}
?>
</body>
</html>
