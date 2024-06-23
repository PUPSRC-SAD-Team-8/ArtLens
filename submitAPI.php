<?php
    $prompt = $_POST['prompt'];
function makePrediction($replicateApiToken, $jsonData) {
    // Initialize cURL session
    $chs1 = curl_init();
    curl_setopt($chs1, CURLOPT_URL, 'https://api.replicate.com/v1/predictions');
    curl_setopt($chs1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chs1, CURLOPT_POST, true);
    curl_setopt($chs1, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $replicateApiToken,
        'Content-Type: application/json'
    ));
    curl_setopt($chs1, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($chs1, CURLOPT_FAILONERROR, true);

    // Execute cURL request
    $response = curl_exec($chs1);
    $statusdata = curl_getinfo($chs1, CURLINFO_HTTP_CODE);
    curl_close($chs1);

    // Decode response
    $resultResponse = json_decode($response, true);

    // if ($statusdata >= 200 && $statusdata < 300) {
        if (isset($resultResponse['urls']['get'])) {
            $getUrl = $resultResponse['urls']['get'];
        } else {
            return ['status' => 'failed', 'msg' => 'Failed: "get" URL not found in the response.'];
        }
    // } else {
    //     return ['status' => 'failed', 'msg' => "Failed: HTTP status code $statusdata\n"];
    // }

    // Loop to check status
    while (true) {
        // Initialize cURL session to check status
        $chs2 = curl_init();
        curl_setopt($chs2, CURLOPT_URL, $getUrl);
        curl_setopt($chs2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chs2, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $replicateApiToken
        ));

        // Execute cURL request to get status
        $statusResponse = curl_exec($chs2);
        $statusData = curl_getinfo($chs2, CURLINFO_HTTP_CODE);
        curl_close($chs2);

        // Decode status response
        $statusResult = json_decode($statusResponse, true);

        // if ($statusData >= 200 && $statusData < 300) {
            if (isset($statusResult['status'])) {
                $status = $statusResult['status'];

                if ($status === 'succeeded') {
                    return ['status' => 'succeeded', 'result' => $statusResult['output']];
                } elseif ($status === 'failed') {
                    return ['status' => 'failed', 'msg' => 'Prediction failed.'];
                } elseif ($status === 'starting' || $status === 'processing') {
                    // Wait for 20 seconds and check again
                    sleep(20);
                } else {
                    return ['status' => 'failed', 'msg' => 'Unknown status received.'];
                }
            } else {
                return ['status' => 'failed', 'msg' => 'Failed: Status not found in the response.'];
            }
        // } else {
        //     return ['status' => 'failed', 'msg' => "Failed: HTTP status code $statusData\n"];
        // }
    }
}

// 



//////CHANGE MEEEEE THIS IS THE API TOKEN 
$replicateApiToken = 'r8_FLnM28vBqdczVyWYCcq73EKcw6z8xUA1szDUu';









$data = array(
    "version" => "50adaf2d3ad20a6f911a8a9e3ccf777b263b8596fbd2c8fc26e8888f8a0edbb5",
    "input" => array(
        "image" =>  $prompt
    )
);
$jsonData = json_encode($data);
$result = makePrediction($replicateApiToken, $jsonData);
header('Content-Type: application/json');

echo json_encode($result);

exit();


?>