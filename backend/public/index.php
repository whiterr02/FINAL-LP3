<?php
include "cliente.php";
include "producto.php";
include "usuario.php";

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

// Endpoint para login de usuario
$app->post('/api/login', function (Request $request, Response $response) {
    $repo = new UsuarioRepo();
    try {
        $data = json_decode($request->getBody(), true);

        if (!isset($data['user']) || !isset($data['password'])) {
            throw new Exception('Faltan campos requeridos: user y password');
        }

        $usuario = $repo->login($data['user'], $data['password']);

        if ($usuario) {
            $response->getBody()->write(json_encode([
                "mensaje" => "Login successful"
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            $response->getBody()->write(json_encode([
                "mensaje" => "Invalid credentials"
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
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

// Endpoint para crear un nuevo usuario
$app->post('/api/usuarios/create', function (Request $request, Response $response) {
    $repo = new UsuarioRepo();
    try {
        $data = json_decode($request->getBody(), true);

        if (!isset($data['user']) || !isset($data['password'])) {
            throw new Exception('Faltan campos requeridos: user y password');
        }

        $repo->create($data['user'], $data['password']);

        $response->getBody()->write(json_encode([
            "mensaje" => "User created successfully"
        ]));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        // Check if the error is due to a duplicate entry (error code 23000)
        if ($e->getCode() == '23000') {
            $response->getBody()->write(json_encode([
                "mensaje" => "User already exists"
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(409); // Conflict
        } else {
            $response->getBody()->write(json_encode([
                "mensaje" => "Error creating user: " . $e->getMessage()
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
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

// Endpoint para actualizar la contraseña de un usuario
$app->patch('/api/usuarios/update-password', function (Request $request, Response $response) {
    $repo = new UsuarioRepo();
    try {
        $data = json_decode($request->getBody(), true);

        if (!isset($data['id']) || !isset($data['newPassword'])) {
            throw new Exception('Faltan campos requeridos: id y newPassword');
        }

        $success = $repo->updatePassword($data['id'], $data['newPassword']);

        if ($success) {
            $response->getBody()->write(json_encode([
                "mensaje" => "Password updated successfully"
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            // This part might be tricky as execute() returns true on success, false on error.
            // It doesn't directly tell us if the user was not found or if another error occurred.
            // A more robust way would be to check if the user exists before attempting an update,
            // or check the number of affected rows. For now, a generic error for failure.
            $response->getBody()->write(json_encode([
                "mensaje" => "Failed to update password. User not found or other error."
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Or 404 if we could confirm user not found
        }
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
