<?php

class RecaptchaService
{
    private string $secret;

    public function __construct()
    {
        $this->secret = Recaptcha::captchaSecret();
    }

    public function verify(string $token): bool
    {
        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'secret' => $this->secret,
                'response' => $token,
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        $data = json_decode($response, true);

        return is_array($data) && ($data['success'] ?? false) === true;
    }
}
