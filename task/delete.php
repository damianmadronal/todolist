<?php
require("../connect.php");


$id = $_GET['id'];
$list_id = $_GET['list_id'];


$stmt = $conn->prepare("DELETE FROM task WHERE id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();

header("Location: ../../list/index.php/?id=$list_id");
