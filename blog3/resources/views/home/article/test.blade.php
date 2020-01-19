<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>
    // var ws = new WebSocket("ws://172.17.0.2");
    var ws = new WebSocket("ws://127.0.0.1:9501/");
    ws.onopen = function (evt) {
        ws.send("hello_hello")
        console.log("connect-success")
    }
    ws.onmessage = function (evt) {
        console.log(123)
        console.log(evt)
        console.log(evt.data);
    };

    ws.onclose = function (evt) {
        console.log("close connect")
    }

    ws.onerror = function (evt) {
        console.log("error: " + evt.data)
    }
</script>
</body>
</html>
