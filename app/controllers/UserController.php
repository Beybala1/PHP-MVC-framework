<?php

require_once __DIR__ . '/../../core/Controller.php';
class UserController extends Controller
{
    protected string $table = 'users';
    public function index(): void
    {
        $users = $this->get();
        $this->view('users/index', [
            'users' => $users
        ]);
    }

    public function create_redirect(): void
    {
        $this->view('users/create');
    }
    public function show($id): void
    {
        $id = is_array($id) ? $id['id'] : $id;
        $user = $this->find($id);
        if ($user) {
            $this->view('users/show', ['user' => $user]);
        } else {
            echo "User not found!";
        }
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming you have a form with 'name' and 'email' fields
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];

            if ($this->create('users', $data)) {
                header('Location: /user');
            } else {
                echo "Error inserting data.";
            }
        }
    }

    public function edit($id): void
    {
        $id = is_array($id) ? $id['id'] : $id;
        $user = $this->find($id);
        if ($user) {
            $this->view('users/edit', ['user' => $user]);
        } else {
            echo "User not found!";
        }
    }
    public function updateData($id): void {
        // Normalize the ID if needed
        $id = is_array($id) ? $id['id'] : $id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming you have a form with 'name', 'email', and 'password' fields
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];

            if ($this->update('users', $data, $id)) {
                header('Location: /user'); // Redirect to the desired page after successful update
            } else {
                echo "Error updating data.";
            }
        } else {
            // Retrieve the user data based on the ID and display the update form
            $user = $this->find($id);

            if ($user) {
                $this->view('user/edit', ['user' => $user]);
            } else {
                echo "User not found.";
            }
        }
    }

    public function destroy($id): void
    {
        $id = is_array($id) ? $id['id'] : $id;
        $user = $this->delete($id);
        header('Location: /user');
    }
}
