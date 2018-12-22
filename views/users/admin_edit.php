
        <h3>Add new user</h3>
        <hr/>
            <form method="POST">
                 <input type="hidden" class="form-control" name="id" value="<?=$this->data['userid'] ?>" required>
                 <div class="row row-sm-offset">

                         <div class="col-xs-12 col-md-4">
                             <div class="form-group">
                                 <label class="form-control-label" for="form1-9-name">Last name<span class="form-asterisk">*</span></label>
                                 <input type="text" value="<?=$this->data['lname'] ?>" class="form-control" name="lname" required="" data-form-field="Lname" id="form1-9-lname">
                             </div>
                         </div>

                         <div class="col-xs-12 col-md-4">
                             <div class="form-group">
                                 <label class="form-control-label" for="form1-9-email">First name<span class="form-asterisk">*</span></label>
                                 <input type="text" value="<?=$this->data['fname'] ?>" class="form-control" name="fname" required="" data-form-field="Fname" id="form1-9-fname">
                             </div>
                         </div>


                </div>

                <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                               <label class="form-control-label" for="form1-9-gender">Gender</label>
                               <select name="gender" class="form-control" required id="form1-9-gender">
                                         <option value="1" <?php if ($this->data['gender'] == "1") echo "selected"; ?>>Male</option>
                                         <option value="2" <?php if ($this->data['gender'] == "2") echo "selected"; ?>>Female</option>
                               </select>
                           </div>
                      </div>

                      <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                               <label class="form-control-label" for="form1-9-birthdate">Birthdate</label>
                               <input type="date" value="<?=date('Y-m-d', strtotime($this->data['birthdate'])) ?>"class="form-control" name="birthdate" required="" data-form-field="Date" id="form1-9-birthdate">
                           </div>
                      </div>

                      <div class="col-xs-12 col-md-4">
                          <div class="form-group">
                              <label class="form-control-label" for="form1-9-phone">Position<span class="form-asterisk">*</span></label>
                              <input type="text" value="<?=$this->data['position'] ?>" class="form-control" name="position" data-form-field="MName" id="form1-9-mname">
                          </div>
                      </div>

               </div>
			
               <br/>
               <hr/>
               <div class="row row-sm-offset">
                     <div class="col-xs-12 col-md-4">
                          <div class="form-group">
                              <button class="btn btn-success"><i class="fa fa-floppy-o fa-lg"></i>&nbsp;Save</button>
                          </div>
                    </div>
               </div>
               <br/>
            </div>
            </form>
