## About

Georgian SMS Providers (Magticom, Geocell, SMSOffice) for Laravel 5+

## Installation

```bash
composer require vati/geosms
```

## Configuration

```bash
php artisan vendor:publish
```
After command select sms tag in list.
config/sms.php configuration file

```bash
<?php
     return  [
        'default_provider' => 'smsoffice',
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
    ]
```

## License
[MIT](https://choosealicense.com/licenses/mit/)
