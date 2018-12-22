 <div class="card-body">
        <div class="table-responsive">
            <?php if (count($this->data['data']) > 0 ) { ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Period</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
						<th >Status</th>
                        <th>Action</th>
                    </tr>
					
                    </thead>
                    <tbody>
                    <?php foreach ($this->data['data'] as $res) { ?>
                        <tr>
                            <td><?=$res['loan_id'] ?></td>
                            <td><?=$res['period'] ?></td>
                            <td><?=Util::d_format($res['date_due']); ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['amortization']) ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['payment']); ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['balance']); ?></td> 
							<th><?=($res['payment'] -$res['amortization']) < 0 ? '' : '<span class="btn btn-success">Paid</span>'?></th>
                          
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>

            <?php } else { Session::setFlash("No record found!"); } ?>

        </div>
    </div>