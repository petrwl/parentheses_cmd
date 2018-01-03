<?php

require 'vendor/autoload.php';

use Parentheses\Parentheses;
use Parentheses\InvalidArgumentException;

class ConsoleException extends \Exception
{

}

try {

    if (empty($argv[1])) {
        throw new ConsoleException('Please enter file path');
    }

    if (! file_exists($argv[1])) {
        throw new ConsoleException('File "' . $argv[1] . '" not exists');
    }

    if (! is_file($argv[1])) {
        throw new ConsoleException($argv[1] . ' is not a file');
    }

    if (! is_readable($argv[1])) {
        throw new ConsoleException($argv[1] . ' file is not readable');
    }

    $string = file_get_contents($argv[1]);
    $Parentheses = new Parentheses($string);

    if ($Parentheses->isBalanced()) {
        print 'File string have balanced parentheses' . PHP_EOL;
    } else {
        print 'File string have not balances parentheses' . PHP_EOL;
    }

} catch (ConsoleException $e) {
    print 'File error: ' . $e->getMessage() . PHP_EOL;
} catch (\Parentheses\Exception\InvalidArgumentException $e) {
    print 'File string error: ' . $e->getMessage() . PHP_EOL;
}