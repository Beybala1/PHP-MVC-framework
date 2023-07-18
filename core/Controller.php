<?php
require_once __DIR__ . '/../core/Model.php';
    
class Controller extends Model
{
    public function get(): bool|array
    {
        $stmt = $this->connection->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the error, print or log the error message.
            echo "Error: " . $e->getMessage();
            return null; // Return null to indicate failure.
        }
    }

    protected function create($table, $data): bool {
        // Build the query dynamically based on the table and data
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        // Prepare and execute the query
        $stmt = $this->connection->prepare($query);
        return $stmt->execute(array_values($data));
    }

    protected function update($table, $data, $id): bool {
        // Build the SET clause for the UPDATE query dynamically based on the data
        $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';

        // Prepare and execute the UPDATE query
        $query = "UPDATE {$table} SET {$setClause} WHERE id = ?";
        $data['id'] = $id; // Add the ID to the $data array
        $stmt = $this->connection->prepare($query);
        // Return true if the UPDATE operation was successful, false otherwise
        return $stmt->execute(array_values($data));
    }

    protected function delete($id): bool|PDOStatement
    {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt;

    }
    protected function view($view, $data = []): void {
        extract($data);
        require __DIR__ . '/../app/views/' . $view . '.php';
    }
}