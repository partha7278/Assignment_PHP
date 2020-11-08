<?php
	$this->load->view('common/header'); 

	$foodtype = $this->session->userdata('food_type') ? $this->session->userdata('food_type') : 'all';
?>

	<div class="container text-center mb-5" style="max-width:600px">

		<div class="text-left d-flex justify-content-between pt-3 pb-5">
			<img src="<?php echo base_url(); ?>images/logo.jpg" width="120px" />

			<?php if(!$this->session->userdata('user_type')){ ?>
				<div class="" style="margin-top:15px"><a href="<?php echo base_url(); ?>login" style="border:1px solid #afafaf;color:grey;padding:3px 15px;border-radius:15px;font-weight:600;text-decoration:none;font-size:13px;">Login</a></div>
			
			<?php }else{ ?>
				<div>
					<span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-size:13px;text-transform:capitalize"><?php echo $this->session->userdata('name'); ?></span>
					<img class="img-profile rounded-circle" src="http://localhost/foodshala/images/user.png" width="37px">
				</div>
                     
			<?php } ?>

		</div>
		
		<div class="text-right">
			<select id="foodType" class="foodtype" onchange="fetchItems()"> 
				<option value="all" <?php if($foodtype == 'all') echo 'selected'; ?> >All</option>
				<option value="veg" <?php if($foodtype == 'veg') echo 'selected'; ?> >Veg</option>
				<option value="nonveg" <?php if($foodtype == 'nonveg') echo 'selected'; ?> >Non-veg</option>
			</select>
		</div>
		
		<div class="alert alert-danger mt-3 hide" role="alert" id="error">
		</div>
		<div id="allitems">
		</div>

	</div>



<?php
	$this->load->view('common/footer'); 
?>

<style>
	/* .container{background-color:white;} */
	.foodtype{
		border: 1px solid #c1c1c1;
		border-radius: 6px;
		color: grey;
		font-size: 14px;
		padding: 2px 7px;
	}
	.img{
		width:80px;
		height:80px;
		border-radius:6px;
	}
	.item_type::before{
		content: '';
		display: inline-block;
		width: 8px;
		height: 8px;
		-moz-border-radius: 7.5px;
		-webkit-border-radius: 7.5px;
		border-radius: 7.5px;
		margin-right:3px;
		background-color: #f1dc75;
		margin-top:0px;
	}	
	.item_type_text{
		font-size:12px;
		color:#676766;
	}

	.item_resturant::before{
		content: '';
		display: inline-block;
		width: 8px;
		height: 8px;
		-moz-border-radius: 7.5px;
		-webkit-border-radius: 7.5px;
		border-radius: 7.5px;
		margin-right:3px;
		background-color: #6feaf7;
		margin-top:0px;
	}	
	.item_resturant_text{
		font-size:12px;
		color:#676766;
	}

	.price{
		font-size:15px;
		margin-left:15px;
	}
	.offer_price{
		margin-left:15px;
		font-size:14px;
		color:#dc4541;
		text-decoration:line-through;
	}
	.order{
		cursor:pointer;
		background-color:#4e73df;
		padding:4px 10px;
		display:inline-block;
		border-radius:6px;
		margin-left:35px;
		color:white;
	}
</style>


<script>

	function fetchItems(){

		var data = {};
		data['food_type'] = $('#foodType').val();

        $.ajax({url:'<?php echo base_url(); ?>api/menu/all_items','type':'POST',contentType: 'application/json',data:JSON.stringify({data}),  
            success:function(response){
                // console.log(response);

                if(response.statusCode == 200){
					var allitems = '';

                    if(response.rowCount > 0){
						
						for(let x in response.data){
							allitems = allitems + `
							<div class="text-left card mt-4 px-3 py-2">
								<div class="d-flex w-100">
									<div><img src="<?php echo base_url().$image_path; ?>/${response.data[x]['image']}" class="img"></div>
									<div class="pl-4 w-100">
										<p class="mb-1">${response.data[x]['name']}</p>
										<div class="d-flex">
											<div class="item_type">
												<span class="item_type_text">${response.data[x]['food_type'] == 'veg' ? 'Veg' : 'Non-veg'}</span>
											</div>
											<div class="item_resturant pl-4">
												<span class="item_resturant_text">${response.data[x]['resturant']}</span>
											</div>
										</div>
										<div class="d-flex pt-2 w-100">
											<div class="d-flex justify-content-between w-100">
												<div>
													<span class="price">₹${response.data[x]['offer_price'] != 0 ? response.data[x]['offer_price'] : response.data[x]['price']}</span>
													${response.data[x]['offer_price'] != 0 ? `<span class='offer_price'>₹${response.data[x]['price']}</span>` : ''}
												</div>
												<?php if(!$this->session->userdata('user_type')){ ?>
													<a href="<?php echo base_url();?> login" class="order">Order</a>
												<?php }else{ ?>
													<div href="" class="order" onclick="order(${response.data[x]['id']})">Order</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>`;
						}

					}else{
						allitems = '<div class="text-center">Sorry! no Food items found</div>';
					}

					$('#allitems').html(allitems);
                }
            }
        });

	}
	
	fetchItems();
</script>


<script>
	function order(mid){
		var data = {};
		data['item_id'] = mid;

		$('#error').addClass('hide');

		$.ajax({url:'<?php echo base_url(); ?>api/order/add','type':'POST',contentType: 'application/json',data:JSON.stringify({data}),  
            success:function(response){
                console.log(response);

                if(response.statusCode == 200){
					$('#error').html('<span style="color:green">Congratulation! Order placed Successfully</span>');
                    $('#error').removeClass('alert-danger hide');
                }else{
					let message = response.message;
					if(response.errorCode == 1271){
						message = "Resturant Can't placed an Order";
					}
                    $('#error').text(message);
					$('#error').addClass('alert-danger');
					$('#error').removeClass('hide');
                }
            }
        });
	}
</script>