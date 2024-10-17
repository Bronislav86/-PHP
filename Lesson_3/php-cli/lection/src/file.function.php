<?php

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
    if (!validateName($name)) {
        return handleError("Введите Имя и Фамилию");
    }
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    if (validateDate($date)) {
        $data = $name . ", " . $date . PHP_EOL;
    } else {
        return handleError("Дата введена некорректно. Проверьте формат.");
    }
    

    $fileHandler = fopen($address, 'a');

    if(fwrite($fileHandler, $data)){
        return "Запись $data добавлена в файл $address"; 
    }
    else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    //fclose($fileHandler);
}

function searchDate(array $config) : string {
    $file = readAllFunction($config);

    $content = str_replace("\r\n", ",", $file);
    $contentArr = explode(",", $content);

    $birthdayBoy = "";
    $curDay = date('d');
    $curMonth = date('m');

    for ($i=0; $i < count($contentArr); $i++) {
        if ($i % 2 != 0) {
            $day = (explode('-', $contentArr[$i]))[0];
            $month = (explode('-', $contentArr[$i]))[1];

            if ($day == $curDay && $month == $curMonth) {
                $birthdayBoy .= $contentArr[$i - 1] . ", ";
            }
        }
    }
    if (strlen($birthdayBoy) > 0) {
        $result = rtrim($birthdayBoy, " ,");
        return "Именинники сегодня: " . $result;
    }
    return "Сегодня именинников нет.";
}

function deleteFunction(array $config): string {
    echo "Внимание! Если вы введете Имя Фамилию из списка или дату рождения - все записи с этими значениями будут удалены.";
    $request = readline("Введите знаячения Имя Фамилия или дату в формате ДД-ММ-ГГГГ для удаления записи: ");
    
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        
        $contents = ''; 
    
        while (!feof($file)) {
            $contents .= fread($file, 100);
        }
        fclose($file);
        
        if (strlen($contents) == 0) {
            return "Невозможно выполнить команду Удаления, т.к. файл пуст";
        }

        $content = str_replace("\r\n", ",", $contents);
        $contentArr = explode(",", $content);
        $resString = "";
        if (!in_array($request, $contentArr, false)) {
            return "Записи с такими данными не найдены";
        }
        if (validateDate($request)) {

            for ($i= 1; $i < count($contentArr); $i += 2) {
                if (strnatcmp($contentArr[$i], $request) == 0) {
                    continue;
                }
                $resString .= $contentArr[$i - 1] . ", " . $contentArr[$i] . "\r\n";
            }
        } elseif (validateName($request)) {
            $content = str_replace("\r\n", ",", $contents);
            $contentArr = explode(",", $content);

            for ($i= 0; $i < count($contentArr); $i += 2) {
                if (strnatcmp($contentArr[$i], $request) == 0) {
                    continue;
                }
                $resString .= $contentArr[$i] . ", " . $contentArr[$i + 1] . "\r\n";
            }
        }
    $resString = rtrim($resString, ", ");
    }
    else {
        return handleError("Файл не существует");
    }
    if(is_writable($address)){
        $fileHandler = fopen($address, 'w');
        if (fwrite($fileHandler, $resString)) {
            return "Записи со значением " . $request .  " удалены из файла " . $address;
        } else {
            return handleError("Произошла ошибка записи. Данные не сохранены");
        }
    } else {
        return handleError("Файл не готов к записи");
    }
    
    
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
            
            $result .= $file . PHP_EOL;
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

    $info = "Имя: " . $contentArray['name'] . PHP_EOL;
    $info .= "Фамилия: " . $contentArray['lastname'] . PHP_EOL;

    return $info;
}