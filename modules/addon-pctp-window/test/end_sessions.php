<?php

session_start();
session_destroy();
echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SESSIONS ENDED</title>
        </head>
        <body style="background-color: black; color: lightgreen;">SESSIONS ENDED</body>
        </html>
';