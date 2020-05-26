<?php
require("../connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST["name"];

    $stmt = $conn->prepare("INSERT INTO list (name) VALUES (:name);");
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    header("Location: ../index.php");
} else {
    include("../head.php");
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter list name" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" name="submit" class="btn btn-primary">submit</button>
                        <button type="submit" name="submit" class="btn btn-primary"><a class="text-white" href="../index.php">cancel</a></button>
                    </div>

                </form>
            </div>
        </div>
    </div>


<?php
    include("../footer.php");
}
?>