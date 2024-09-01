<?php
header('Content-Type: application/json');

require_once '../vendor/autoload.php';

ini_set('display_errors', 'Off');

error_reporting(0);

// api/users/1
if ($_GET['url']) {
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'api') {
        array_shift($url);

        $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';
        array_shift($url);

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        try {
            $response = call_user_func_array(array(new $service, $method), $url);

            http_response_code(200);
            $output = array(
                'status' => 'success',
                'data' => $response
            );
            echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            exit;
        } catch (\Exception $e) {
            http_response_code(404);
            $output = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );
            echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
} else {
    header('Content-Type: text/html');
    echo "<center>";
    echo "<br><h1>Bem vindo a nossa API de cadastro de usuário!</h1>";
    echo "<h3>Para verificar os recursos, utilize os endpoints abaixo:</h3>";

    echo '<table border="4">
        <tr style="color:black;">
            <th>Função</th>
            <th>URL</th>
        </tr>
        <tr>
            <td style="color:#2980B9;"><b>Listar todos os usuários</b></td>
            <td>http://localhost/api_rest_php/public_html/api/user</td>
        </tr>
        <tr>
            <td style="color:#2980B9;"><b>Listar um usuário específico [informar o id apos o /user]</b></td>
            <td>http://localhost/api_rest_php/public_html/api/user/1</td>
        </tr>
    <tr>
</tr>

      </table>';
    echo "<h3>Para verificar os verbos POST,PUT  utilize o POSTMAN passando como dados  nome,email e password";
    echo "<h3>Para verificar o verbo DELETE utilize o POSTMAN e  informe um id conforme o exemplo http://localhost/api_rest_php/public_html/api/user/1";
    echo "</center>";
}

<?php
session_start();

// CSRF Protection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['_csrf_token']) || $_POST['_csrf_token'] !== $_SESSION['_csrf_token']) {
        throw new Exception('Invalid CSRF token');
    }
}

// Generate a new CSRF token
$_SESSION['_csrf_token'] = bin2hex(random_bytes(32));

?>
