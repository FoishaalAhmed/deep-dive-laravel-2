<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://chat.laravel.pusher.edlin.app/style.css">

    <script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="chat">
        <div class="top">
            <img src="" alt="avt">
            <div>
                <p>foisal</p>
                <small>online</small>
            </div>
        </div>

        <div class="messages">
            @include('pusher-receive', ['message' => 'hey whats up?'])
        </div>

        <div class="bottom">
            <form action="">
                <input type="text" name="message" placeholder="Type your message" id="message" autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>

    </div>
    <script>
        const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'mt1'});
        const channel = pusher.subscribe('public');
      
        //Receive messages
        channel.bind('chat', function (data) {
          $.post("/receive", {
            _token:  '{{csrf_token()}}',
            message: data.message,
          })
           .done(function (res) {
             $(".messages > .message").last().after(res);
             $(document).scrollTop($(document).height());
           });
        });
      
        //Broadcast messages
        $("form").submit(function (event) {
          event.preventDefault();
      
          $.ajax({
            url:     "/broadcast",
            method:  'POST',
            headers: {
              'X-Socket-Id': pusher.connection.socket_id
            },
            data:    {
              _token:  '{{csrf_token()}}',
              message: $("form #message").val(),
            }
          }).done(function (res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
          });
        });
      
      </script>
</body>
</html>