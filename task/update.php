<?php
require("../connect.php");


$id = $_GET['id'];
$list_id = $_GET['list_id'];

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $duur = $_POST["duur"];
    $status = $_POST["status"];

    $stmt = $conn->prepare("UPDATE task SET name=:name, duur=:duur, status=:status, description=:description WHERE id=:id");

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":duur", $duur);
    $stmt->bindParam(":status", $status);
    $stmt->execute();

    header("Location: ../../list/index.php/?id=$list_id");
}

$stmt = $conn->prepare("SELECT * FROM task WHERE id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$task = $stmt->fetch();
include("../head.php");
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id=$id&list_id=$list_id"); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter task name" value="<?= $task['name'] ?>" required>
            <label for="name">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Enter description" rows="3" value="<?= $task['description'] ?>" required> </textarea>
            <label for="duur" class="col-form-label">duur</label>
            <input required class="form-control" type="time" id="duur" name="duur" value="<?= $task['duur'] ?>">
            <label class="col-form-label" for="status">Status</label>
            <select name="status" class="form-control form-control-sm" required>
                <option value="0">uncompleted</option>
                <option value="1">completed</option>
            </select>
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