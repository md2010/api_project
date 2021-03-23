<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
</head>
<body>

    <form method="post" action="{{ route('email_verified', $user->id) }}">
        @csrf 
        <label> Click on link to verify </label> <br><br>
        <a href="{{ URL::route('email_verified', $user->id) }}"> Verify </a>        
    </form>

</body>
</html>
