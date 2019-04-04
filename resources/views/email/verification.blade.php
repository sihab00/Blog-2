<!DOCTYPE html>
<html>
<body>
	<div>
		<p>Dear {{ $user->username}}</p>
		<p>Your accounts has been created please click the following the link</p>
		<a href="{{ route('verify',$user->email_verification_token) }}">{{ route('verify',$user->email_verification_token) }}
		</a>

		<p>Thanks</p>
	</div>
</body>
</html>