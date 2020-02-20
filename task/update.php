<?php
include("../head.php");

$id = $_GET['id'];
$list_id = $_GET['list_id'];


if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $duur = $_POST["duur"];

    $stmt = $conn->prepare("UPDATE task SET name=:name, duur=:duur WHERE id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":duur", $duur);
    $stmt->execute();

    header("Location: ../../list/index.php/?id=$list_id");
}

$stmt = $conn->prepare("SELECT * FROM task WHERE id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$task = $stmt->fetch();
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id=$id&list_id=$list_id"); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter task name" value="<?= $task['name'] ?>" required>
            <label for="duur" class="col-form-label">duur</label>
            <input required class="form-control" type="time" id="duur" name="duur" value="<?= $task['duur'] ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>
</div>


<?php
include("../footer.php")
?>