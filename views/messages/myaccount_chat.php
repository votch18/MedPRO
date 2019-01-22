
<?php
    $account = new Account();
    $account = $account->getAccountByUserId($this->data['sender']);

    if( file_exists(realpath('uploads/users/'.$account['photo'])) && !is_dir(realpath('uploads/users/'.$account['photo'])) ) {
        $img = $account['photo'];
    } else {
        $img = "admin.png";
    }
?>

<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border col-12">
    <div class="au-inbox-wrap">
        <div class="au-chat au-chat--border">
            <div class="au-chat__title">
                <div class="au-chat-info">
                    <div class="avatar-wrap online">
                        <div class="avatar avatar--small">
                            <img src="/uploads/users/<?=$img?>" alt="<?=$account['fname'].' '.$account['lname']?>">
                        </div>
                    </div>
                    <span class="nick">
                        <a href="#"><?=$account['fname'].' '.$account['lname']?></a>
                    </span>
                </div>
            </div>
            <div class="au-chat__content au-chat__content2 js-scrollbar5">
            <?php

            foreach ( $this->data['data'] as $row ){ 
               
                if ( $row['receiver'] == Session::get('userid')) {
            ?>

                <div class="recei-mess-wrap">
                    <span class="mess-time"><?=Util::get_chat_time($row['date'])?></span>
                    <div class="recei-mess__inner">
                        <div class="avatar avatar--tiny">
                            <img src="/uploads/users/<?=$img?>" alt="<?=$row['sender_name']?>">
                        </div>
                        <div class="recei-mess-list">
                            <div class="recei-mess"><?=$row['message']?></div>
                        </div>
                    </div>
                </div>

                <?php
                } else { 
                ?>
                <div class="send-mess-wrap">
                    <span class="mess-time"><?=Util::get_chat_time($row['date'])?></span>
                    <div class="send-mess__inner">
                        <div class="send-mess-list">
                            <div class="send-mess"><?=$row['message']?></div>
                        </div>
                    </div>
                </div>

            <?php
                }
            }
            ?>
               
            </div>
            <div class="au-chat-textfield">
                <form class="au-form-icon" method="POST">
                    <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message" id="message">
                    <button class="au-input-icon" id="send">
                        <i class="zmdi zmdi-mail-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var count = 0;
	var old_count = "<?=count($this->data['data'])?>";
    var sender = "<?=$this->data['sender']?>";
    var sender_name = "<?=$account['fname'].' '.$account['lname']?>";

    $('#send').on('click', function (e) {
        e.preventDefault();

        var message = {
            receiver: sender,
            message: $("#message").val(),
        }

        sendMessage(message).done(function($data){
            $data = JSON.parse($data);

            if ($data.result){
                console.log('sent...');
                $('.au-chat__content').append(
                    '<div class="send-mess-wrap">' +
                    '<span class="mess-time">1 second ago</span>' +
                    '<div class="send-mess__inner">' +
                        '<div class="send-mess-list">' +
                            '<div class="send-mess">' + $("#message").val() + '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'
                );

                scrolltoBottom();

                $("#message").val('');
            }
        });
    });


    /**
    * Add product to cart
    */
    function sendMessage(message){
        
        return $.ajax({
            type: 'POST',
            url: '/ajax/messages/send/',
            data: message,
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(response){
                switch(response.message){
                    case 'success': 
                        break
                    case 'error':
                        //show sweetalert error message
                        console.log('error sending message...');
                        break
                }
            }
        });
    }

    function scrolltoBottom(){
        old_count = count;
        $(".au-chat__content").animate({ scrollTop: $('.au-chat__content').prop("scrollHeight")}, 1000);
    }
    
    scrolltoBottom();


    /**
        * if logged-in fetch for customer's order or pending order
        */
    function get_messages(){
        
        return $.ajax({
            type: 'POST',
            url: '/ajax/messages/get_messages/',
            data: { sender: "<?=$this->data['sender']?>" ,
                    receiver: "<?=Session::get('userid')?>",
                },
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function (response) {
                if (response) {    
                }
            }
        });
    }
   
    /**
        * fetch order's every second and display to cart
        */
    setInterval(() => {
        get_messages().done(function($data) {
            $data = JSON.parse($data);
            
            var $count = 0;
            var message_content = '';
            count = $data.length;

            $.each( $data, function(index, value){
                
                if ( count != old_count ) {
                    
                    var $date = new Date(Date.parse(value.date));
                    var today = new Date();                   
                    var time_diff = Math.abs($date.getTime() - today.getTime());

                    //play sound 
                    if(value.is_read == '0' && (time_diff < 1000 && time_diff > -1000)){
                        $('audio#pop')[0].play();
                    }

                    if ( value.sender == sender ) {
                        message_content += '<div class="send-mess-wrap">' +
                                                '<span class="mess-time">' + get_chat_time(time_diff)  + '</span>' +
                                                '<div class="send-mess__inner">' +
                                                    '<div class="send-mess-list">' +
                                                        '<div class="send-mess">' +  value.message + '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                       
                    } else {
                        message_content += '<div class="recei-mess-wrap">' + 
                                                '<span class="mess-time">' + get_chat_time(time_diff) + '</span>' +
                                                '<div class="recei-mess__inner">' +
                                                    '<div class="avatar avatar--tiny">' +
                                                        '<img src="/uploads/users/<?=$img?>" alt="' + sender_name + '">' +
                                                    '</div>' +
                                                    '<div class="recei-mess-list">' +
                                                        '<div class="recei-mess">' + value.message + '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';

                    }                   
                }
                   
            });

            if ( count != old_count ) {
                $('.au-chat__content').html('');
                $('.au-chat__content').append(message_content);

                scrolltoBottom();
            }
        });
    }, 1000);

    /** Notification button is click */
    setTimeout(() => {
        read_messages();
    }, 500);

    /**
        * mark all notifications as read
        */
    function read_messages(){
        
        return $.ajax({
            type: 'POST',
            url: '/ajax/messages/read_messages/',
            data: { action: "read_messages" },
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function (response) {
                if (response) {    
                }
            }
        });
    }

    function get_chat_time($time){
        var $seconds;
        var $minutes;
        var $hours;
        var $days;
        var $months;
        var $years;

        $seconds = Math.floor($time / 1000);
        $minutes = Math.floor($seconds / 60);
        $hours = Math.floor($minutes / 60);
        $days = Math.floor($hours / 24);
        $months = Math.floor($days / 30);
        $years = Math.floor($months / 12);

        if ( $years > 0 ) {
           return ($years == 1) ? '1 year ago' : $years + ' years ago';
        } else if ( $months > 0 ) {
            return ($months == 1) ? '1 month ago' : $months +' months ago';
        } else if ( $days > 0 ) {
            return ($days == 1) ? '1 day ago' : $days + ' days ago';
        } else if ( $hours > 0 ) {
            return ($hours == 1) ? '1 hour ago' : $hours + ' hours ago';
        } else if ( $minutes > 0 ) {
            return ($minutes == 1) ? '1 minute ago' : $minutes + ' minutes ago';
        } else {
            return ($seconds == 1) ? '1 second ago' : $seconds + ' seconds ago';
        }
    }

</script>