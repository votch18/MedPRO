
<h4>Add Member</h4>
<br/>

<form method="POST" enctype="multipart/form-data">

    <span>Member's Information</span>
    <hr/>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="lname">Last Name<span class="form-asterisk">*</span></label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="lname" value="" required="">
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="fname">First Name<span class="form-asterisk">*</span></label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="fname" value="" required="">
        </div>
        <div class="col-md-3">
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="form1-9-mname">Middle Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="mname" value="">
        </div>
        <div class="col-md-3">
            <small class="text-muted">Optional</small>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="form1-9-extn">Extn</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="extn" value="">
        </div>
        <div class="col-md-3">
            <small class="text-muted">(ex. Jr., Sr.) Optional</small>
        </div>
    </div>

    
    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="file">Photo</label>
        </div>
        <div class="col-md-6">
            <input type="file" class="form-control" name="file" id="file" title="Click here to select file to upload." value="" >
        </div>
        <div class="col-md-3">
            <small class="text-muted">Add photo (2x2)</small>
        </div>
    </div>



    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="form1-9-birthdate">Birthdate<span class="form-asterisk">*</span></label>
        </div>
        <div class="col-md-6">
            <input type="date" class="form-control" name="birthdate" value="<?=date('Y-m-d', strtotime("now")) ?>">
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="form1-9-gender">Gender<span class="form-asterisk">*</span></label>
        </div>
        <div class="col-md-6">
            <select name="gender" class="form-control" required="">
                <?php
                $gender = new Member();
                $category = $gender->getGender();
                foreach ($category as $res) { ?>
                    <option value="<?= $res['lid']?>"><?= $res['description']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="civil_status">Civil Status</label>
        </div>
        <div class="col-md-6">
            <select name="civil_status" class="form-control" required="">
                <option >Select Civil Status</option>
                <?php
                $civilstatus = new Member();
                $category = $civilstatus->getCivilStatus();
                foreach ($category as $res) { ?>
                    <option value="<?= $res['lid']?>"><?= $res['description']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="mobile">Mobile</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="" >
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="source_of_income">Source of Income</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="source_of_income" placeholder="Source of Income"  value="" required="" >
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <span>Address</span>
    <hr/>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="province">Province</label>
        </div>
        <div class="col-md-6">
            <select name="province" class="form-control" required="">
                <?php
                $province = new Place();
                $category = $province->getProvince();
                foreach ($category as $res) { ?>
                    <option value="<?= $res['lid']?>"><?= $res['province']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="municipality">Municipality</label>
        </div>
        <div class="col-md-6">
            <select name="municipality" class="form-control" required="">
                <?php
                $mun = new Place();
                $category = $mun->getMunicipality();
                foreach ($category as $res) { ?>
                    <option value="<?= $res['lid']?>"><?= $res['description']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="brgy">Barangay</label>
        </div>
        <div class="col-md-6">
            <select name="brgy" class="form-control" required="">
                <?php
                $brgy = new Place();
                $category = $brgy->getBarangay();
                foreach ($category as $res) { ?>
                    <option value="<?= $res['lid']?>"><?= $res['barangay']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="address">Purok</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="purok" value="" required>
        </div>
        <div class="col-md-3">
        </div>
    </div>





    <span>Spouse's Information</span>
    <hr/>

    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="spouse_fname">First Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="spouse_fname" placeholder="First Name" value="" >
        </div>
        <div class="col-md-3">
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-3 text-md-right">
            <label class="form-control-label" for="spouse_lname">Last Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="spouse_lname" placeholder="Last Name"  value="" >
        </div>
        <div class="col-md-3">
        </div>
    </div>


    <hr/>
    <div class="row mb-3 mt-3">
        <div class="col-md-6 text-md-left ">
            <a href="/admin/members/" class="btn btn-secondary btn-lg" style="width: 150px;">Back</a>
        </div>
        <div class="col-md-6 text-right">
            <input type="submit" class="btn btn-primary btn-lg" value="Submit" style="width: 150px;"/>
        </div>
    </div>


</form>
