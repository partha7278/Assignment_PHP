<?php $this->load->view('common/admin_header'); ?>

<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>





    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <div>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap" style="font-size: 13px;" cellspacing="0"
                                            width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php $this->load->view('common/admin_footer'); ?>

<style>
    .dataTables_length{margin-left:30px}
    .center{text-align: center;}
    .editbtn{
        color:#28b6f1 !important;
        cursor:pointer;
        font-size:18px;
    }
    .editbtn:hover{opacity:0.5;}
    .img{
        max-width:50px;
        max-height:45px;
    }
</style>


<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>




<script type="text/javascript">
    //TableManageButtons.init();
    $(document).ready(function() {
        var mdata = $('#datatable-buttons').DataTable( {
            "lengthChange": true,
            "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],

            "order": [[ 0, "desc" ]],
            "ajax": {
                "url":'<?php echo base_url(); ?>/api/order/viewby_user',
                "contentType": "application/json",
                "type": "POST",
                "data": function ( d ) {
                    return JSON.stringify(d);
                }
            },
            "columns": [
                { 
                    data: "id",
                    className:"center"
                },
                { 
                    data: "user_name"
                },
                { 
                    data: "email"
                },
                { 
                    data: "name"
                },
                { 
                    data: "price"
                },
                { 
                    data: "updated_at"
                }
                
            ]
        });
    });
</script>



