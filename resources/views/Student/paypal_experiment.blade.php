<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal JS SDK Standard Integration</title>
  </head>
  <body>
    <div id="paypal-button-container"></div>
    <p id="result-message"></p>
    <!-- Replace the "test" client-id value with your client-id -->
    <!--<script src="https://www.paypal.com/sdk/js?client-id=AcO9VsiEYgUDV8XFpA1q8V8L2Og9KabqfHaw8TAw5mqrHTFFW-OCfZdkt29U4GWQ3nTjEkTyeCFXe7po&components=buttons&enable-funding=paylater&disable-funding=venmo,card" data-sdk-integration-source="integrationbuilder_sc"></script>
    <script src="app.js"></script>-->

    <form action="{{route('payment')}}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="100">
        <button type="submit"></button>
    </form>
    <script>
        paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '10.00' // Set the amount for the transaction
                }
              }]
            });
          },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              // Call your backend to save the transaction details
              console.log(details);
            });
          }
        }).render('#paypal-button-container');
      </script>
      
  </body>
</html>
