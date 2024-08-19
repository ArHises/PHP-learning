<?php

// function compareByName($a, $b) {
//     return strcmp($a[0], $b[0]);
// }

function sortByName(array $config) {
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        $allUsers = [];
        while (($row = fgetcsv($file, 100, ",")) !== FALSE) {
            $allUsers[] = $row;
        }
        fclose($file);

        $compareByName = function($a, $b) {
            return strcmp($a[0], $b[0]); // compare only names of the users
        };
        usort($allUsers, $compareByName);

        $file = fopen($address, "wb");
        foreach ($allUsers as $row) {
            fwrite($file, implode(",", $row) . "\n");
        }
        fclose($file);

        return "\nСписок отсортирован по имени\n";
    } else {
        return "Файл не существует или не доступен для чтения.";
    }
}



function deleteFunction(array $config) { 
    $address = $config['storage']['address'];
    $name = readline("Введите имя: ");

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        $allUsers = [];

        while (($row = fgetcsv($file, 100, ",")) !== FALSE) {
            $allUsers[] = $row;
        }
        fclose($file);

        $newList = [];

        foreach ($allUsers as $user) {

            if ($user[0] !== $name) {
                $newList[] = implode(",", $user);
            }
        }
        if (count($newList) === count($allUsers)) {
            return handleError("There is no such user \n");
        }

        $file = fopen($address, "wb");
        foreach ($newList as $row) {
            fwrite($file, $row. "\n");
        }

        return implode("\n", $newList) . "\n user: $name has been deleted! \n";
    } else {
        return handleError("Файл не существует");
    }
}


function todayBDFunction(array $config) { 
    $address = $config['storage']['address'];
    $currentDate = date("d-m-Y");

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        $allUsers = [];

        while (($row = fgetcsv($file, 100, ",")) !== FALSE) {
            $allUsers[] = $row;
        }

        fclose($file);

        $bdUsers = [];

        foreach ($allUsers as $user) {
            $userbd = explode("-", $user[1]);
            $currentDM = explode("-", $currentDate);

            if ($userbd[0] == $currentDM[0] && $userbd[1] == $currentDM[1]) {
                $bdUsers[] = implode(", ", $user);
            }
        }

        return implode("\n", $bdUsers);
    } else {
        return handleError("Файл не существует");
    }
}


// function readAllFunction(string $address) : string {
function readAllFunction(array $config) : string {
    $address = $config['storage']['address'];
    
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        
        $contents = ''; 
    
        while (!feof($file)) {
            $contents .= fread($file, 100);
        }
        
        fclose($file);
        return $contents;
    }
    else {
        return handleError("Файл не существует");
    }
}

// function addFunction(string $address) : string {
function addFunction(array $config) : string {
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");

    if(!validateDate($date)) {
        return handleError("Неверный формат даты. Дата должна быть в формате ДД-ММ-ГГГГ");
    }

    $data = "$name,  $date\r\n";

    $fileHandler = fopen($address, 'a');

    if(fwrite($fileHandler, $data)){
        return "Запись $data добавлена в файл $address"; 
    }
    else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// function clearFunction(string $address) : string {
function clearFunction(array $config) : string {
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");
        
        fwrite($file, '');
        
        fclose($file);
        return "Файл очищен";
    }
    else {
        return handleError("Файл не существует");
    }
}

function helpFunction() {
    return handleHelp();
}

function readConfig(string $configAddress): array|false{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string {
    $profilesDirectoryAddress = $config['profiles']['address'];

    if(!is_dir($profilesDirectoryAddress)){
        mkdir($profilesDirectoryAddress);
    }

    $files = scandir($profilesDirectoryAddress);

    $result = "";

    if(count($files) > 2){
        foreach($files as $file){
            if(in_array($file, ['.', '..']))
                continue;
            
            $result .= $file . "\r\n";
        }
    }
    else {
        $result .= "Директория пуста \r\n";
    }

    return $result;
}

function readProfile(array $config): string {
    $profilesDirectoryAddress = $config['profiles']['address'];

    if(!isset($_SERVER['argv'][2])){
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

    if(!file_exists($profileFileName)){
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

    return $info;
}