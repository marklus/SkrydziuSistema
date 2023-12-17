paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: phpValue
                        //value: paymentAmount.toString()
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log(details)

            window.location.replace("http://localhost:3000/paypal/success.php?phpValue1=" + encodeURIComponent(phpValue1));

        })

    },
    onCancel: function(data) {
        window.location.replace("http://localhost:3000/paypal/Oncancel.php?phpValue1=" + encodeURIComponent(phpValue1))
    }
}).render('#paypal-payment-button');

var phpValue = $('#phpValueContainer').data('php-value');
var phpValue1 = $('#phpValueContainer1').data('php-value1');