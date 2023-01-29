<?php
    $customerId = $_GET['id'];
    $bearerToken = "Bearer 81vhcdbbftogrypwbqtrjznhupnfidom";

    $apiUrl = "https://api.dev.ecommerce.ontdf.io/rest/V1/customers/$customerId";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: $bearerToken"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($status != 200) {
        echo "Error retrieving customer data: " . $response . "\n";
    } 
    
    curl_close($curl);
?>
