<?php session_start(); 
require('./backend/dbcon.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./../dist/output.css" rel="stylesheet">
    <title>Church Management</title></title>  
  </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">

                    <?php if (isset($_SESSION['message'])) : ?>
                        <h5 class="alert alert-success"><?php echo $_SESSION['message']; ?></h5>
                    <?php unset($_SESSION['message']);
                    endif; 
                    ?>
<!--*****************************************************************EGLISE START*******************************************************************-->
                    <div class="card">
                        <div class="card-header">
                            <h3>CHURCH
                                <a href="./frontend/church_add.php" class="bg-[blue] text-[#f2f2f2] py-2 px-[50px] rounded-lg">Add Church</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Designation</th>
                                        <th>Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM EGLISE";
                                        $statement = $conn->prepare($query);
                                        $statement->execute();

                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        if($result){
                                            foreach($result as $row){
                                                ?>
                                                <tr>
                                                    <td><?= $row->ideglise ?></td>
                                                    <td><?= $row->design ?></td>
                                                    <td><?= $row->solde ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="3">No record found</td>
                                            </tr>
                                            <?php

                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
<!--*****************************************************************EGLISE END*******************************************************************-->

<!--*****************************************************************ENTREE START*******************************************************************-->
                        <div class="card-header">
                            <h3>INCOME
                                <a href="./frontend/income_add.php" class="btn btn-primary float-end">Add income</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Eglise</th>
                                        <th>Motif</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = "SELECT * FROM ENTREE";
                                        $statement = $conn->prepare($query);
                                        $statement->execute();

                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        if($result){
                                            foreach($result as $row){
                                                ?>
                                                <tr>
                                                    <td><?= $row->identre ?></td>
                                                    <td><?= $row->ideglise ?></td>
                                                    <td><?= $row->motif ?></td>
                                                    <td><?= $row->montantEntre ?></td>
                                                    <td><?= $row->dateEntre ?></td>
                                                    <td>
                                                        <a href="income_edit.php?id=<?= $row->identre ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="5">No record found</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
<!--*****************************************************************ENTREE END*******************************************************************-->

<!--*****************************************************************SORTIE START*******************************************************************-->
                        <div class="card-header">
                            <h3>COST
                                <a href="./frontend/cost_add.php" class="btn btn-primary float-end">Add Cost</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Eglise</th>
                                        <th>Motif</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = "SELECT * FROM SORTIE";
                                        $statement = $conn->prepare($query);
                                        $statement->execute();

                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        if($result){
                                            foreach($result as $row){
                                                ?>
                                                <tr>
                                                    <td><?= $row->idsortie ?></td>
                                                    <td><?= $row->ideglise ?></td>
                                                    <td><?= $row->motif ?></td>
                                                    <td><?= $row->montantSortie ?></td>
                                                    <td><?= $row->dateSortie ?></td>
                                                    <td>
                                                        <a href="cost_edit.php?id=<?= $row->idsortie ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="5">No record found</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>                  
<!--*****************************************************************SORTIE END*******************************************************************-->
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
