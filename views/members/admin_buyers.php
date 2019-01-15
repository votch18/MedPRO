<?php
    if (count($this->data) > 0){ 
?>

    <!-- DATA TABLE-->
    <div class="table-responsive ">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Company</th>                    
                    <th>Owner/Representative</th>
                    <th>Email</th>
                    <th>Address</th>
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
                    <td><?=$row['company']?></td>                             
                    <td><?=$row['fname'].' '.$row['lname']?></td>
                    <td><?=$row['username']?></td>           
                    <td><?=$row['office_address']?></td>
                    <td>
                        <a href="/me/products/edit/<?=$row['custid']?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
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