<div class="card" style="width:  100%;">
    <div class="card-header">Products</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add Stocks</h3>
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
                            <label for="description" class="control-label mb-1">Unif of Measure</label>
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