<?php
declare(strict_types=1);

require_once __DIR__ . '/src/FormValidator.php';
require_once __DIR__ . '/src/FactRepository.php';
require_once __DIR__ . '/src/FactManager.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$validator = new FormValidator();
$repository = new FactRepository(__DIR__ . '/data/facts.json');
$manager = new FactManager($validator, $repository);

$result = $manager->save($_POST);

$_SESSION['old'] = $_POST;

if (!$result['success']) 
{
    $_SESSION['errors'] = $result['errors']; 
    header('Location: index.php');
    exit;
}

unset($_SESSION['old'], $_SESSION['errors']);
$_SESSION['success'] = 'Факт был успешно сохранён.';

header('Location: index.php');
exit;
