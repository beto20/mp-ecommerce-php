<?php

MercadoPago\SDK::setAccessToken("APP_USR-8208253118659647-112521-dd670f3fd6aa9147df51117701a2082e-677408439");

MercadoPago\SDK::setIntegratorId(getenv('dev_2e4ad5dd362f11eb809d0242ac130004'));

switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        break;
    case "plan":
        $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
        break;
}

?>