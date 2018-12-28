<div class="card" style="width:  100%;">
    <div class="card-header">Products</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add Product</h3>
            </div>
            <hr>          
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Product</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input name="sku" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label mb-1">Description</label>
                            <textarea class="form-control" rows="6" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input name="price" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="UoM" class="control-label mb-1">Unif of Measure</label>
                            <select name="UoM" class="form-control">
                                <?php 
                                $prod = new Product();
                                $res = $prod->getUnitofMeasure();
                                
                                foreach($res as $row) { 
                                ?>
                                <option value="<?=$row['lid']?>"><?=$row['description']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category" class="control-label mb-1">Category</label>
                            <select name="category" class="form-control">
                                <?php 
                                $prod = new Product();
                                $res = $prod->getProductCategory();
                                
                                foreach($res as $row) { 
                                ?>
                                <option value="<?=$row['lid']?>"><?=$row['description']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div>
                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                <span>Save</span>
                            </button>
                        </div>                  
                    </div>

                    <div class="col-6">
                       
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Product Photos</label>
                            <div class="imgcon photo" id="dropzone" style="width: 100%; min-height: 350px; border-radius: 5px; padding: 10px; border: 1px solid rgba(0, 0, 0, .2);">
                            
                        
                            </div>
					    </div>
                        <div class="progress mb-3 d-none" style="width: 100%; height: 4px; background: transparent;">
                            <div id="progressBar" class="progress-bar bg-info" role="progressbar"
                            style="width: 0% height: 4px;" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>

                        <a href="#" class="btn btn-info mb-3 mt-2" id="choosephotos" ><i class="fa fa-plus"></i>&nbsp;Add Photos</a>
                       
                        <div class="alert alert-info w-100" >
                            <small><strong>Note:</strong> Please click to select the image you want to be the primary image.</small>
                        </div>
                        
                        <input type="file" class="d-none" id="file" accept="image/x-png,image/gif,image/jpeg"  name="file[]" multiple required/>
                                
                        <input type="hidden" name="main_photo" id="main_photo"/>
                    </div>
                </div>
            </form>           
        </div>
    </div>
</div>

<script>
    $('#choosephotos').on('click', function(){
        $('#file').trigger('click');
    });


    $("#file").change(function() {
        $('#dropzone').html('');
    var file = this.files[0];
    var imagefile = file.type;

    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
        
        swal(
        'Invalid image file',
        'Please select a valid image file!',
        'warning'
        );
        return false;
    }
    else
    {
        
        $.each(this.files, function(index, value) {
            if ((value.size / 5000000) <= 1){
                readURL(this, index);
                }else {
                alert("Maximum file size is 5MB only.");
            }
        });
        
    }
    });


    function readURL(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
            
            var check = "<div class=\"check selected\" style=\"background-color:rgba(30, 112, 132,0.7); padding:5px; top: 0; right: 0; z-index:9; position: absolute;\">" +
                    "<h6 class=\"text-right\">" +
                        "<button id=\"" + file.name  + "\" style=\"background-color:transparent;border-style:none;padding:5px;cursor:pointer;\" class=\"setMainImg\"><i class=\"fa fa-check\" style=\"color:#fff;\"></i></button>" +
                        "</h6>" +                 
                    "</div>"
            var main = index == 0 ? check : '';
            $('#main_photo').val( file.name.split(',')[0] );

            $('#dropzone').append(
                $( "<div class=\"image-con\" id= \"" + file.name + "\">" +
                "<img class=\"image\" src=\"" + e.target.result + "\" title=\"" + file.name.split(',')[0] + "\" id='" + file.name.split(',')[0] + "'/>"+
                    main +
                "</div>")
            );
        }
        reader.readAsDataURL(file);
    }


    $('body').on('click', '.image', function() {
		$('.image').attr('class', 'image');
		$(this).attr('class', 'image selected')
		$('#main_photo').val($(this).attr('id'));
				
        var check = "<div class=\"check selected\" style=\"background-color:rgba(30, 112, 132,0.7); padding:5px; top: 0; right: 0; z-index:9; position: absolute;\">" +
                    "<h6 class=\"text-right\">" +
                        "<button id=\"" + file.name  + "\" style=\"background-color:transparent;border-style:none;padding:5px;cursor:pointer;\" class=\"setMainImg\"><i class=\"fa fa-check\" style=\"color:#fff;\"></i></button>" +
                        "</h6>" +                 
                    "</div>"

        $(".check").remove();
        $(this).parent().append(check);

        swal(
            "Main image has been changed!", 
            "", 
            "success"
        );
		
    });



</script>

<style>
   
    #dropzone {
        overflow-y: auto; 
    }

    div.image-con { 
        width: 140px!important;
        height: 140px!important; 
        overflow: hidden; 
        float: left; 
        padding: 5px; 
        position: relative; 
        overflow: hidden;
        background-size: cover;
        background-position: center;
        margin: 2px;
        }
    .image {
        width: 140px!important;
    }

</style>