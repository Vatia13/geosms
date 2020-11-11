<?php

/**
 * Created by Vati Child.
 * E-mail: vatia0@gmail.com
 * Date: 4/4/18
 * Time: 12:53 AM
 */

namespace Vati\SMS;

use Illuminate\Support\Arr;



class SMS
{
    /**
     * @var
     */
    protected $config;

    /**
     * Illuminate request class.
     *
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    /**
     * @var string
     */
    private $prefix = '995';

    /**
     * Sms constructor.
     * @param $provider
     */
    public function __construct()
    {
        $this->app = app();
        $this->config = $this->app['config']['sms'];
        $this->config = $this->config[$this->config['default_provider']];
    }

    /**
     * @param $text
     * @param array $templateVariables
     * @param array $params
     */
    public function text($text,$templateVariables = [], $params = []) {
        $text = (count($templateVariables)) ? $this->generateTemplate($text, $templateVariables) : $text;
        $this->config['params'][$this->config['rewrite']['text']] = $text;
        return $this;
    }

    /**
     * @param $number
     */
    public function to($number){
        $this->config['params'][$this->config['rewrite']['number']] = $this->generateNumber($number);
        return $this;
    }

    /**
     * @param $number
     * @param $text
     * @return array
     */
    public function send()
    {
        $return = $this->generateCurl($this->config['send_url'], $this->config['params']);
        return $this->generateResponse($return);
    }


    /**
     * @param int $sms_id
     * @return mixed
     */
    public function checkStatus($sms_id = 0)
    {
        $this->config['params']['message_id'] = $sms_id;
        $params = Arr::except($this->config['params'], 'coding');
        $return = $this->generateCurl($this->config['check_url'], $params);
        return $return;
    }


    /**
     * @param $url
     * @param $query
     * @return mixed
     */
    private function generateCurl($url, $query)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($query));
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    /**
     * @param $value
     * @return bool|mixed|string
     */
    private function generateNumber($value)
    {
        $value = str_replace(' ', '', $value);
        $value = str_replace('-', '', $value);
        $value = str_replace('_', '', $value);
        preg_match('/([0-9]+)$/', $value, $matches);
        if (count($matches) && !empty($matches[0])) {
            $result = preg_replace('/^\+?' . $this->prefix . '/', '', $matches[0]);
            if (strlen($result) == 9) {
                return $result;
            }
        }
        return null;
    }

    /**
     * @param $response
     * @return array
     */
    private function generateResponse($response)
    {
        if ($this->isJson($response)) {
            $response = json_decode($response, true);
            if (in_array($response['ErrorCode'], array_keys($this->config['responses']))) {
                $result = [
                    'message' => $this->config['responses'][$response['ErrorCode']]
                ];
            } else {
                $result = [
                    'message' => 'unknown error'
                ];
            }
        } else {
            $response = explode('-', $response);
            if (isset($response) && is_array($response)) {
                if ($response[0] == 0000) {
                    $result = [
                        'message' => 'sms.success', 
                        'type' => 'success', 
                        'sms_id' => trim($response[1])
                    ];
                } elseif ($response[0] == '0008') {
                    $result = [
                        'message' => 'sms.no_balance', 
                        'type' => 'error', 
                        'sms_id' => trim($response[1])
                    ];
                } else {
                    if (isset($response[1])) {
                        $result = [
                            'message' => 'sms.something_went_wrong', 
                            'type' => 'error', 
                            'sms_id' => trim($response[1])
                        ];
                    } else {
                        $result = [
                            'message' => 
                            'sms.unknown_error', 
                            'type' => 'error', 
                            'sms_id' => 
                            'unknown'
                        ];
                    }
                }
            }
        }
        return $result;
    }


    /**
     * @param $text
     * @param array $variables
     * @return mixed
     */
    public function generateTemplate($text, $variables = [])
    {
        if (count($variables)) {
            foreach ($variables as $key => $value) {
                $text = str_replace($key, $value, $text);
            }
        }
        return $text;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


    /**
     * @param $params
     */
    public function setParam($params)
    {
        if (count($params)) {
            foreach ($params as $key => $param) {
                $this->config['params'][$key] = $param;
            }
        }
    }
}
