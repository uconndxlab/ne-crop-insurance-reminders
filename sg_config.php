<?php
// load .env file without a library
$path_to_env = __DIR__ . '/.env';
$env = file_get_contents($path_to_env);

// just get the var named SG_API_KEY

$env_vars = explode("\n", $env);
foreach ($env_vars as $env_var) {

    $env_var = explode('=', $env_var);
    $var_name = trim($env_var[0]);
    if ($var_name == 'SG_API_KEY') {
        echo "found sendgrid api key...\n";
        $sg_api_key = $env_var[1];
    }
}

if (empty($sg_api_key)) {
    echo "\n\n Dead: SG_API_KEY not found in .env file";
    exit;
}


