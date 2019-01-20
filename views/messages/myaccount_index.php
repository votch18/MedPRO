<div class="col-lg-12">
    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">        
        <div class="au-inbox-wrap js-inbox-wrap">
            <div class="au-message js-list-load">
                <div class="au-message__noti">
                    <p>You Have
                        <span>2</span>
                        new messages
                    </p>
                </div>
                <div class="au-message-list">

                <?php
                    $msg = new Message();
                    $messages = $msg->getAdminThread();

                    foreach($messages as $row) {
                        
                        if( file_exists(realpath('uploads/users/'.$row['sender_pic'])) && !is_dir(realpath('uploads/users/'.$row['sender_pic'])) ) {
                            $img = $row['sender_pic'];
                        } else {
                            $img = "admin.png";
                        }

                        $sender = ($row['sender'] == Session::get('userid')) ? $row['receiver'] : $row['sender'];
                ?>
                
                    <div class="au-message__item unread msg" id="<?=$sender?>">
                        <div class="au-message__item-inner">
                            <div class="au-message__item-text">
                                <div class="avatar-wrap">
                                    <div class="avatar">
                                        <img src="/uploads/users/<?=$img?>" alt="<?=$row['sender_name']?>">
                                    </div>
                                </div>
                                <div class="text">
                                    <h5 class="name"><?=$row['sender_name']?></h5>
                                    <p><?=$row['message']?></p>
                                </div>
                            </div>
                            <div class="au-message__item-time">
                                <span><?=Util::date_format($row['date'], 'Y-m-d H:m A')?></span>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>                   
                <div class="au-message__footer">
                    <button class="au-btn au-btn-load js-load-btn">load more</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    $('body').on('click', '.msg', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        window.location = "/me/messages/chat/" + id;
    });

</script>