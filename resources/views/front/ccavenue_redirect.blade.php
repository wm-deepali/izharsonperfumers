<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
</head>
<body>

<p>Redirecting to secure payment...</p>

<form method="post"
      name="redirect"
      action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">

    <input type="hidden" name="encRequest" value="{{ $encrypted }}">
    <input type="hidden" name="access_code" value="{{ config('ccavenue.access_code') }}">

</form>

<script>
document.redirect.submit();
</script>

</body>
</html>