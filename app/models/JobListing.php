<?php

class JobListing {
    private array $data;

    private static array $fields = [
        'user_id', 'title', 'description', 'salary', 'tags',
        'company', 'address', 'city', 'state', 'phone',
        'email', 'requirements', 'benefits'
    ];

    public function __construct(array $data) {
        // Only keep recognized fields to prevent mass assignment vulnerabilities
        $this->data = array_intersect_key($data, array_flip(self::$fields));
    }

    public function save(): bool {
        $config = require basePath('config/db.php');
        $db = new Database($config);

        // Only insert the fields that are present in the provided data
        $fields = array_values(array_intersect(self::$fields, array_keys($this->data)));

        if (count($fields) === 0) {
            throw new Exception('No valid fields provided to save listing.');
        }

        $columns = implode(', ', $fields);
        $placeholders = implode(', ', array_map(fn($f) => ":$f", $fields));

        $query = "INSERT INTO listings ($columns) VALUES ($placeholders)";
        $stmt = $db->conn->prepare($query);

        foreach ($fields as $field) {
            $value = $this->data[$field] ?? null;
            $stmt->bindValue(":$field", $value);
        }

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Failed to save job listing: " . $e->getMessage());
        }
    }
}