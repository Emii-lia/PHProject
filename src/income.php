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
    <script src="./script/inc_modal_script.js" defer></script>
    <style>
        .inc{
            background-color: #A66D58;
        }
        .inc:hover{
            background-color: #A66D58;            
        }
    </style>

    <title>Church</title>
</head>
<body>
    <div class="pr-20 relative h-full">
        <div class="flex flex-row items-start h-full">
        <?php if (isset($_SESSION['inc_message'])) : 
                $tag = "Successful!";
                $color = "green";
    
                ?>
                    <!--modal content-->
                <div
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
                    id="successMessage"
                >
                    <div
                        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
                    >
                        <div class="mt-3 text-center">
                            <div
                                class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-<?=$color?>-100"
                            >
                                <svg
                                    class="h-6 w-6 text-<?=$color?>-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    ></path>
                                </svg>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900"><?= $tag ?></h3>
                            <div class="mt-2 px-7 py-3">
                                <p class="text-sm text-gray-500">
                                    <?= $_SESSION['inc_message'] ?>
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <button
                                    id="ok-btn"
                                    class="px-4 py-2 bg-<?=$color?>-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-<?= $color?>-600 focus:outline-none focus:ring-2 focus:ring-<?=$color?>-300"
                                >
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    let modal = document.getElementById("successMessage");

                    // let btn = document.getElementById("add_inc_btn");

                    let button = document.getElementById("ok-btn");

                    // We want the modal to open when the Open button is clicked

                        // We want the modal to close when the OK button is clicked
                    button.onclick = function() {
                    modal.style.display = "none";
                    }
                    // The modal will close when the user clicks anywhere outside the modal
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                    modal.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                </script>

                    <?php unset($_SESSION['inc_message']);
                    endif; 
                    if (isset($_SESSION['inc_err_message'])) : 
                        $tag = "Error!";
                        $errcolor = "orange";
                    ?>
                        <div
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
                    id="successMessage"
                    >
                    <div
                        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
                    >
                        <div class="mt-3 text-center">
                            <div
                                class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <g transform="translate(0,-1036.3622)">
                                    <path style="fill:#da4453;fill-opacity:1;stroke:none" 
                                        d="m 7,1038.3622 0,8.0001 2,0 0,-8.0001 -2,0 z m 0,10 0,2 2,0 0,-2 -2,0 z" 
                                        id="rect4158"
                                        />
                                </g>
                                </svg>

                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900"><?= $tag ?></h3>
                            <div class="mt-2 px-7 py-3">
                                <p class="text-sm text-gray-500">
                                    <?= $_SESSION['inc_err_message'] ?>
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <button
                                    id="ok-btn"
                                    class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
                                >
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    let modal = document.getElementById("successMessage");

                    // let btn = document.getElementById("add_inc_btn");

                    let button = document.getElementById("ok-btn");

                    // We want the modal to open when the Open button is clicked

                        // We want the modal to close when the OK button is clicked
                    button.onclick = function() {
                    modal.style.display = "none";
                    }
                    // The modal will close when the user clicks anywhere outside the modal
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                    modal.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                </script>
            <?php unset($_SESSION['inc_err_message']);
            endif; 
            ?>
            <?php
                include('./frontend/nav.php');
            ?>
            <div class="w-[80%] flex flex-col h-[100vh] pl-52 ml-52">
                <div class="flex flex-row justify-between items-center  py-14 w-[100%] pl-20 mb-16">
                    <div class="flex flex-row justify-between items-center w-full">
                        <form method="post" class="flex flex-row justify-start w-[90%]">
                            <input type="search" class="w-[55%] rounded-l-3xl shadow-md pl-3" placeholder="Search incomes by 'Motif'" name="search" id="">
                            <button type="submit" name="search_entree" class="bg-[#4F758C] drop-shadow-md rounded-r-3xl flex flex-row justify-center items-center cursor-pointer"><img class="drop-shadow-md py-1 w-[80%] h-[80%] text-[#f0f2f0]" src="./assets/icons/search.svg" alt=""></button>
                        </form>
                        <div class="bg-[#4F758C] px-2 py3 rounded-lg" id="add_new_inc">
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
                            <tr class="border-b border-gray-400">
                                <th class="p-3 text-[#024059]">Income Date</th>
                                <th class="p-3 text-[#024059]">Motif</th>
                                <th class="p-3 text-[#024059]">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['id'])){
                                    $id_eglise = test_input($_GET['id']);
                                    if(isset($_POST['search_entree']) && isset($_POST['search'])){
                                        $search = test_input($_POST['search']);
                                        $search = strtolower($search);
                                        $search_query = "SELECT * FROM ENTREE WHERE LOWER(motif) LIKE :motif AND ideglise = :id_eglise ORDER BY dateEntre DESC";
                                        $search = '%' . $search . '%';
                                        $statement = $conn->prepare($search_query);
                                        $data = [":motif" => $search, ":id_eglise" => $id_eglise];
                                        $statement->execute($data);
                                    }
                                    else{
                                        $query = "SELECT * FROM ENTREE WHERE ideglise = :id_eglise ORDER BY dateEntre DESC";
                                        $data = [":id_eglise" => $id_eglise];
                                        $statement = $conn->prepare($query);
                                        $statement->execute($data);
                                    }
        
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                }
                                
                                if($result){
                                    foreach($result as $row){
                            ?>
                                <tr class="border-b border-slate-300 odd:bg-[#e6e6e6] even:bg-[#F0F2F0]">
                                    <td class="p-3 text-center"><?= $row->dateEntre ?></td>
                                    <td class="p-3 text-center"><?= $row->motif ?></</td>
                                    <td class="p-3 text-center"><?= $row->montantEntre ?></td>
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
                            $total_query = "SELECT SUM(montantEntre) AS total FROM ENTREE WHERE ideglise=:ideglise";
                            $ids = [":ideglise" => $id_eglise,];
                            if(isset($_POST['search_entree']) && isset($_POST['search'])){
                                $search = test_input($_POST['search']);
                                $search = strtolower($search);
                                $total_query = "SELECT SUM(montantEntre) AS total FROM ENTREE WHERE LOWER(motif) LIKE :motif AND ideglise = :ideglise";
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
        <?php include('./frontend/add_income_modal.php');?>
    </div>
        
</body>
</html>