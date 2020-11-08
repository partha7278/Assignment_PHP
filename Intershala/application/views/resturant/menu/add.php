<?php $this->load->view('common/admin_header'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="row justify-content-md-center mb-5">
        <div class="col-md-7 card">
            <div class="card-body p-3">

                <form action='#' id="menuadd" class="form-signin">
                    <div class="alert alert-danger hide" role="alert" id="error" >
                    </div>

                    <div class="text-center">
                        <div class="fileupload">
                            <input type="file" name="file" onchange="readURL(this)" accept="image/*" required> 
                            <div class="img-icon"><i class="far fa-image"></i></div>
                        </div>
                    </div>
                    <div class="form-label-group mt-4">
                        <input type="text" id="inputName" class="form-control" placeholder="Item Name" minlength="4" name="name" required autofocus>
                        <label for="inputName">Item Name</label>
                    </div>
                    <div class="form-label-group mt-4">
                        <input type="number" id="inputPrice" class="form-control" placeholder="Price" name="price" minlength="2" required>
                        <label for="inputPrice">Price</label>
                    </div>
                    <div class="form-label-group mt-4">
                        <input type="number" id="inputOfferPrice" class="form-control" name="offer_price"  placeholder="Offer Price">
                        <label for="inputOfferPrice">Offer Price</label>
                    </div>
                    <div class="form-label-group mt-4">
                        <textarea id="inputDetails" class="form-control" rows="4" name="details"  placeholder="Details"></textarea>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" checked type="radio" name="foodType" id="inlineRadio1" value="veg">
                        <label class="form-check-label" for="inlineRadio1">Veg</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="foodType" id="inlineRadio2" value="nonveg">
                        <label class="form-check-label" for="inlineRadio2">Non-Veg</label>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block text-uppercase mt-5" type="submit">Add Item</button>
                </form>

            </div>
        </div>
    </div>

      
<?php $this->load->view('common/admin_footer'); ?>

<style>
    .form-control{
        border-radius:6px !important;
    }
</style>

<script>
    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.fileupload').css({'background-image':'url("'+e.target.result+'")','background-size':'cover','background-repeat':'no-repeat'});
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $("#menuadd").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>api/menu/add';

        $('#error').addClass('hide');

        $.ajax({url,'type':'POST',cache: false,
        contentType: false,
        processData: false,data:formData,  
            success:function(response){
                // console.log(response);

                if(response.statusCode == 200){
                    window.location.href= '<?php echo base_url(); ?>resturant/menu';
                }else{
                    $('#error').text(response.message);
                    $('#error').removeClass('hide');
                }
            }
        });

    });
</script>