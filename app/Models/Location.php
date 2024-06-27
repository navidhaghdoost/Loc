
<?php
// app/Models/Location.php

class Location {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function saveLocation($user_id, $lat, $lng) {
        $stmt = $this->pdo->prepare('INSERT INTO locations (user_id, latitude, longitude, timestamp) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$user_id, $lat, $lng]);
    }
}
?>
