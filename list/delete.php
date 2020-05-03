<?php
require("../connect.php");


$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM list WHERE id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();

header("Location: ../../index.php");

include("../head.php");

?>


<?php
include("../footer.php")
?>