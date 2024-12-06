<?php
include "cliente.php";
include "producto.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Psr7\Message;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// endpoint para obtener un cliente especifico
$app->get('/api/cliente', function (Request $request, Response $response, $args) {
    $repo = new ClienteRepo();

    try {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'];
        $cliente = $repo->getById($id);
        if (!$cliente) {
            throw new Exception("Cliente no existe");
        }
        $payload = json_encode($cliente);
        $response->getBody()->write($payload);


        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    };
});

//endpoint para obtener todos los clientes
$app->get('/api/clientes', function (Request $request, Response $response, $args) {
    $repo = new ClienteRepo();

    try {
        $cliente = $repo->all();
        if (!$cliente) {
            throw new Exception("No hay registros");
        }
        $payload = json_encode($cliente);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    };
});

//endpoint para borrar un cliente
$app->delete('/api/cliente', function (Request $request, Response $response, $args) {
    $repo = new ClienteRepo();

    try {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'];
        $repo->delete($id);
        $payload = json_encode([
            "mensaje" => "Borrado exitosamente"
        ]);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    };
});

//endpoint para agregar un nuevo cliente
$app->post('/api/clientes', function (Request $request, Response $response) {
    $repo = new ClienteRepo();
    try {
        // Obtener datos del body
        $data = json_decode($request->getBody(), true);

        // Validar campos requeridos
        if (!isset($data['razonSocial']) || !isset($data['ci'])) {
            throw new Exception('Faltan campos requeridos');
        }

        // Crear cliente
        $repo->create(
            $data['razonSocial'],
            $data['ci']
        );

        // Respuesta exitosa
        $response->getBody()->write(json_encode([
            "mensaje" => "Cliente creado exitosamente"
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    } catch (Exception $err) {
        error_log($err->getMessage());
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
});

//endpoint para actualizar un cliente
$app->patch('/api/cliente', function (Request $request, Response $response, $args) {
    $repo = new ClienteRepo();

    try {
        // Obtener el JSON del cuerpo de la petición
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);

        // Validar que existan los campos necesarios
        if (!isset($data['id'], $data['razonSocial'], $data['ci'])) {
            throw new Exception("Faltan campos requeridos");
        }

        // Ejecutar la actualización
        $repo->update(
            $data['id'],
            $data['razonSocial'],
            $data['ci']
        );

        // Responder éxito
        $response->getBody()->write(json_encode([
            "mensaje" => "Cliente actualizado exitosamente"
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        error_log($err->getMessage());
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
});

//endpoint para obtener todos los productos
$app->get('/api/productos', function (Request $request, Response $response, $args) {
    $repo = new ProductoRepo();

    try {
        $producto = $repo->all();
        if (!$producto) {
            throw new Exception("No hay registros");
        }
        $payload = json_encode($producto);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    };
});

//endpoint para eliminar un producto
$app->delete('/api/producto', function (Request $request, Response $response, $args) {
    $repo = new ProductoRepo();

    try {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'];
        $repo->delete($id);
        $payload = json_encode([
            "mensaje" => "Borrado exitosamente"
        ]);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    };
});

//endpoint para actualizar un producto
$app->patch('/api/producto', function (Request $request, Response $response, $args) {
    $repo = new ProductoRepo();

    try {
        // Obtener el JSON del cuerpo de la petición
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);

        // Validar que existan los campos necesarios
        if (!isset($data['id'], $data['marca'], $data['modelo'], $data['año'], $data['color'], $data['chasis'])) {
            throw new Exception("Faltan campos requeridos");
        }

        error_log("fallo");
        // Ejecutar la actualización
        $repo->update(
            $data['id'],
            $data['marca'],
            $data['modelo'],
            $data['año'],
            $data['color'],
            $data['chasis'],
        );

        // Responder éxito
        $response->getBody()->write(json_encode([
            "mensaje" => "Actualizado exitosamente"
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } catch (Exception $err) {
        error_log($err->getMessage());
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
});

//endpoint para agregar un nuevo producto
$app->post('/api/productos', function (Request $request, Response $response) {
    $repo = new ProductoRepo();
    try {
        // Obtener datos del body
        $data = json_decode($request->getBody(), true);

        // Validar campos requeridos
        if (
            !isset($data['marca']) || !isset($data['modelo']) ||
            !isset($data['año']) || !isset($data['color']) ||
            !isset($data['chasis'])
        ) {
            throw new Exception('Faltan campos requeridos');
        }

        // Crear producto
        $repo->create(
            $data['marca'],
            $data['modelo'],
            $data['año'],
            $data['color'],
            $data['chasis']
        );

        // Respuesta exitosa
        $response->getBody()->write(json_encode([
            "mensaje" => "Producto creado exitosamente"
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 Created

    } catch (Exception $err) {
        error_log($err->getMessage());
        $response->getBody()->write(json_encode([
            "mensaje" => $err->getMessage()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
});



$app->run();
