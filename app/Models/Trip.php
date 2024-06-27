
<?php
// app/Models/Trip.php

class Trip {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function startTrip($user_id) {
        $stmt = $this->pdo->prepare('INSERT INTO trips (user_id, start_time) VALUES (?, NOW())');
        $stmt->execute([$user_id]);
    }

    public function endTrip($user_id) {
        $stmt = $this->pdo->prepare('UPDATE trips SET end_time = NOW() WHERE user_id = ? AND end_time IS NULL');
        $stmt->execute([$user_id]);
    }
}
?>
