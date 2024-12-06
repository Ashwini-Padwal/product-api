<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM data WHERE 1=1";
    
    if (isset($_GET['end_year'])) {
        $query .= " AND end_year = :end_year";
    }
    if (isset($_GET['topic'])) {
        $query .= " AND topic = :topic";
    }
    if (isset($_GET['sector'])) {
        $query .= " AND sector = :sector";
    }
    if (isset($_GET['region'])) {
        $query .= " AND region = :region";
    }
    if (isset($_GET['pestle'])) {
        $query .= " AND pestle = :pestle";
    }
    if (isset($_GET['source'])) {
        $query .= " AND source = :source";
    }
    if (isset($_GET['swot'])) {
        $query .= " AND swot = :swot";
    }
    if (isset($_GET['country'])) {
        $query .= " AND country = :country";
    }
    if (isset($_GET['city'])) {
        $query .= " AND city = :city";
    }
    
    $stmt = $pdo->prepare($query);
    
    if (isset($_GET['end_year'])) {
        $stmt->bindParam(':end_year', $_GET['end_year'], PDO::PARAM_INT);
    }
    if (isset($_GET['topic'])) {
        $stmt->bindParam(':topic', $_GET['topic'], PDO::PARAM_STR);
    }
    if (isset($_GET['sector'])) {
        $stmt->bindParam(':sector', $_GET['sector'], PDO::PARAM_STR);
    }
    if (isset($_GET['region'])) {
        $stmt->bindParam(':region', $_GET['region'], PDO::PARAM_STR);
    }
    if (isset($_GET['pestle'])) {
        $stmt->bindParam(':pestle', $_GET['pestle'], PDO::PARAM_STR);
    }
    if (isset($_GET['source'])) {
        $stmt->bindParam(':source', $_GET['source'], PDO::PARAM_STR);
    }
    if (isset($_GET['swot'])) {
        $stmt->bindParam(':swot', $_GET['swot'], PDO::PARAM_STR);
    }
    if (isset($_GET['country'])) {
        $stmt->bindParam(':country', $_GET['country'], PDO::PARAM_STR);
    }
    if (isset($_GET['city'])) {
        $stmt->bindParam(':city', $_GET['city'], PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);
}
?>
