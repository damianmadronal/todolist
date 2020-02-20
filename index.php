<?php
include("head.php");

$stmt = $conn->prepare("SELECT * FROM list");
$stmt->execute();

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <button class="btn btn-primary my-2"><a href="list/create.php">Add list</a></button>
                <button class="btn btn-primary my-2"><a href="task/create.php">Add task</a></button>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Lijsten</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($stmt->fetchAll() as $list) {
                        ?>
                            <tr>
                                <th scope="row"><a class="text-primary" href="list/index.php/?id=<?= $list['id']; ?>"><?= $list['id'] ?></a></th>
                                <td><a href="#"><?= $list['name'] ?></a></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary"><a href="list/update.php/?id=<?= $list['id'] ?>">Edit</a></button>
                                        <button class="btn btn-danger"><a href="list/delete.php/?id=<?= $list['id'] ?>">Delete</a></button>
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
    include("footer.php")
    ?>