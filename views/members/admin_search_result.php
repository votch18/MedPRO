<h4>Search results for <strong><?=$this->data['query']?></strong> <?= " - ".count($this->data['data'])." record(s) found."?></h4>
<?php if (count($this->data['data']) > 0 ) { ?>
<table class="table table-striped">
     <thead>
          <td>ID#</td>
          <td>Name</td>
          <td>Gender</td>
          <td>Birthdate</td>
          <td>Email</td>
          <td>Subscription</td>
          <td>Purok</td>
          <td>Barangay</td>
          <td>Action</td>
     </thead>

     <?php foreach ($this->data['data'] as $res) { ?>
          <tr>
               <td><?=$res['idno'] ?></td>
               <td><?=$res['lname'].', '.$res['fname'].' '.$res['extn'].' '.$res['mname'] ?></td>
               <td><?=$res['gender'] ?></td>
               <td><?=date('Y-m-d', strtotime($res['birthdate'])) ?></td>
               <td><?=$res['email'] ?></td>
               <td>
                    <?=$res['subscription'] ?>
                    <a href="/admin/subscribers/upgrade/<?=$res['idno']?>" class="btn btn-info btn-xs">Upgrade</a>
                    </td>
               <td><?=$res['purok'] ?></td>
               <td><?=$res['barangay'] ?></td>
               <td>
                    <?php if((int)$res['is_active'] == 1) { ?>
                         <a href="/admin/subscribers/deactivate/<?=$res['idno']?>" class="btn btn-warning btn-xs" onclick="return confirmDelete('Are you sure you want to deactivate this account?');"><i class="fa fa-warning fa-lg"></i></a>
                    <?php }else{ ?>
                         <a href="/admin/subscribers/activate/<?=$res['idno']?>" class="btn btn-info btn-xs" onclick="return confirmDelete('Activate this account?');"><i class="fa fa-refresh fa-lg"></i></a>
                    <?php } ?>
               </td>
          </tr>

     <?php } ?>
</table>


<?php } else { Session::setFlash("No record found!"); } ?>
