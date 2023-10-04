<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>

<div id="start-chat">
    <form id="save-name">
        <input type="text" value="" id="name" placeholder="Enter Name">
        <input type="submit" value="Let's Chat">
    </form>
</div>
<div id="chat-part">
    <form id="chat-from">
        @csrf
        <input type="text" name="message" id="message" placeholder="Enter message">
        <input type="submit" value="send">
        <div id="user_id"> <input type="hidden" name="username" id="username" readonly></div>
    </form>
    <div id="chat-container">
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>

<script>

    $('#chat-part').hide();

    $('#start-chat').submit(function (event) {
        event.preventDefault();
        $('#username').val($('#name').val());
        $('#start-chat').hide();
        $('#chat-part').show();
    });

    $('#chat-from').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "{{route('broadCastMessage')}}",
            type: 'POST',
            data: formData,
            success: function () {
                $('#message').val('');
            }
        });
    });

    Echo.channel('message').listen('MessageEvent', (e) => {
        // let html = '<div class="container">'+
        //     // '<img src="https://example.com/path/to/your/profile/image.jpg" style="width:100%;">'+
        //     '<br><b>' + e.userName +'</b><br>' +
        //     '<p>' + e.message + '</span>'+
        //     '<span>'+e.time+'</span>'+'</div>';


            let html = ' <div class="container">'+
        '<div><b>'+e.userName+'</b></div>'+
        '<p>'+e.message+'</p>'+
        '<span class="time-right">'+e.time+'</span>'+
      '</div>';

        $('#chat-container').append(html);
    });


    function scrollToBottom() {
    var chatContainer = document.getElementById("chat-container");
    chatContainer.scrollTop = chatContainer.scrollHeight;
}


</script>
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #d8eed9;
  border-radius: 15px;
  padding: 0px;
  margin: 5px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #070707;
}

.time-left {
  float: left;
  color: #999;
}


#message {
    background-color: #b5e0ab;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    max-width: 80%; /* Adjust as needed */
}

#name {
    font-weight: bold;
    color: #090111; /* Username color */
    background-color: #b5e0ab;
}

#chat-container {
    color: #333; /* Message text color */

    max-height: 70%; /* Adjust the max height as needed */
    max-width: 80%; /* Adjust as needed */
    overflow-y: scroll; /* Always show vertical scrollbar */
    overflow-x: hidden; /* Hide horizontal scrollbar (if any) */
}

</style>
</body>
</html>
