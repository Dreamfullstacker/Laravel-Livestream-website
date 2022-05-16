<?php
function emailTemp($html,$Settings = null) {

$emailTemp.= '<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
    body {
        background-color: #fff;
        margin: 0;
        padding: 0;
        line-height: 1.6;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

    }

    .content {
        margin: 0 auto;
        padding: 2em;
        background-color: #fff;

        font-size: 14px;
    }

    h1 {
        margin-bottom: 0;
    }

    a.btn {
        background-color: #126de5;
        color: #fff !important;
        font-weight: bold;
        padding: 14px 70px 16px;
        display: inline-block;
        margin: 10px 0;
        border-radius: 6px;
    }

    a {
        color: #000 !important;
        text-decoration: none !important;
    }

    a:link,
    a:visited {
        color: #38488f;
        text-decoration: none;
    }

    .footer {
        border-top: solid 1px #f6f6f6;
        padding-top: 10px;
        margin-top: 10px;
    }

    .footer a {
        font-size: 14px;
        color: #aaa !important;
        display: inline-block;
        margin-right: 10px;
    }

    @media (max-width: 700px) {
        div {
            margin: 0 auto;
            width: auto;
        }
    }
    </style>
</head>

<body>
    <div class="content">
        '.$html.'
        <div class="footer">';

        foreach (json_decode(get($Settings,'data','social'), true) as $key => $value) {
            if($value) { 
                $emailTemp.= '<a href="https://www.'.$key.'.com/'.$value.'">'.ucwords(strtolower($key)).'</a>';
            }
        }
        $emailTemp.= '</div>
    </div>
</body>

</html>
';

return $emailTemp;
}