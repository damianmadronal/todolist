<?php
include("../head.php");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM task where list_id=:id and status = 0");
$stmt->bindParam(":id", $id);
$stmt->execute();

$stmt2 = $conn->prepare("SELECT * FROM list where id = :id");
$stmt2->bindParam(":id", $id);
$stmt2->execute();

$list_id = $stmt2->fetch();


?>
<div class="container">
    <div class="row">
        <div class="col">
            <button class="my-2 btn btn-primary"><a class="text-white" href="../../index.php">Home</a></button>
            <h1>List: <?= $stmt2->fetch()['name'] ?></h1>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">name</th>
                        <th scope="col">duur</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($stmt->fetchAll() as $task) {
                    ?>
                        <tr>
                            <th scope="row"><?= $task['name'] ?></th>
                            <td><?= $task['duur'] ?></td>
                            <td><?= $task['status'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary"><a class="text-white" href="../../task/update.php/?id=<?= $task['id'] ?>&list_id=<?= $list_id['id'] ?>">Edit</a></button>
                                    <button class="btn btn-danger"><a class="text-white" href="../../task/delete.php/?id=<?= $task['id'] ?>&list_id=<?= $list_id['id'] ?>">Delete</a></button>
                                </div>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include("../footer.php")
?>