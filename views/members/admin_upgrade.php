
     <h3>Upgrade Subscription</h3>
     <hr/>

     <table class="table table-striped">
          <tr>
               <td style="width: 150px;">Name:</td>
               <td><?=ucfirst($this->data['fname']).' '.ucfirst($this->data['lname']) ?></td>
          </tr>
          <tr>
               <td style="width: 150px;">Address:</td>
               <td><?=ucfirst($this->data['barangay']).', '.ucfirst($this->data['municipality']) ?></td>
          </tr>
     </table>
     <form method="POST">
          <input type="hidden" name="id" value="<?=$this->data['idno'] ?>" required/>
         <hr/>
          <div class="row row-sm-offset">
                 <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="form1-9-munid">Subscription<span class="form-asterisk">*</span></label>
                        <select name="subscription" class="form-control select2" required="">
                               <?php
                               $mun = new Plan();
                               $category = $mun->getPlans();
                               foreach ($category as $res) { ?>
                                    <option value="<?= $res['lid']?>"><?= $res['description'].' @ '.$res['amount'].' /mo.'?></option>
                               <?php } ?>
                          </select>
                    </div>
               </div>
          </div>
          <hr/>
         <button class="btn btn-primary">SAVE</button>
    </form>
