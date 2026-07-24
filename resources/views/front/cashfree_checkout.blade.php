<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment...</title>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
</head>
<body>
    <p>Redirecting to secure payment page, please wait...</p>

    <script>
        const cashfree = Cashfree({
            mode: "{{ config('cashfree.mode') === 'production' ? 'production' : 'sandbox' }}"
        });

        cashfree.checkout({
            paymentSessionId: "{{ $paymentSessionId }}",
            redirectTarget: "_self"
        });
    </script>
</body>
</html>