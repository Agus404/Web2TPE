<?php

class Model{
    protected $db;

    public function __construct(){
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        if ($this->db) {
            $this->createDatabase();
            $this->db->exec("USE " . MYSQL_DB);
            $this->deploy();
        }
    }

    function createDatabase() {
        $query = "CREATE DATABASE IF NOT EXISTS " . MYSQL_DB . " DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        $this->db->exec($query);
    }

    private function deploy(){
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                --
                -- Base de datos: `chacinados`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `marcas`
                --

                CREATE TABLE `marcas` (
                `id_marca` int(11) NOT NULL,
                `nombre_marca` varchar(50) NOT NULL,
                `contacto` varchar(50) NOT NULL,
                `sede` varchar(50) NOT NULL,
                `imagen_marca` varchar(50) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `marcas`
                --

                INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `contacto`, `sede`, `imagen_marca`) VALUES
                (1, 'Cagnoli', 'info@cagnoli.com', 'Sección Chacras 43, Tandil, Argentina.', NULL),
                (2, 'Las Dinas', 'dinas.salumeria@hotmail.com', 'Parque Industrial, Tandil, Argentina.', NULL),
                (5, 'Paladini', 'info@paladini.com', 'Carlos Tejedor 2040, Cordoba, Argentina', NULL),
                (6, 'Lario', '(54) 3492 438800', 'Paraná 899, Rafaela, Santa Fe, Argentina.', NULL);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `productos`
                --

                CREATE TABLE `productos` (
                `id_producto` int(11) NOT NULL,
                `nombre_producto` varchar(50) NOT NULL,
                `peso` int(11) NOT NULL,
                `precio` int(11) NOT NULL,
                `id_marca` int(11) NOT NULL,
                `imagen_producto` varchar(50) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `productos`
                --

                INSERT INTO `productos` (`id_producto`, `nombre_producto`, `peso`, `precio`, `id_marca`, `imagen_producto`) VALUES
                (7, 'Jamon cocido horneado', 400, 99999, 5, NULL),
                (8, 'Longaniza calabresa', 200, 4500, 2, NULL),
                (14, 'Bondiola ahumada', 200, 7000, 2, NULL),
                (15, 'Mortadela Bologna', 500, 7123, 6, NULL),
                (17, 'Salamin picado fino', 300, 9500, 1, NULL),
                (19, 'Salamin picado grueso', 150, 4800, 1, NULL),
                (32, 'Jamon crudo feteado', 120, 5790, 6, NULL),
                (33, 'Salchica parrillera', 1000, 11359, 5, NULL);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuarios`
                --

                CREATE TABLE `usuarios` (
                `id_usuario` int(11) NOT NULL,
                `nombre_usuario` varchar(50) NOT NULL,
                `password` char(60) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `usuarios`
                --

                INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password`) VALUES
                (1, 'webadmin', '$2y$10$3s/7OkBzNGrgBi1KtLdYTOoaYYAqKUPwsbgh5z/fzsA5B1qAad1pu');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `marcas`
                --
                ALTER TABLE `marcas`
                ADD PRIMARY KEY (`id_marca`);

                --
                -- Indices de la tabla `productos`
                --
                ALTER TABLE `productos`
                ADD PRIMARY KEY (`id_producto`),
                ADD KEY `id_marca` (`id_marca`);

                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id_usuario`),
                ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `marcas`
                --
                ALTER TABLE `marcas`
                MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

                --
                -- AUTO_INCREMENT de la tabla `productos`
                --
                ALTER TABLE `productos`
                MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `productos`
                --
                ALTER TABLE `productos`
                ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;
            END;
            $this->db->query($sql);
        }
    }
}
