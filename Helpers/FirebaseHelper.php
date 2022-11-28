<?php

namespace App\Helpers;

class FirebaseHelper
{
    /**
     * Send notification to the $user using Firebase http legacy:
     *
     * @param string $serverKey
     * @param array $userFcmTokens
     * @param array|null $notification
     * @param array|null $data
     * @param array|null $params
     * @return array
     */
    public static function sendMessageLegacy(
        $serverKey,
        $userFcmTokens,
        $notification = null,
        $data = null,
        $params = null
    ): mixed {

        if (is_null($notification) && is_null($data)) {
            return [
                'code' => 500,
                'data' => [
                    'message' => 'you have to provide either notification or data',
                ],
            ];
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $requestData = ["registration_ids" => $userFcmTokens];

        if (!empty($notification)) {
            $requestData['notification'] = $notification;
        }

        if (!empty($data)) {
            $requestData['data'] = $data;
        }

        if (!empty($params)) {
            array_push($requestData, $params);
        }

        $encodedData = json_encode($requestData);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        $result = curl_exec($ch);

        curl_close($ch);

        $res = [
            'code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
        ];

        if ($result === false) {
            $res['data']['error'] = curl_error($ch);
            return $res;
        } else {
            $res['data'] = $result;
            return $res;
        }

    }
}
