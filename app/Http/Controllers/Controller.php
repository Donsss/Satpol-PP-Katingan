<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 * version="1.0.0",
 * title="Dokumentasi API Satpol PP",
 * description="Dokumentasi ini berisi semua endpoint API yang tersedia untuk proyek Satpol PP."
 * )
 * @OA\Server(
 * url=L5_SWAGGER_CONST_HOST,
 * description="API Server"
 * )
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer"
 * )
 */
abstract class Controller
{
    //
}
