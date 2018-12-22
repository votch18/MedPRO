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
                         <th style="width: 50px;">Action</th>
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
                                <a href="/admin/members/activate/<?=$res['member_id']?>" title="Restore" class="btn btn-info btn-xs btn-restore" ><i class="fa fa-reply fa-lg"></i></a>
                           </td>
                      </tr>

                 <?php } ?>

                </tbody>
            </table>


<?php } else { Session::setFlash("No record found!"); } ?>

        </div>
    </div>

</div>