<!DOCTYPE html>
<html lang="en">

<body>
	
<p>Dear {{ $user->name }}</p>
<p>Your account has been created, please verify your account by clicking this link</p>
<p><a href="{{ route('verification.verify',$user->token) }}">
	{{ route('verification.verify',$user->token) }}
</a></p>

<p>Thanks</p>

</body>

</html> 