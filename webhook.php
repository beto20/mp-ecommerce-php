<?php
    class webhook{
        public function webhook(){
            MercadoPago\SDK::setAccessToken('APP_USR-8208253118659647-112521-dd670f3fd6aa9147df51117701a2082e-677408439');
            MercadoPago\SDK::setIntegratorId(getenv('dev_2e4ad5dd362f11eb809d0242ac130004'));
            $info = json_decode($this->input->raw_input_stream);

            if (isset($info->type)) {
                switch ($info->type) {
                    case 'mp-connect':
                        // Desvinculo de mi sistema cuando el usuario desautoriza la app desde su cuenta de Mercadopago.
                        if ($info->action == 'application.deauthorized') {

                            $data_update = array(
                                'mp_access_token' => NULL,
                                'mp_public_key' => NULL,
                                'mp_refresh_token' => NULL,
                                'mp_user_id' => NULL,
                                'mp_expires_in' => NULL,
                                'mp_status' => 0
                            );

                            $this->producers->update_mp_connect($data_update, $info->user_id);
                            $this->output->set_status_header(200);
                            return;
                        }

                        // Pueden tomar otra acción si el $info->action = 'application.authrized'
                    break;

                    case 'payment':
                        // Actualizo la información de pago recibida.
                        $or_collection_id = $info->data->id;
                        $info = MercadoPago\Payment::find_by_id($or_collection_id);
                        $or_number = $info->external_reference;

                        $data_update = array(

                            'or_collection_status' => $info->status,
                            'or_collection_status_detail' => $info->status_detail,
                            'or_payment_type' => $info->payment_type_id,
                            'or_payment_method' => $info->payment_method_id,
                            'or_status' => gcfg($info->status,'or_status_collection_status')
                        );

                        $this->cart->update_ipn_order($data_update,$or_number);

                    break;

                    default:
                        $this->output->set_status_header(200);
                        return;
                    break;
                }
            }
            $this->output->set_status_header(200);
            return;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h2>PRUEBA DE WEBHOOK</h2>

    <?php  
    
        print_r(json_encode($data_update));
    ?>

</head>
<body>
    
</body>
</html>
