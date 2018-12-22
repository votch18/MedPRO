<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> LIST OF MEMBERS
        <div class="pull-right">
            <a class="btn btn-success" href="/admin/members/new/">
                <i class="fa fa-fw fa-user"></i>Add Member</a>

			<a class="btn btn-success" href="/print/members/">
                <i class="fa fa-fw fa-print"></i>Add Member</a>
				
            <button type="button" class="btn btn-info" onclick="printJS({ printable: 'dataTable', type: 'html', header: 'PrintJS - Form Element Selection' })">
                <i class="fa fa-print"></i> Print
            </button>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive" id="print">

<?php if (count($this->data['data']) > 0 ) { ?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                 <thead>
                     <tr>
                         <th>ID#</th>
                         <th>Name</th>
                         <th>Birthdate</th>
                         <th>Address</th>
                         <th>Mobile #</th>
                         <th style="width: 80px;">Action</th>
                     </tr>

                 </thead>
                <tbody>
                 <?php foreach ($this->data['data'] as $res) { ?>
                      <tr>
                           <td><?=$res['member_id'] ?></td>
                           <td><?=$res['lname'].', '.$res['fname'].' '.$res['extn'].' '.$res['mname'] ?></td>
                           <td><?=date('m-d-Y', strtotime($res['birthdate'])) ?></td>
                           <td><?=$res['address'] ?></td>
                           <td><?=$res['mobile'] ?></td>
                           <td>
                                <a href="/admin/members/edit/<?=$res['member_id']?>" title="Edit" class="btn btn-primary btn-xs"><i class="fa fa-edit fa-lg"></i></a>
                                <a href="/admin/members/deactivate/<?=$res['member_id']?>" title="Delete" class="btn btn-danger btn-xs btn-delete" ><i class="fa fa-trash-o fa-lg"></i></a>
                           </td>
                      </tr>

                 <?php } ?>

                </tbody>
            </table>


<?php } else { Session::setFlash("No record found!"); } ?>

        </div>
    </div>

</div>

<!-- Register Member Modal-->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTER MEMBER</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?= isset($this->data['member']['fname']) ? $this->data['member']['fname'] : null ?>" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name"  value="" required="">
                            </div>
                        </div>

                    </div>

                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="mname" placeholder="Middle Name" value="" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="birthdate" placeholder="Birthdate"  value="" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <select name="gender" class="form-control" required="">
                                    <option >Select Gender</option>
                                    <?php
                                    $gender = new Member();
                                    $category = $gender->getGender();
                                    foreach ($category as $res) { ?>
                                        <option value="<?= $res['lid']?>"><?= $res['description']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
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
                        </div>
                    </div>

                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Address" value="" required="">
                            </div>
                        </div>

                    </div>


                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="" required="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="source_of_income" placeholder="Source of Income"  value="" required="">
                            </div>
                        </div>
                    </div>

                    <h5>SPOUSE</h5>
                    <hr/>
                    <div class="row row-sm-offset">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="spouse_fname" placeholder="First Name" value="" >
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="spouse_lname" placeholder="Last Name"  value="" >
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
                <input type="submit" class="btn btn-primary" value="SAVE">
            </div>
            </form>
        </div>
    </div>
</div>