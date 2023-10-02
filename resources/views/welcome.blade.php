<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>
    <b> Live Score</b><span id="test-data"></span>
</p>
<script src="{{ asset('js/app.js')}}"></script>
<script>
    Echo.channel('test').listen('GroundEvent', (event)=>{
        document.getElementById('test-data').innerHTML = event.test;

        console.log(event);

    });
</script>
</body>
</html>
