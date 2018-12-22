<?php

if (empty($this->data)) {
    $this->news = array_slice($this->data, 0, 1);
}

?>

    <a href="/admin/users/add/" class="btn btn-success">
        <i class="fa fa-user-plus fa-lg"></i>&nbsp;Add new user
    </a>
    <hr/>
    <?php if (count($this->data) > 0)  {  ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <td>#</td>
            <td>Last Name</td>
            <td>First Name</td>
            <td>Username</td>
		  <td>Branch</td>
            <td>Role</td>
            <td>Action</td>

        </tr>
        </thead>
        <tr>
            <?php
            $count = 1;
            foreach ($this->data as $res) {

            ?>
            <td><?= $count++ ?></td>
            <td><?= $res['lname'] ?></td>
            <td><?= $res['fname'] ?></td>
            <td><?= $res['username'] ?></td>
			<td><?= $res['branch_assignment'] ?></td>
               	<td><?=($res['access'] == "1") ? "Administrator" : "Cashier" ?></td>
            <td>
                <a href="/admin/users/edit/<?= $res['userid'] ?>" class="btn btn-info"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                <a href="/admin/users/delete/<?= $res['userid'] ?>" class="btn btn-danger" onclick="return confirmDelete();"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            </td>
        </tr>

        <?php } ?>
    </table>
    <?php }

    else {
        Session::setFlash("<strong>No records found!</strong>");
    }?>
