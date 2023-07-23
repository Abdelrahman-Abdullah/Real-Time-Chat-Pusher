@props(['user'])
    <!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>V-CHAT</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  media='screen' href="{{asset('chat/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" integrity="sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
<div class="container">
    <div class="chat-header">
        <a href="/users" class="border">
              <i class="fa-solid fa-chevron-left"></i>
        </a>
        <span >Live Chat with : {{$user->name}}</span>
    </div>
    <div class="chat-body" id="chatBody">

    </div>
    <div class="chat-footer">
        <input type="text"  name="message" id="message" placeholder="type your message">
        <button type="submit" id="send"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<script>
    $("#send").click(function (){
        $.post("/chat/{{$user->id}}" ,
            {
                message: $("#message").val(),

            }, function (data) {
                let senderMessage = '' +
                    '<div class="message" id="left">'+
                    '<div class="message-box received"><p>'+$("#message").val()+'</p></div></div>';
                $("#chatBody").append(senderMessage);
                $("#message").val('');
            });
    });

    var pusher = new Pusher('Pusher `APP Key` Here', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('chat{{auth()->id()}}');
    channel.bind('push-message', function(data) {
        let receiverMessage = '' +
            '<div class="message" id="right">'+
            '<div class="message-box sent"><p>'+data.message+'</p></div></div>';
        $("#chatBody").append(receiverMessage);
        $("#message").val('');
    });
</script>
</body>
</html>
