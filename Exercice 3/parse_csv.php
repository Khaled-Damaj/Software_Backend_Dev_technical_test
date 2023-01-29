<?php

    $file = fopen("customers.csv","r");
    $header = fgetcsv($file);

    $customers = [];
    while($row = fgetcsv($file) !== FALSE) {
        $customers[] = array_combine($header, $row);
    }
    fclose($file);

    $apiUrl = "https://api.dev.ecommerce.ontdf.io/rest/V1/customers";

    foreach ($customers as $customer) {
        $data = json_encode($customer);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 201) {
            echo "Error pushing customer data: ".$response."\n";
        } else {
            echo "Successfully pushed customer data for "."\n";
        }

        curl_close($curl);
    }

?>
