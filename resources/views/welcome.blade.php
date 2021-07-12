<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AW2lQ7-8BRZ5J0e7y7zlYwGAdpELDYcKi1z3_JjFPRFqGwWQANuZ0_N0p9WONsK0uOH3scmSquP70-b2&intent=authorize">
    </script>
</head>
<style>
    .container {
         width: 200px; 
    }
</style>

<body>

    <div class="container">
        <div id="paypal-button"></div>
    </div>


    <script>
        paypal.Buttons({
          style: {
            layout: 'horizontal',
            size: 'small',
            color:  'blue',
            shape:  'pill',
            label:  'pay',
            height: 40,
            tagline: 'false'
          },
        createOrder: function(data, actions) {
          // This function sets up the details of the transaction, including the amount and line item details.
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '20',
                currency: 'USD'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          console.log(data);
          console.log(actions);

          // Authorize the transaction
          actions.order.authorize().then(function(authorization) {
            alert('Transaction completed by ' + authorization.payer.name.given_name);
            console.log(authorization);
            
            // Get the authorization id
            // var authorizationID = authorization.purchase_units[0]
            //   .payments.authorizations[0].id

            // // Call your server to validate and capture the transaction
            // return fetch('/paypal-transaction-complete', {
            //   method: 'post',
            //   headers: {
            //     'content-type': 'application/json'
            //   },
            //   body: JSON.stringify({
            //     orderID: data.orderID,
            //     authorizationID: authorizationID
            //   })
            // });
          });
          }
        }).render('#paypal-button');
    </script>
</body>

</html>
