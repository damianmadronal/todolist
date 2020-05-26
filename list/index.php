<?php
require("../connect.php");

$id = $_GET['id'];

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'no';
}

if ($sort == 'up') {
    $stmt = $conn->prepare("SELECT * FROM task where list_id=:id ORDER BY name ASC");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
} elseif ($sort == 'down') {
    $stmt = $conn->prepare("SELECT * FROM task where list_id=:id ORDER BY name DESC");

    $stmt->bindParam(":id", $id);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT * FROM task where list_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}
$tasks = $stmt->fetchAll();

$stmt2 = $conn->prepare("SELECT * FROM list where id = :id");
$stmt2->bindParam(":id", $id);
$stmt2->execute();

$list = $stmt2->fetch();


include("../head.php");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <button class="my-2 btn btn-primary"><a class="text-white" href="../../index.php">Home</a></button>
            <button class="btn btn-primary my-2"><a class="text-white" href="../../task/create.php/?list_id=<?= $list['id'] ?>&sort=<?= $sort ?>">Add task</a></button>

            <div class="row">
                <div class="col">
                    <h1>List: <?= $list['name'] ?></h1>
                </div>
                <div class="col">
                    <div class="button-group">
                        <button onclick="showList('all')" type="button" class="btn btn-primary">Show all</button>
                        <button onclick="showList('0')" type="button" class="btn btn-primary">Show completed</button>
                        <button onclick="showList('1')" type="button" class="btn btn-primary">Show uncompleted</button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th onmouseover="" style="cursor: pointer;" id="name-sort" scope="col">name <i class="fas fa-arrow-<?= $sort ?>" id="arrow"></i></th>
                        <th scope="col">description</th>
                        <th scope="col">time</th>
                        <th scope="col">status</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tasks as $task) {

                    ?>
                        <tr class="listItem
                        <?php
                        if ($task['status'] == 0) {
                            echo "status0";
                        } else {
                            echo "status1";
                        }
                        ?>">
                            <th scope="row"><?= $task['name'] ?></th>
                            <td>
                                <button type="button" style="background-color:transparent; border:none;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="display-4 text-dark">Description</div>
                                                <p class="text-dark text-break">
                                                    <?= $task['description'] ?>
                                                </p>
                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td><?= $task['duur'] ?></td>
                            <td><?php
                                if ($task['status'] == 0) {
                                    echo "uncompleted";
                                } else {
                                    echo "completed";
                                } ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary"><a class="text-white" href="../../task/update.php/?id=<?= $task['id'] ?>&list_id=<?= $list['id'] ?>">Edit</a></button>
                                    <button class="btn btn-danger"><a class="text-white" href="../../task/delete.php/?id=<?= $task['id'] ?>&list_id=<?= $list['id'] ?>">Delete</a></button>
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

<script>
    function showList(status) {
        var listItems = document.getElementsByClassName("listItem");
        var lists = document.getElementsByClassName("status" + status);
        for (const list of listItems) {
            list.hidden = false;
        }
        for (const list of lists) {
            list.hidden = true;
        }
    }

    document.getElementById("name-sort").onclick = function() {
        var arrow = document.getElementById("arrow");
        var sort = "<?= $sort ?>";
        if (sort == "no") {
            window.location.href = "?id=<?= $id ?>&sort=up";
        }
        if (sort == "up") {
            window.location.href = "?id=<?= $id ?>&sort=down";
        } else {
            window.location.href = "?id=<?= $id ?>&sort=up";
        }
    };
</script>