<div class="wrapper">
    <div class="iwrapper">
        <h3>Update Account Information</h3>
        <hr/>
        <div class="h-wrapper">
            <form method="POST">
                <input type="hidden" class="form-control" name="id" value="<?=$this->data['userid'] ?>" required>
                <table class="table table-striped">
                    <tr>
                        <td>Firstname</td>
                        <td><input type="text" class="form-control" name="fname" value="<?=$this->data['fname'] ?>"required></td>
                    </tr>
                    <tr>
                        <td>Lastname</td>
                        <td><input type="text" class="form-control" name="lname" value="<?=$this->data['lname'] ?>"required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" class="form-control" name="email" value="<?=$this->data['email'] ?>"required></td>
                    </tr>
                    <tr>
                        <td>Employment</td>
                        <td><input type="text" class="form-control" name="employment" value="<?=$this->data['employment'] ?>"required></td>
                    </tr>
                    <tr>
					  </tr>
                    <tr>
                        <td>Branch</td>
                        <td><input type="text" class="form-control" name="branch" value="<?=$this->data['branch_assignment'] ?>"required></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input type="text" class="form-control" name="address" value="<?=$this->data['address'] ?>"required></td>
                    </tr>
                    <tr>
                        <td>About me</td>
                        <td><textarea name="about" rows="5" class="form-control" required><?= $this->data['about'] ?></textarea></td>
                    </tr>
                </table>
                <button class="btn btn-success"><i class="fa fa-floppy-o fa-lg"></i>&nbsp;Save</button>
            </form>
        </div>
    </div>
</div>