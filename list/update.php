<?php
include("../head.php");

$id = $_GET['id'];

if (isset($_POST["submit"])) {
    $name = $_POST["name"];

    $stmt = $conn->prepare("UPDATE list SET name=:name WHERE id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    header("Location: ../../index.php");
}

$stmt = $conn->prepare("SELECT * FROM list WHERE id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$list = $stmt->fetch();
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id=$id"); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?= $list['name'] ?>" required>
        </div>
        <div class="button-group">
            <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            <button type="submit" name="submit" class="btn btn-primary"><a class="text-white" href="../../index.php">cancel</a></button>
        </div>
    </form>
</div>


<?php
include("../footer.php")
?>