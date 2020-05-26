<?php
require("../connect.php");

$list_id = $_GET['list_id'];

$sort = $_GET['sort'];

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM list");
$stmt->execute();


if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $duur = $_POST["duur"];

    $stmt = $conn->prepare("INSERT INTO task (name, description, duur, list_id) VALUES (:name, :description, :duur, :list_id);");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":list_id", $list_id);
    $stmt->bindParam(":duur", $duur);
    $stmt->execute();

    header("Location: ../../list/index.php/?id=$list_id&sort=$sort");
} else {

    include("../head.php");
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?list_id=$list_id&sort=$sort"); ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter task name" required>
                        <label for="name">Description</label>
                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Enter description" rows="3" required></textarea>
                        <label for="duur" class="col-form-label">duur</label>
                        <input required class="form-control" type="time" id="duur" name="duur">
                    </div>
                    <div class="button-group">
                        <button type="submit" name="submit" class="btn btn-primary">submit</button>
                        <button type="submit" name="submit" class="btn btn-primary"><a class="text-white" href="../../list/index.php/?id=<?= $id ?>">cancel</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
    include("../footer.php");
}
?>