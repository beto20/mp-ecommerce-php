<?php
//PASO 1
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

//PASO 2
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-6213750683445204-121120-2e904ad2a41705a5a83e0f9e3985a34d-686355989');

//PASO 3
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Confirmacion.php" method = "POST">
    <script
        src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
        data-preference-id="<?php echo $preference->id; ?>">
    </script>
    </form>






</body>
</html>