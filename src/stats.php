<?php session_start(); 
    require('./backend/dbcon.php');
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/output.css">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .stat{
            background-color: #A66D58;
        }
        .stat:hover{
            background-color: #A66D58;
        }
    </style>

    <title>Church</title>
</head>
<body>
    <div class="pr-20 relative h-full">
        <?php if (isset($_SESSION['message'])) : ?>
            <h5 class="alert alert-success"><?php echo $_SESSION['message']; ?></h5>
        <?php unset($_SESSION['message']);
        endif; 
        ?>
        <div class="flex flex-row items-start h-full">
            <?php
                include('./frontend/nav.php');
            ?>
            <div class="w-[80%] flex flex-col h-[100vh] pl-52 ml-52">
                <?php

                    if(isset($_GET['id'])){
                        $id_eglise = $_GET['id'];
                        $titre_design = "SELECT * FROM EGLISE WHERE ideglise = :id_eglise";
                        $set_titre = $conn->prepare($titre_design);
                        $titre = [":id_eglise" => $id_eglise];

                        $set_titre->execute($titre);
                        $result_title = $set_titre->fetchAll(PDO::FETCH_OBJ);
                    }
                    if($result_title){
                        foreach( $result_title as $row ){
                ?>
                <div class="flex flex-col justify-center py-12 pb-8">
                    <h1 class='text-[#A66D58] font-semibold text-5xl text-center' ><?= $row->design?></h1>
                </div>  
                <?php
                        }
                    }
                ?>

                <div class="flex flex-col  py-14 w-[100%] pl-20 mb-16">
                    <div class="flex flex-col  space-y-10 w-[100%] mb-24">
                        <div class="">
                            <h2 class='text-[#363636] font-semibold text-3xl' >Numerical statistics</h2>
                        </div>                    
                        <div class="flex flex-row justify-between mx-12 w-[100%]">
                            <div class="flex flex-col justify-center w-[20%] items-center bg-[#024059] h-52 rounded-lg cursor-pointer">
                                <?php
                                    $get_montant_query = "SELECT SUM(montantEntre) AS total FROM ENTREE WHERE ideglise = :ideglise";
                                    $get_montant_query_run = $conn->prepare($get_montant_query);
                                    $date = [
                                        ":ideglise" => $id_eglise
                                    ];
                                    $get_montant_query_run->execute($date);
                                    $result = $get_montant_query_run->fetch();
                                    $total_inc = $result['total'];
                                
                                ?>     
                                <h2 class='text-[#f0f2f0]'>Ar <?= $total_inc?></h2>
                                <h3 class='text-[#f0f2f0]'>Incomes</h3>
                            </div>
                            <div class="flex flex-col justify-center items-center w-[20%] bg-[#A66D58] rounded-lg cursor-pointer">
                                <?php
                                    $get_montant_query = "SELECT SUM(montantSortie) AS total FROM SORTIE WHERE ideglise=:ideglise";
                                    $get_montant_query_run = $conn->prepare($get_montant_query);
                                    $date = [
                                        ":ideglise" => $id_eglise,
                                    ];
                                    $get_montant_query_run->execute($date);
                                    $result = $get_montant_query_run->fetch();
                                    $total_cst = $result['total'];
                                ?>                                
                                <h2 class='text-[#f0f2f0]'>Ar <?= $total_cst?></h2>
                                <h3 class='text-[#f2f2f2]'>Costs</h3>
                            </div>
                            <?php
                                
                                if($result_title){
                                    foreach( $result_title as $row ){                                
                            ?>
                            <div class="flex flex-col justify-center w-[20%] items-center bg-[#4F758C] rounded-lg cursor-pointer">
                                <h2 class='text-[#f0f2f0]'>Ar <?= $row->solde?></h2>
                            <?php
                                    }
                                }
                            ?>
                                <h3 class='text-[#f2f2f2]'>Solde</h3>
                            </div>
                        </div>
                    </div>
                    <div class="mb-24 flex flex-col space-y-8">
                        <div class="mb-20">
                            <h2 class='text-[#363636] font-semibold text-3xl' >Graphical statistics</h2>
                        </div>  
                        <div class="flex flex-col  items-center">
                            <div class="flex flex-col space-y-6 h-[40%]">
                                <div class="">
                                    <h2 class='text-[#363636] text-2xl' >Cash Movement Per Month</h2>
                                </div>  
                                
                                <img src="plot.php?id=<?= $id_eglise?>" alt="" class="">
                            </div>
                        </div>
                    </div>
                    <div class="mr-0 w-[100%]">
                        <div class="mb-12">
                            <h2 class='text-[#363636] font-semibold text-3xl' >Cash Movement</h2>
                        </div>
                        <form method="post" class="flex flex-row justify-between items-center space-x-6 w-[100%] ml-12 mb-20">
                            <div class="flex flex-row space-x-14 items-center">
                                <div class="flex flex-row space-x-3 items-center">
                                    <label for="" class="text-lg text-[#363636]">From: </label>
                                    <input type="date" name="start" class="px-12 py-2 rounded-lg shadow-sm border-2 border-[#4F758C] focus:border-[#00000000]" id="">
                                </div>
                                <div class="flex flex-row space-x-3 items-center">
                                    <label for="" class="text-lg text-[#363636]">To: </label>
                                    <input type="date" name="end" class="px-12 py-2 rounded-lg shadow-sm border-2 border-[#4F758C] focus:border-[#00000000]" id="">
                                    <input type="radio" name="id" checked id="" class="hidden" value="<?= $_GET['id'] ?>">
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="bg-[#4F758C] text-[#F0F2F0] px-4 py-2 rounded-md" name="cash">Show stats</button>
                            </div>
                        </form>
                        <div class="ml-12">
                            <div class="mb-28">
                                <div class="mb-8 mt-12">
                                    <?php
                                        if(isset($_POST['cash'])){
                                            $date_debut = $_POST['start'];
                                            $date_fin = $_POST['end'];
                                    ?>
                                    <h2 class="text-[#363636] text-2xl flex flex-row">Income Cash Movement: <span class="w-[60%] text-center"><?= $date_debut?> to <?= $date_fin?></span></h2>
                                </div>
                                <table class="table-auto border-collapse rounded-lg w-full ml-12">
                                    <thead>
                                        <tr class="border-b border-gray-300">
                                            <th class="p-3 text-[#024059]">Income Date</th>
                                            <th class="p-3 text-[#024059]">Motif</th>
                                            <th class="p-3 text-[#024059]">Montant</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php
                                            
                                                $id_eglise = $_POST['id'];
                                                $mvt_entree_query = "SELECT motif, dateEntre, montantEntre FROM ENTREE WHERE ideglise=:id_eglise AND dateEntre BETWEEN :date_deb AND :date_fin ORDER BY dateEntre DESC";
                                                $mvt_entree_query_run = $conn->prepare($mvt_entree_query);
                                                $data = [
                                                    ":date_deb" => $date_debut,
                                                    ":date_fin" => $date_fin,
                                                    ":id_eglise" => $id_eglise
                                                ];
                                                $mvt_entree_query_run->execute($data);
                                                $result = $mvt_entree_query_run->fetchAll(PDO::FETCH_OBJ);
                                                
                                                
                                                if($result){
                                                    foreach($result as $row){
                                        ?>
                                                        <tr class="border-b border-slate-300 odd:bg-[#e6e6e6] even:bg-[#F0F2F0]">
                                                            <td class="p-3 text-center"><?= $row->dateEntre ?></td>
                                                            <td class="p-3 text-center"><?= $row->motif ?></td>
                                                            <td class="p-3 text-center"><?= $row->montantEntre ?></td>  
                                                        </tr> 
                                        <?php 
                                                    }
                                                }
                                        ?>                                                   
                                    </tbody> 
                                </table>   
                                <div class="my-6 ml-12">
                                    <?php
                                            $get_montant_query = "SELECT SUM(montantEntre) AS total FROM ENTREE WHERE ideglise = :ideglise AND dateEntre BETWEEN :date_deb AND :date_fin";
                                            $get_montant_query_run = $conn->prepare($get_montant_query);
                                            $date = [
                                                ":date_deb" => $date_debut,
                                                ":date_fin" => $date_fin,
                                                ":ideglise" => $id_eglise
                                            ];
                                            $get_montant_query_run->execute($date);
                                            $result = $get_montant_query_run->fetch();
                                            $total = $result['total'];

                                        
                                    ?>                                    
                                    <h2 class="text-[#024059] text-xl">Total Income: <span class="text-[#363636] text-2xl"> Ar <?= $total ?></span></h2>
                                </div>                       
                            </div>
                            <div class="mt-10">
                                <div class="mb-8 mt-12">
                                    <h2 class="text-[#363636] text-2xl flex flex-row">Cost Cash Movement: <span class="w-[60%] text-center"><?= $date_debut?> to <?= $date_fin?></span></h2>
                                </div>
                                <table class="table-auto border-collapse rounded-lg w-full ml-12">
                                    <thead>
                                        <tr class="border-b border-gray-300">
                                            <th class="p-3 text-[#024059]">Cost Date</th>
                                            <th class="p-3 text-[#024059]">Motif</th>
                                            <th class="p-3 text-[#024059]">Montant</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php
                                            $mvt_sortie_query = "SELECT motif, dateSortie, montantSortie FROM SORTIE WHERE ideglise=:ideglise AND dateSortie BETWEEN :date_deb AND :date_fin ORDER BY dateSortie DESC";
                                            $mvt_sortie_query_run = $conn->prepare($mvt_sortie_query);
                                            $data = [
                                                ":date_deb" => $date_debut,
                                                ":date_fin" => $date_fin,
                                                "ideglise" => $id_eglise,
                                            ];
                                            $mvt_sortie_query_run->execute($data);
                                            $result = $mvt_sortie_query_run->fetchAll(PDO::FETCH_OBJ);
                                            
                                            
                                            if($result){
                                                foreach($result as $row){
                                                    
                                        ?>
                                            <tr class="border-b border-slate-300 odd:bg-[#e6e6e6] even:bg-[#F0F2F0]">
                                                <td class="p-3 text-center"><?= $row->dateSortie ?></td>
                                                <td class="p-3 text-center"><?= $row->motif ?></td>
                                                <td class="p-3 text-center"><?= $row->montantSortie ?></td>  
                                            </tr>                                             
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody> 
                                </table>   
                                <div class="my-6 ml-12">
                                <?php
                                    $get_montant_query = "SELECT SUM(montantSortie) AS total FROM SORTIE WHERE ideglise=:ideglise AND dateSortie BETWEEN :date_deb AND :date_fin";
                                    $get_montant_query_run = $conn->prepare($get_montant_query);
                                    $date = [
                                        ":date_deb" => $date_debut,
                                        ":date_fin" => $date_fin,
                                        ":ideglise" => $id_eglise,
                                    ];
                                    $get_montant_query_run->execute($date);
                                    $result = $get_montant_query_run->fetch();
                                    $total = $result['total'];
                                 
                                    ?>
                                    <h2 class="text-[#024059] text-xl">Total Costs: <span class="text-[#363636] text-2xl"> Ar <?= $total ?></span></h2>
                                </div>                        
                            </div>
                        </div>
                        <form action="">
                            <input type="radio" checked name="" class="hidden" value="" id="">
                            <div class="mt-10 flex flex-col items-end">
                                <button type="button" class="bg-[#4F758C] px-4 py-2 rounded-md text-[#f0f2f0]">Generate PDF</button>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>