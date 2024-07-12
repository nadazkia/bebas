<div id="kotak_modal" class="hidden absolute top-0 bg-black/80 w-full h-full rounded-xl">
    <div class="flex justify-center items-center h-full">
        <div id="modal" class="relative text-right max-w-96 bg-white rounded-lg text-slate-800 p-4 mx-5">
            <button id="close"
                class="absolute top-2 right-2 px-1 rounded-lg bg-slate-100 hover:text-black font-bold">X</button>
            <div class="py-5 md:pb-7">
                <h3 id="brandName" class="text-center text-lg font-bold lg:text-2xl mb-2"> $brands->name
                </h3>
                <p id="description" class="text-center lg:text-xl"> $brands->description </p>
            </div>
        </div>
    </div>
</div>



<script>
    $("#close").on("click", function() {
        $('#kotak_modal').addClass('hidden');
    });

    function read(params) {
        var dataURL = $(this).data('url');
        console.log(dataURL);
        $.ajax({
            url: dataURL,
            type: "GET",
            success: function(data) {
                $('#kotak_modal').removeClass('hidden');
                $('#brand_name').html(data.name);
                $('#description').html(data.description);
                // console.log(data);
            },
            error: function() {
                console.log("Error saat ingin melihat");
            }
        })
    }
</script>
