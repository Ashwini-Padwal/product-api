<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$host = 'localhost';
$dbname = 'task2';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$resource = array_shift($path);
$id = array_shift($path);

switch ($requestMethod) {
    case 'GET':
        if ($resource == 'products') {
            if ($id) {
                getProduct($id);
            } else {
                getProducts();
            }
        }
        break;
    case 'POST':
        if ($resource == 'products') {
            addProduct();
        }
        break;
    case 'PUT':
        if ($resource == 'products' && $id) {
            updateProduct($id);
        }
        break;
    case 'DELETE':
        if ($resource == 'products' && $id) {
            deleteProduct($id);
        }
        break;
    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}

$conn->close();

function getProducts() {
    global $conn;
    $sql = 'SELECT * FROM products';
    $result = $conn->query($sql);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

function getProduct($id) {
    global $conn;
    $sql = 'SELECT * FROM products WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    echo json_encode($product);
}

function addProduct() {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    
    $sql = 'INSERT INTO products (name, description, price) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssd', $name, $description, $price);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product added successfully']);
    } else {
        echo json_encode(['error' => 'Failed to add product']);
    }
}

function updateProduct($id) {
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    
    $sql = 'UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdi', $name, $description, $price, $id);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update product']);
    }
}

function deleteProduct($id) {
    global $conn;
    $sql = 'DELETE FROM products WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete product']);
    }
}
?>
