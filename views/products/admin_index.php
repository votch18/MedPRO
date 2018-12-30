<?php
    if (count($this->data) > 0){ 
?>

    <!-- DATA TABLE-->
    <div class="table-responsive ">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php 
                $count = 0;
                foreach($this->data as $row) { 
                    $count++;
                ?>
                <tr>
                    <td><?=$row['prodid']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['sku']?></td>
                    <td><?=$row['price']?></td>
                    <td class="status"><?=$row['status'] == '1' ? '<span class="badge badge-warning p-2">Pending</span>':'<span class="badge badge-success p-2">Approved</span>'?></td>
                    <td>
                        <?php if ( $row['status'] == '1' ) { ?>
                        <a href="#" class="btn btn-success approve" id="<?=$row['prodid']?>" ><i class="fa fa-arrow-right"></i></a>
                        <?php } ?>
                        <a href="/me/products/edit/<?=$row['prodid']?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger delete" id="<?=$row['prodid']?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE                  -->
    
<?php
}
?>

<script>
	$('body').on('click', '.delete', function(e) {
        e.preventDefault(); //prevent modal from closing
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            
            if (result.value) {
             
                //set post data
                var product = {
                    id: $(this).attr('id'),
                }
                
                if (deleteProduct(product)) {
                    swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )

                    $(this).parent().parent().remove();
                }
            }
            
        });        
    });

    function deleteProduct(product){
        
        return $.ajax({
            type: 'POST',
            url: '/ajax/products/delete/',
            data: product,
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(response){
                console.log('success')
                console.log(response)
                switch(response.message){
                    case 'success': 
                   
                    break
                    
                    case 'error':
                    swal({
                        title: "Error",
                        text: "An error occured while saving your changes",
                        type: "error",
                        confirmButtonText: '',
                        showCancelButton: true,
                        showConfirmButton: false,
                    });
                    break
                }
            }
        });
    }

    
	$('body').on('click', '.approve', function(e) {
        e.preventDefault(); //prevent modal from closing

        swal({
            title: 'Are you sure?',
            text: "Approving this product will make the product visible to your audiences!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approved it!'
            }).then((result) => {
            
            if (result.value) {              
                //set post data
                var id = {
                    prodid: $(this).attr('id'),
                }
                
          
                approve_product(id).done(function ($data){
                    $msg = JSON.parse($data);
                    console.log($msg.message);

                    swal(
                    'Approved!',
                    'Your product has been approved.',
                    'success'
                    )
                   
                });
                $(this).parent().parent().find('.status').find('.badge.badge-warning').remove();
                $(this).parent().parent().find('.status').append('<span class="badge badge-success p-2">Approved</span>');
                $(this).remove();
            }
            
        });

    });

    function approve_product(id){
        return  $.ajax({
            type: 'POST',
            url: '/ajax/products/approve_product/',
            data: id,
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(response){
            
                switch(response.message){
                    case 'success': 
                    break
            
                    case 'error':
                        console.log('an error occured!');
                    break
                }
            }
        });
    }

</script>