<?php session_start(); 
    require('./backend/dbcon.php');
    require('./function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/output.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./script/cst_modal_script.js" defer></script>
    <style>
        .cst{
            background-color: #A66D58;
        }
        .cst:hover{
            background-color: #A66D58;
        }
    </style>
    <title>Church</title>
</head>
<body>
    <div class="pr-20 relative h-full">
        <div class="flex flex-row items-start h-full">
            <?php
                include('./frontend/nav.php');
            ?>
            <div class="w-[80%] flex flex-col h-[100vh] pl-52 ml-52">
                <div class="flex flex-row justify-between items-center  py-14 w-[100%] pl-20 mb-16">
                    <div class="flex flex-row justify-between items-center w-full">
                        <form method="post" class="flex flex-row justify-start w-[90%]">
                            <input type="search" class="w-[55%] rounded-l-3xl shadow-md pl-3" placeholder="Search costs by 'Motif'" name="search" id="">
                            <button type="submit" class="bg-[#4F758C] shadow-md rounded-r-3xl flex flex-row justify-center items-center cursor-pointer" name="search_entree"><img class="py-1 w-[80%] h-[80%] text-[#f0f2f0]" src="./assets/icons/search.svg" alt=""></button>
                        </form>
                        <div class="bg-[#4F758C] px-2 py3 rounded-lg" id="add_new_cst">
                            <h3 class="px-3 py-2 text-[#F0F2F0] cursor-pointer">Add New</h3>
                        </div>
                    </div>
                </div>
                <div class="">
                    <?php

                        if(isset($_GET['id'])){
                            $id_eglise = test_input($_GET['id']);
                            $titre_design = "SELECT * FROM EGLISE WHERE ideglise = :id_eglise";
                            $set_titre = $conn->prepare($titre_design);
                            $titre = [":id_eglise" => $id_eglise];

                            $set_titre->execute($titre);
                            $result_title = $set_titre->fetchAll(PDO::FETCH_OBJ);
                        }
                        if($result_title){
                            foreach( $result_title as $row ){
                    ?>
                    <h1 class="text-center text-3xl text-[#A66D58] my-12"><?= $row->design?></h1>
                    <?php
                            }
                        }
                    ?>
                    <table class="table-auto border-collapse rounded-lg w-full mb-12">
                        <thead>
                            <tr class="border-b border-gray-300">
                                <th class="p-3 text-[#024059]">Costs Date</th>
                                <th class="p-3 text-[#024059]">Motif</th>
                                <th class="p-3 text-[#024059]">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id_eglise = test_input($_GET['id']);
                                if(isset($_POST['search_entree']) && isset($_POST['search'])){
                                    $search = test_input($_POST['search']);
                                    $search = strtolower($search);
                                    $search_query = "SELECT * FROM SORTIE WHERE LOWER(motif) LIKE :motif AND ideglise = :id_eglise ORDER BY dateSortie DESC";
                                    $search = '%' . $search . '%';
                                    $data = [":motif" => $search, ":id_eglise" => $id_eglise];
                                    $statement = $conn->prepare($search_query);
                                }
                                else{
                                    $query = "SELECT * FROM SORTIE WHERE ideglise = :id_eglise ORDER BY dateSortie DESC";
                                    $data = [":id_eglise" => $id_eglise];
                                    $statement = $conn->prepare($query);
                                    
                                }
                                $statement->execute($data);
                                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                if($result){
                                    foreach($result as $row){
                            ?>
                                <tr class="border-b border-slate-300 odd:bg-[#e6e6e6] even:bg-[#F0F2F0]">
                                    <td class="p-3 text-center"><?= $row->dateSortie ?></td>
                                    <td class="p-3 text-center"><?= $row->motif ?></</td>
                                    <td class="p-3 text-center"><?= $row->montantSortie ?></td>
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
                    <div class="flex flex-row justify-end pr-5 mb-8">
                        <?php
                            $total_query = "SELECT SUM(montantSortie) AS total FROM SORTIE WHERE ideglise=:ideglise";
                            $ids = [":ideglise" => $id_eglise,];
                            if(isset($_POST['search_entree'])){
                                $search = strtolower($_POST['search']);
                                $total_query = "SELECT SUM(montantSortie) AS total FROM SORTIE WHERE LOWER(motif) LIKE :motif AND ideglise = :ideglise";
                                $search = '%' . $search . '%';
                                $ids = [":motif" => $search, ":ideglise" => $id_eglise];
                            }
                            $total_query_run = $conn->prepare($total_query);
                            $total_query_run->execute($ids);
                            $result = $total_query_run->fetch();
                        ?>
                            <h2 class="text-3xl text-[#024059] ">Total: <span class="text-[#353535]">Ar <?= $result['total']?></span></h2>
                    </div>
                </div>
                
            </div>
        </div>
        <?php include('./frontend/add_cost_modal.php');?>
    </div>

</body>
</html>