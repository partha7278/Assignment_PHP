<?php 
    //common header
    $this->load->view('common/header'); 
?>


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" action="#" id="login">

                            <div class="alert alert-danger hide" role="alert" id="error" >
                            </div>

                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase mt-5" type="submit">Sign in</button>
                        </form>
                        <hr class="my-4">
                        <div class="text-center pb-3">Don't have an account ?</div>
                        <a href="<?php echo base_url(); ?>customer_signup"><button class="btn btn-lg btn-facebook btn-block text-uppercase custombtn mb-2" style="text-decoration:none"><i class="far fa-user mr-2"></i> Sign up as Customer</button></a>
                        <a href="<?php echo base_url(); ?>resturant_signup"><button class="btn btn-lg btn-google btn-block text-uppercase custombtn" style="text-decoration:none"><i class="fas fa-utensils mr-2"></i> Sign up as Resturant</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php 
    //common footer
    $this->load->view('common/footer'); 
?>



<script>
    $("#login").submit(function(e){
        e.preventDefault();

        $('#error').addClass('hide');
        var data = {};
        data['email'] = $('#inputEmail').val();
        data['password'] = $('#inputPassword').val();

        $.ajax({url:'<?php echo base_url(); ?>api/auth/login','type':'POST',contentType: 'application/json',data:JSON.stringify({data}),  
            success:function(response){
                console.log(response);

                if(response.statusCode == 200){
                    if(response.data.user_type == 2){
                        window.location.href= '<?php echo base_url(); ?>resturant/menu';
                    }
                    else if(response.data.user_type == 1){
                        window.location.href= '<?php echo base_url(); ?>';
                    }
                }else{
                    $('#error').text(response.message);
                    $('#error').removeClass('hide');
                }
            }
        });

    });
</script>