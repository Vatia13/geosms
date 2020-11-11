<?php
return  [
    'enabled' => false,
    'default_provider' => 'smsoffice',
    'magticom' => [
        'send_url' => 'http://81.95.160.47/mt/oneway',
        'check_url' => 'http://81.95.160.47/bi/track',
        'params' => [
            'username' => 'name',
            'password' => 'pass',
            'client_id' => 123,
            'service_id' => '1',
            'coding' => 2,
        ],
        'rewrite' => [
            'number' => 'to',
            'text' => 'text'
        ],
        'responses' => [
            '0000' => ['message' => 'sms.success', 'type' => 'success'],
            '0001' => ['message' => 'sms.internal_error', 'type' => 'error'],
            '0003' => ['message' => 'sms.invalid_request', 'type' => 'error'],
            '0004' => ['message' => 'sms.invalid_query', 'type' => 'error'],
            '0005' => ['message' => 'sms.empty_message', 'type' => 'error'],
            '0006' => ['message' => 'sms.prefix_error', 'type' => 'error'],
            '0007' => ['message' => 'sms.msisdn_error', 'type' => 'error'],
        ]
    ],
    'geocell' => [
        'send_url' => 'http://msg.ge/bi/sendsms.php',
        'check_url' => 'http://msg.ge/bi/track.php',
        'params' => [
            'username' => 'username',
            'password' => 'password',
            'client_id' => 0,
            'service_id' => '0',
            'utf' => 1,
        ],
        'rewrite' => [
            'number' => 'to',
            'text' => 'text'
        ],
        'responses' => [
            '0000' => ['message' => 'sms.success', 'type' => 'success']
        ]
    ],
    'smsoffice' => [
        'send_url' => 'http://smsoffice.ge/api/v2/send/',
        'api_url' => 'http://smsoffice.ge/api/',
        'params' => [
            'key' => '01234567890123456789012345678901',
            'sender' => 'GLC',
        ],
        'rewrite' => [
            'number' => 'destination',
            'text' => 'content'
        ],
        'responses' => [
            '0' => 'მესიჯი მიღებულია. ეს ჯერ არ ნიშნავს, რომ მესიჯი მივიდა მობილურ ტელეფონში. მესიჯის მისვლას შეიტყობთ მიღების უწყისში',
            '10' => 'destination შეიცავს არაქართულ ნომრებს',
            '20' => 'ბალანსი არასაკმარისია',
            '40' => 'გასაგზავნი ტექსტი 160 სიმბოლოზე მეტია',
            '60' => 'ბრძანებას აკლია content პარამეტრის მნიშვნელობა, გასაგზავნი ტექსტი',
            '70' => 'ბრძანებას აკლია ნომრები',
            '80' => 'key -ს შესაბამისი მომხმარებელი ვერ მოიძებნა',
            '110' => 'sender პარამეტრის მნიშვნელობა გაუგებარია',
            '120' => 'გააქტიურეთ api -ის გამოყენების უფლება პროფილის გვერდზე',
            '500' => 'ბრძანებას აკლია key პარამეტრი',
            '600' => 'ბრძანებას აკლია destination პარამეტრი',
            '700' => 'ბრძანებას აკლია sender პარამეტრი',
            '800' => 'ბრძანებას აკლია content პარამეტრი',
            '-100' => 'დროებითი შეფერხება'
        ]
    ]
];
