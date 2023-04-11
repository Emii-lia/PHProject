<?php session_start(); 
    require('./backend/dbcon.php');
    require('./function.php');
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./dist/output.css">
        <link rel="stylesheet" href="./css/styles.css">
        <script src="script/ch_modal_script.js" defer></script>

        <title>Church</title>
    </head>
    <body>
        <div class="pr-20 relative h-full ind">
            <?php if (isset($_SESSION['ch_message'])) : ?>
                    <!--modal content-->
                <div
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                    id="successMessage"
                >
                    <div
                        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
                    >
                        <div class="mt-3 text-center">
                            <div
                                class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100"
                            >
                                <svg
                                    class="h-6 w-6 text-green-600"
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Successful!</h3>
                            <div class="mt-2 px-7 py-3">
                                <p class="text-sm text-gray-500">
                                    Church has been successfully registered!
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <button
                                    id="ok-btn"
                                    class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300"
                                >
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    let modal = document.getElementById("successMessage");

                    // let btn = document.getElementById("add_ch_btn");

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

                    <?php unset($_SESSION['ch_message']);
                    endif; 
                    ?>
            <div class="flex flex-row items-start h-full">
                <div class="w-[20%] fixed pt-10  bg-[#D9CBBF] h-[100vh]">
                    <div class=" flex flex-col items-start m-0 shadow-xl h-[100%]">
                        <div class="py-6 pl-10 text-lg font-bold cursor-pointer w-[100%] hover:bg-[#A66D58]"><a class="flex flex-row items-center gap-4 text-[#343434] active:text-[#343434]" href="./index.php"><img class="" src="./assets/icons/church.svg" alt=""> Home</a></div>
                    </div>
                </div>
                <div class="w-[80%] flex flex-col h-[100vh] pl-52 ml-52">
                    <div class="flex flex-row justify-between  py-14 w-[100%]">
                        <div class="">
                            <h2 class="text-3xl w-[100%] text-[#A66D58] font-bold mb-8">Church</h2>
                            <h2 class="text-4xl w-[50%]">Financial Stat Report And Management Website Application For Church</h2>
                        </div>
                        <div class="w-[40%] flex flex-col justify-start items-start mt-16">
                            <p class="">A website application used to manage and view a financial stat report of all churches in the database</p>
                            <div class="mt-7 bg-[#024059] text-[#f2f2f2] py-2 px-3 rounded-lg cursor-pointer" id="open_modal">
                                <h3>Add new Church</h3>
                            </div>
                        </div>
                    </div>
                    <div class="w-[100%] px-16 flex flex-col items-center justify-around mt-16">
                        <form method="post" class="flex flex-row justify-center w-[100%] p-10 pt-6">
                            <input type="search" class="w-[71%] rounded-l-3xl shadow-md pl-3" placeholder="Search church by name" name="search" id="">
                            <button type="submit" name="search_church" class="bg-[#4F758C] drop-shadow-md rounded-r-3xl flex flex-row justify-center items-center cursor-pointer"><img class="drop-shadow-md py-1 w-[80%] h-[80%] text-[#f0f2f0]" src="./assets/icons/search.svg" alt=""></button>
                        </form>
                        <?php
                            if(isset($_POST['search_church'])){
                                $search = test_input($_POST['search']);
                                $search = strtolower($search);
                                $search_query = "SELECT * FROM EGLISE WHERE LOWER(design) LIKE :design";
                                $search = '%' . $search . '%';
                                $search_query_run = $conn->prepare($search_query);
                                $data = [
                                    ":design" => $search
                                ];
                                $search_query_run->execute($data);
                                $result = $search_query_run->fetchAll(PDO::FETCH_OBJ);
                            }
                            else{
                                $query = "SELECT * FROM EGLISE";
                                $statement = $conn->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                            }
                            if($result){
                                foreach($result as $row){
                        ?>
                        <div class="flex flex-col w-[70%] shadow-md rounded-md h-[40rem] mb-16">
                            <img src="./assets/images/church.jpg" class="object-cover" alt="">
                            <div class="flex flex-col h-full px-3">
                                <h2 class="px-2 py-3 text-2xl text-[#024059]"><?= $row->design ?></h2>
                                <div class="flex flex-row justify-between items-center">
                                    <h2 class="pl-2 text-[#565656]">Ar <?= $row->solde ?></h2>
                                    <div class="bg-[#4F758C] px-3 py-2 rounded-lg cursor-pointer text-[#f0f2f0]">
                                        <a href="./income.php?id=<?= $row->ideglise ?>">View more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                        ?>
                            <div>
                                <h1>No record found</h1>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include('./frontend/add_church_modal.php');?>
    </body>
</html>