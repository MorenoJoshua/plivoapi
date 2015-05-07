<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .true {
            background: #008855;
        }

        .false {
            background: #8b0000;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="table table-condensed">
        <tr>
            <td>Name</td>
            <td>Logged In</td>
            <td>Username</td>
            <td>Session Expires</td>
            <td>Enpoint ID</td>
        </tr>
        <?php
        if (isset($_GET)) {

            $url = 'https://MAZJC2OTBKMTHIMZI1NT:Mjk2OWIyYzJkYWNkODVhYWNlMDE5YTM1NjQyMDRj@api.plivo.com/v1/Account/MAZJC2OTBKMTHIMZI1NT/Endpoint/' . $_GET['e'];
            $data = array('status' => 'live');

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => "GET",
//            'content' => http_build_query($data),
                ),
            );

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
        }

        if (isset($result)) {
            if (!empty($endpoints)) {
                if (!empty($endpoints)) {
                    $endpoints = json_decode($result, true);
                }
            }
        }
        if (!empty($endpoints)) {
            foreach ($endpoints['objects'] as $key) {
                echo <<<HTML
        <tr>
            <td>{$key['alias']}</td>
            <td class="{$key['sip_registered']}">&nbsp;</td>
            <td>{$key['username']}</td>
            <td>{$key['sip_expires']}</td>
            <td>{$key['endpoint_id']}</td>
        </tr>
HTML;
            }
        }
        ?>
    </table>
<pre><?php if (!empty($endpoints)) {
        print_r($endpoints);
    }?></pre>

</div>
</body>
</html>