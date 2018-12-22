<?php if (count($this->data['data']) > 0 ) { ?>
    <form method="POST">
        <table class="table table-striped">
             <thead>
                  <td><strong>Particulars</strong></td>
                  <td width="60%"><strong>Value</strong></td>

             </thead>

                 <?php foreach ($this->data['data'] as $res) { ?>
                      <tr>
                           <td>
                               <input class="form-control" type="hidden" name="id[]" value="<?=$res['lid'] ?>" />
                               <?=$res['description'] ?>
                           </td>
                           <td><input class="form-control" type="text" name="value[]" value="<?=$res['value'] ?>" /></td>
                      </tr>

                 <?php } ?>
        </table>

        <button class="btn btn-primary">SAVE</button>
    </form>
<?php } else { Session::setFlash("No record found!"); } ?>
