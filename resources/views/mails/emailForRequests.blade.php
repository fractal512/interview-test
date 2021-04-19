<!DOCTYPE html>
<html>
<head>
    <title>New User Request</title>
</head>
<body>
<h1>New User Request</h1>
<ul>
    <li>ID: {{ $request->id }}</li>
    <li>Subject: {{ $request->subject }}</li>
    <li>Message: {{ $request->message }}</li>
    <li>Client Name: {{ $request->user->name }}</li>
    <li>Client Email: {{ $request->user->email }}</li>
    <li>File: {{ $request->file_path }}</li>
    <li>Created: {{ \Carbon\Carbon::parse($request->published_at)->format('d.M H:i') }}</li>
</ul>
</body>
</html>
