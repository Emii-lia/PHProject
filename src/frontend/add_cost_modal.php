<!--modal content-->
<div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="cost-modal"
>
    <div
        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
    >
        <h3 class="leading-6 text-center text-[#024059] text-xl font-bold">Adding new Expense</h3>
        <div class="mt-2 px-7 py-3">
            <form action="./../backend/code.php" method="post" class="flex flex-col justify-around">
                <div class="mb-8">
                    <label for="" class="text-[#353535]">Date of the expense:</label>
                    <input type="date" class="mt-2 rounded-full shadow-md p-3 w-full" name="dateSortie" id="" placeholder="Enter the date of outcoming" value="<?php echo date('Y-m-d');?>">
                </div>
                <div class="mb-8">
                    <label for="" class="text-[#353535]">Reason: </label>
                    <input type="text" class="mt-2 rounded-full shadow-md p-3 w-full" name="motif" id="" placeholder="Enter the motif" maxlength="120" required>
                </div>
                <div class="mb-4">
                    <label for="" class="text-[#353535]">Value: </label>
                    <input type="number" class="mt-2 rounded-full shadow-md p-3 w-full" name="montantSortie" id="" placeholder="Enter the value of the costs" required>
                    <input type="radio" class="hidden" name="ideglise" checked value="<?= test_input($_GET['id']) ?>">
                </div>
                <div class=" px-4 py-3 mt-4">
                    <button
                        type="submit"
                        id="confirm-cst-btn"
                        name="save_cost_btn"
                        class="px-12 py-3 bg-[#4F758C] text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-[#024059]"
                    >
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

