
        <h3>Change Password</h3>
        <hr/>
        <div class="row row-sm-offset">

            <div class="col-xs-12 col-md-6">
            <form method="POST">
                <input type="hidden" class="form-control" name="id" value="<?=Session::get('userid')?>" required>
                <table class="table table-striped">
                    <tr>
                        <td>Email</td>
                        <td><input type="email" class="form-control" name="usn" value="<?=Session::get('username')?>" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" class="form-control" name="pwd" required></td>
                    </tr>
                    <tr>
                        <td>Confirm password</td>
                        <td><input type="password" class="form-control" name="confirm" required></td>
                    </tr>
                </table>
                <button class="btn btn-success"><i class="fa fa-floppy-o fa-lg"></i>&nbsp;Save</button>
            </form>
            </div>
        </div>
