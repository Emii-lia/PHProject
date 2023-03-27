<!--modal content-->
<div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="my-modal"
>
    <div
        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
    >
            <h3 class="leading-6 text-center text-[#024059] text-xl font-bold">Adding new church</h3>
            <form method="post" action="./../backend/code.php" class="flex flex-col justify-around">
                <div class="mt-2 px-7 py-3 flex flex-col justify-around">
                        <div class="mb-8">
                            <label for="" class="text-[#353535]">Identifiant</label>
                            <input type="text" class="mt-2 rounded-full shadow-md p-3 w-full" name="ideglise" id="ideglise" placeholder="Enter the ID">
                        </div>
                        <div class="mb-4">
                            <label for="" class="text-[#353535]">Name of the church: </label>
                            <input type="text" class="mt-2 rounded-full shadow-md p-3 w-full" name="design" id="church" placeholder="Enter the name of the church">
                        </div>
                </div>
                <div class=" px-4">
                    <p class="text-[#666] italic text-center text-sm py-2">Please verify all your datas before submiting</p>    
                    <button
                        type="submit"
                        id="add_ch_btn"
                        name="save_church_btn"
                        class="px-4 py-2 bg-[#4F758C] text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-[#024059]"
                        >
                        Confirm
                    </button>
                </div>
            </form>
    </div>
    <!--modal content-->
    <div
        class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
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

</div>

