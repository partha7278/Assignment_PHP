<?php 
    //common header
    $this->load->view('common/header'); 
?>


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registration</h5>
                        <form class="form-signin" action="#" id="register">

                            <div class="alert alert-danger hide" role="alert" id="error" >
                            </div>

                            <div class="form-label-group">
                                <input type="text" minlength="5" id="inputName" class="form-control" placeholder="Resturant Name" required autofocus>
                                <label for="inputName">Resturant Name</label>
                            </div>
                            
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" minlength="8" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase mt-5" type="submit">Register</button>
                        </form>
                        <hr class="my-4">
                        <div class="text-center pb-3">Already have an account ? <a href="<?php echo base_url(); ?>login">Sign in</a></div>
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
    $("#register").submit(function(e){
        e.preventDefault();

        $('#error').addClass('hide');
        var data = {};
        data['name'] = $('#inputName').val();
        data['email'] = $('#inputEmail').val();
        data['password'] = $('#inputPassword').val();
        data['user_type'] = 'resturant';

        $.ajax({url:'<?php echo base_url(); ?>api/auth/register','type':'POST',contentType: 'application/json',data:JSON.stringify({data}),  
            success:function(response){
                //console.log(response);

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