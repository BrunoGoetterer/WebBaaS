<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Einbinden der erforderlichen Service-Klassen
include_once "./service/userservice.php";
include_once "./service/bookingservice.php";
include_once "./service/productsservice.php";
include_once "./service/vouchersservice.php";

// Instanziieren der API-Klasse und Verarbeitung der Anfrage
$api = new Api();
$api->processRequest();

class Api
{
    private $userService;
    private $bookingService;
    private $productService;
    private $voucherService;

    // Konstruktor zur Initialisierung der Service-Klassen
    public function __construct()
    {
        $this->userService = new UserService();
        $this->bookingService = new BookingService();
        $this->productService = new ProductService();
        $this->voucherService = new VoucherService();
    }

    // Verarbeitet die eingehende Anfrage basierend auf der HTTP-Methode
    public function processRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $resource = isset($_GET['resource']) ? $_GET['resource'] : null;

        switch ($method) {
            case "GET":
                $this->processGet($resource);
                break;
            case "POST":
                $this->processPost($resource);
                break;
            case "DELETE":
                $this->processDelete($resource);
                break;
            default:
                $this->error(405, ["Allow: GET, POST, DELETE"], "Method not allowed");
        }
    }

    // Verarbeitet GET-Anfragen
    private function processGet($resource)
    {
        if (empty($resource)) {
            $this->error(400, [], "Bad Request - resource parameter missing");
            return;
        }

        switch ($resource) {
            case "users":
                $users = $this->userService->findAll();
                $this->success(200, $users);
                break;
            case "user":
                if (!isset($_GET["id"])) {
                    $this->error(400, [], "Bad Request - user ID required");
                }
                $id = intval($_GET["id"]);
                $user = $this->userService->findByID($id);
                if ($user === null) {
                    $this->error(404, [], "No such user " . $id);
                }
                $this->success(200, $user);
                break;
            case "bookings":
                $bookings = $this->bookingService->findAll();
                $this->success(200, $bookings);
                break;
            case "booking":
                if (!isset($_GET["id"])) {
                    $this->error(400, [], "Bad Request - booking ID required");
                }
                $id = intval($_GET["id"]);
                $booking = $this->bookingService->findByID($id);
                if ($booking === null) {
                    $this->error(404, [], "No such booking " . $id);
                }
                $this->success(200, $booking);
                break;
            case "products":
                $products = $this->productService->findAll();
                $this->success(200, $products);
                break;
            case "product":
                if (!isset($_GET["id"])) {
                    $this->error(400, [], "Bad Request - product ID required");
                }
                $id = intval($_GET["id"]);
                $product = $this->productService->findByID($id);
                if ($product === null) {
                    $this->error(404, [], "No such product " . $id);
                }
                $this->success(200, $product);
                break;
            case "vouchers":
                $vouchers = $this->voucherService->findAll();
                $this->success(200, $vouchers);
                break;
            default:
                $this->error(400, [], "Bad Request - invalid resource " . $resource);
        }
    }

    // Verarbeitet POST-Anfragen
    private function processPost($resource)
    {
        if (empty($resource)) {
            $this->error(400, [], "Bad Request - resource parameter missing");
            return;
        }

        $data = json_decode(file_get_contents('php://input'));

        switch ($resource) {
            case "user":
                $this->processPostUser($data);
                break;
            case "booking":
                $this->processPostBooking($data);
                break;
            case "product":
                $this->processPostProduct($data);
                break;
            case "voucher":
                $this->processPostVoucher($data);
                break;
            default:
                $this->error(400, [], "Bad Request - invalid resource " . $resource);
        }
    }

    // Speichert oder aktualisiert einen Benutzer
    private function processPostUser($data)
    {
        if (
            !isset($data->username) || !isset($data->password) || !isset($data->useremail) ||
            !isset($data->firstname) || !isset($data->lastname)
        ) {
            $this->error(400, [], "Bad Request - required fields missing");
        }

        $id = isset($data->id) ? intval($data->id) : 0;
        $user = new User(
            $id,
            $data->username,
            $data->password,
            $data->useremail,
            $data->address ?? "",
            $data->city ?? "",
            $data->state ?? "",
            $data->zip ?? 0,
            $data->anrede ?? "",
            $data->firstname,
            $data->lastname,
            $data->role ?? 0,
            $data->accountstatus ?? 1
        );

        if (($result = $this->userService->save($user)) === false) {
            $this->error(400, [], "Bad Request - error saving user");
        }

        $this->success($id == 0 ? 201 : 200, $result);
    }

    // Speichert oder aktualisiert eine Buchung
    private function processPostBooking($data)
    {
        if (!isset($data->userID) || !isset($data->price) || !isset($data->title) || !isset($data->created_at)) {
            $this->error(400, [], "Bad Request - required fields missing");
        }

        $id = isset($data->id) ? intval($data->id) : 0;
        $booking = new Booking($id, $data->userID, $data->price, $data->title, $data->created_at);

        if (($result = $this->bookingService->save($booking)) === false) {
            $this->error(400, [], "Bad Request - error saving booking");
        }

        $this->success($id == 0 ? 201 : 200, $result);
    }

    // Speichert oder aktualisiert ein Produkt
    private function processPostProduct($data): void
    {
        if (!isset($data->tags) || !isset($data->datum) || !isset($data->title)) {
            $this->error(400, [], "Bad Request - required fields missing");
        }

        $id = isset($data->id) ? intval($data->id) : 0;
        $product = new Product($data->tags, $data->datum, $id, $data->title, $data->price ?? 0, $data->image ?? "");

        if (($result = $this->productService->save($product)) === false) {
            $this->error(400, [], "Bad Request - error saving product");
        }

        $this->success($id == 0 ? 201 : 200, $result);
    }

    // Speichert oder aktualisiert einen Gutschein
    private function processPostVoucher($data): void
    {
        if (!isset($data->value) || !isset($data->expiry_date)) {
            $this->error(400, [], "Bad Request - required fields missing");
        }

        $id = isset($data->id) ? intval($data->id) : 0;
        $voucher = new Voucher($id, null, $data->value, $data->expiry_date);

        if (($result = $this->voucherService->save($voucher)) === false) {
            $this->error(400, [], "Bad Request - error saving voucher");
        }

        $this->success($id == 0 ? 201 : 200, $result);
    }

    // Verarbeitet DELETE-Anfragen
    private function processDelete($resource)
    {
        if (empty($resource)) {
            $this->error(400, [], "Bad Request - resource parameter missing");
        }

        switch ($resource) {
            case "user":
                $this->processDeleteUser();
                break;
            case "booking":
                $this->processDeleteBooking();
                break;
            case "product":
                $this->processDeleteProduct();
                break;
            default:
                $this->error(400, [], "Bad Request - invalid resource " . $resource);
        }
    }

    // Löscht einen Benutzer
    private function processDeleteUser()
    {
        if (!isset($_GET["id"])) {
            $this->error(400, [], "Bad Request - user ID required");
        }

        $id = intval($_GET["id"]);
        if (($user = $this->userService->findByID($id)) === null) {
            $this->error(404, [], "No such user " . $id);
        }

        if ($this->userService->delete($user) === false) {
            $this->error(400, [], "Bad Request - error deleting user");
        }

        $this->success(200, $user);
    }

    // Löscht eine Buchung
    private function processDeleteBooking()
    {
        if (!isset($_GET["id"])) {
            $this->error(400, [], "Bad Request - booking ID required");
        }

        $id = intval($_GET["id"]);
        if (($booking = $this->bookingService->findByID($id)) === null) {
            $this->error(404, [], "No such booking " . $id);
        }

        if ($this->bookingService->delete($booking) === false) {
            $this->error(400, [], "Bad Request - error deleting booking");
        }

        $this->success(200, $booking);
    }

    // Löscht ein Produkt
    private function processDeleteProduct()
    {
        if (!isset($_GET["id"])) {
            $this->error(400, [], "Bad Request - product ID required");
        }

        $id = intval($_GET["id"]);
        if (($product = $this->productService->findByID($id)) === null) {
            $this->error(404, [], "No such product " . $id);
        }

        if ($this->productService->delete($product) === false) {
            $this->error(400, [], "Bad Request - error deleting product");
        }

        $this->success(200, $product);
    }

    // Sendet eine erfolgreiche Antwort
    private function success(int $code, $obj)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo (json_encode($obj));
        exit;
    }

    // Sendet eine Fehlermeldung
    private function error(int $code, array $headers, $msg)
    {
        http_response_code($code);
        foreach ($headers as $hdr) {
            header($hdr);
        }
        echo ($msg);
        exit;
    }
}
