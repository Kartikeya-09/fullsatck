<?php
session_start();
$order = $order ?? null;
$listing = $listing ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <div class="container mt-5">
        <?php if ($order && $listing): ?>
            <h1 class="text-center">Checkout</h1>
            <div class="card mt-4">
                <img src="<?= htmlspecialchars($listing->image) ?>" class="card-img-top" alt="<?= htmlspecialchars($listing->title) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($listing->title) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($listing->description) ?></p>
                    <p class="card-text"><strong>Price:</strong> ₹<?= htmlspecialchars($listing->price) ?></p>
                </div>
            </div>
            <button id="rzp-button1" class="btn btn-success mt-3">Pay Now</button>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                Order not found.
            </div>
        <?php endif; ?>
    </div>

    <script>
        const options = {
            "key": "<?= htmlspecialchars($order->key_id) ?>", // Enter the Key ID generated from the Dashboard
            "amount": "<?= htmlspecialchars($order->amount) ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 means 50000 paise or ₹500.
            "currency": "INR",
            "name": "<?= htmlspecialchars($listing->title) ?>",
            "description": "<?= htmlspecialchars($listing->description) ?>",
            "image": "<?= htmlspecialchars($listing->image) ?>",
            "order_id": "<?= htmlspecialchars($order->id) ?>", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response){
                alert(response.razorpay_payment_id);
                alert(response.razorpay_order_id);
                alert(response.razorpay_signature);
            },
            "prefill": {
                "name": "<?= htmlspecialchars($_SESSION['username'] ?? '') ?>",
                "email": "<?= htmlspecialchars($_SESSION['email'] ?? '') ?>",
                "contact": "<?= htmlspecialchars($_SESSION['contact'] ?? '') ?>"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        const rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
