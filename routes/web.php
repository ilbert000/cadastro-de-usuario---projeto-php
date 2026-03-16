<?php

require_once __DIR__ . '/../controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $controller->edit($id);
        break;
    case 'update':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $controller->update($id);
        break;
    case 'delete':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}
