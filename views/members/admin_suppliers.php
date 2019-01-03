<?php
    if (count($this->data) > 0){ 
?>

    <!-- DATA TABLE-->
    <div class="table-responsive ">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Me</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stocks</th>
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
                    <td class="stocks"><?=$row['stocks']?></td>
                    <td>
                        <a href="#" class="btn btn-success addstocks" id="<?=$row['custid']?>"><i class="fa fa-plus"></i></a>
                        <a href="/me/products/edit/<?=$row['custid']?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger delete" id="<?=$row['custid']?>"><i class="fa fa-trash"></i></a>
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
                //get image container from delete button [div > div > h6 > button(delete)]
                var id = $(this).attr('id');
                                
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
            url: '/ajax/members/delete/',
            data: product,
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(response){
                console.log('success')
                console.log(response)
                switch(response.message){
                    case 'success': 
                    //window.location.href = 'index'

                    console.log('saved');
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
</script>