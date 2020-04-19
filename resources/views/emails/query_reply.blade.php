<!DOCTYPE html>
<html>
<head>
	<title>Send Email</title>
</head>
<body>
    <h2 style="text-decoration: none">Hello {{$user_email}}, </h2>
    <br><br>
    <div style="font-size: 14">
        <p>This is the reply of your query for task: <b>{{$task_title}}</b>,</p>
        <br>
        <p>{{$reply}}</p>
    </div>
    <br>
    <br>
    <h5>Lazy Owl</h5>
    <h6 style="text-decoration: underline">
        app.lazyowl@gmail.com
    </h6>
</body>
</html>