<!-- Icon Cards-->
<div class="row pt-3">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-users"></i>
                </div>
                <div class="mr-5">
                    <h2>
                        <strong>
                        
                        <?php
                        $member = new Member();

                        echo count($member->getMembers());

                        ?> Members
                        </strong>
                    <h2>
                </div>
            </div>

            <a class="card-footer text-white clearfix small z-1" href="/admin/members/new/">
                <span class="float-left">Add new</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-dollar"></i>
                </div>
                <div class="mr-5">
                    <h2>
                        <strong>
                        
                        <?php
                        $loan = new Loan();

                        $open = $loan->getOpenLoans();
                        echo $open['open_loans'];

                        ?> Open Loans
                        </strong>
                    <h2>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>


    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-dollar"></i>
                </div>
                <div class="mr-5">
                    <h2>
                        <strong>
                        
                        <?php
                     
                        $close = $loan->getCloseLoans();
                        echo $close['close_loans'];
                    

                        ?> Close Loans
                        </strong>
                    <h2>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-support"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
</div>



<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header clearfix small z-1">
                <a class="" href="/admin/funds/">
                    <h4 class="float-left">FUNDS</h4>
                </a>
                <span class="btn btn-info float-right">
                    <i class="fa fa-print"></i>
                </span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th >Fund Type</th>
                        <th style="text-align: right;">Total</th>
                        <th style="text-align: right;">Loan <small>(Open)</small></th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                <?php
                    $fund = new Fund();
                    $funds = $fund->getFundsByType();

                    $total = 0;
                    $amount = 0;
                    $loan = 0;
                    $x = 0;
                    foreach($funds as $res){ 
                        $loan += $res['loans'];
                        $amount += $res['amount'];
                        $total += $res['total'];
                        $x++;
                ?>
                        <tr>
                            <td style="width: 30px;"><?=$x ?></td>
                            <td><?=$res['description'] ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['total'], 2) ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['loans'], 2) ?></td>
                            <td style="text-align: right;"><?=Util::n_format($res['amount'], 2) ?></td>
                        </tr>
                <?php
                    }
                ?>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td style="text-align: right;"><strong><?=Util::n_format($total, 2) ?></strong></td>
                            <td style="text-align: right;"><strong><?=Util::n_format($loan, 2) ?></strong></td>
                            <td style="text-align: right;"><strong><?=Util::n_format($amount, 2) ?></strong></td>
                        </tr>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header clearfix small z-1">
                <a class="" href="/admin/funds/">
                    <h4 class="float-left">ACCOUNTS</h4>
                </a>
                <span class="btn btn-info float-right">
                    <i class="fa fa-print"></i>
                </span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th >Account Code</th>
                        <th >Description</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                <?php
                    $account = new Account();
                    $accounts = $account->getAccountsSummary();

                    $total = 0;
                    $x = 0;

                    foreach($accounts as $res){ 
                       
                        $total += $res['amount'];
                        $x++;
                ?>
                        <tr>
                            <td style="width: 30px;"><?=$x ?></td>
                            <td><?=$res['account_code'] ?></td>
                            <td><?=$res['description']?></td>
                            <td style="text-align: right;"><?=Util::number_format($res['amount'], 2) ?></td>
                        </tr>
                <?php
                    }
                ?>
                        <tr>
                            <td></td>
                            <td colspan="2"><strong>Total</strong></td>
                            <td style="text-align: right;"><strong><?=Util::number_format($total, 2) ?></strong></td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</div>