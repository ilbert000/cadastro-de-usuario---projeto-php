<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function index() {
        $users = $this->model->getAllUsers();
        require __DIR__ . '/../views/users/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/users/create.php';
    }

    public function store() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Preencha todos os campos.';
            header('Location: ?action=create');
            exit;
        }

        $this->model->createUser(['name' => $name, 'email' => $email, 'password' => $password]);
        $_SESSION['success'] = 'Usuário criado com sucesso.';
        header('Location: ?action=index');
        exit;
    }

    public function edit($id) {
        $user = $this->model->getUserById($id);
        if (!$user) {
            $_SESSION['error'] = 'Usuário não encontrado.';
            header('Location: ?action=index');
            exit;
        }
        require __DIR__ . '/../views/users/edit.php';
    }

    public function update($id) {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($name) || empty($email)) {
            $_SESSION['error'] = 'Nome e e-mail são obrigatórios.';
            header('Location: ?action=edit&id=' . $id);
            exit;
        }

        $this->model->updateUser($id, ['name' => $name, 'email' => $email, 'password' => $password]);
        $_SESSION['success'] = 'Usuário atualizado com sucesso.';
        header('Location: ?action=index');
        exit;
    }

    public function delete($id) {
        $this->model->deleteUser($id);
        $_SESSION['success'] = 'Usuário excluído com sucesso.';
        header('Location: ?action=index');
        exit;
    }
}
