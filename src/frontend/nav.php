<div class="w-[20%] fixed pt-10  bg-[#D9CBBF] h-[100vh]">
    <div class=" flex flex-col items-start m-0 shadow-xl h-[100%]">
        <div class="home py-6 pl-10 text-lg font-bold cursor-pointer w-[100%] hover:bg-[#A66D58AA]"><a class="flex flex-row items-center gap-4 text-[#343434] active:text-[#343434]" href="./index.php"><img class="" src="./assets/icons/church.svg" alt=""> Home</a></div>
        <?php 
            if(isset($_GET['id'])){
                $id_eglise = $_GET['id'];
                $titre_design = "SELECT * FROM EGLISE WHERE ideglise = :id_eglise";
                $set_titre = $conn->prepare($titre_design);
                $titre = [":id_eglise" => $id_eglise];

                $set_titre->execute($titre);
                $result_title = $set_titre->fetchAll(PDO::FETCH_OBJ);
            }
        ?>
        <div class="inc py-6 pl-10 text-lg font-bold cursor-pointer w-[100%] hover:bg-[#A66D58AA]"><a class="flex flex-row items-center gap-4 text-[#343434] active:text-[#343434]" href="./income.php?id=<?= $id_eglise ?>"><img class="" src="./assets/icons/paid.svg" alt=""> Income</a></div>
        <div class="cst py-6 pl-10 text-lg font-bold cursor-pointer w-[100%] hover:bg-[#A66D58AA]"><a class="flex flex-row items-center gap-4 text-[#343434] active:text-[#343434]" href="./costs.php?id=<?= $id_eglise ?>"><img class="" src="./assets/icons/costs.svg" alt=""> Costs</a></div>
        <div class="stat py-6 pl-10 text-lg font-bold cursor-pointer w-[100%] hover:bg-[#A66D58AA]"><a class="flex flex-row items-center gap-4 text-[#343434] active:text-[#343434]" href="./stats.php?id=<?= $id_eglise ?>"><img class="" src="./assets/icons/stat.svg" alt=""> Statistics</a></div>
    </div>
</div>