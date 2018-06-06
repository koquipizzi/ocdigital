<?php

use yii\db\Migration;

/**
 * Class m180123_131933_productos_produccion
 */
class m180123_131933_productos_produccion extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $insertsSinWebId = "
        INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (31, 'Muffin Arandanos', 2, null, null, 1, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (32, 'Muffin Frambuesa', 2, null, null, 12, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (33, 'Muffin Chocolate y Banana', 2, null, null, 13, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (34, 'Muffin Vainilla', 2, null, null, 14, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (35, 'Muffin Vegano de Chocolate', 2, null, null, 15, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (36, 'Muffin Chocolate y Arandanos', 2, null, null, 16, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (37, 'Cookies de Avena y Pasas', 2, null, null, 2, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (38, 'Cookies de Avena y Pasas grande', 2, null, null, 21, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (39, 'Cookie de Chips de chocolate', 2, null, null, 22, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (40, 'Cookie de Chips de chocolate grande', 2, null, null, 23, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (41, 'Cookie de Jengibre', 2, null, null, 24, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (42, 'Cookie de Jengibre grande', 2, null, null, 25, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (43, 'Cookie Diamante de Chocolate', 2, null, null, 26, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (44, 'Cookie Diamante de Limón', 2, null, null, 27, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (45, 'Alfajor Sable y Dulce de leche', 2, null, null, 3, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (46, 'Alfajor Sable y Dulce de leche grande', 2, null, null, 31, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (47, 'Alfajor Almendras y Dulce de leche grande', 2, null, null, 32, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (48, 'Scon Dulce', 2, null, null, 4, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (49, 'Scon Dulce y Pasas', 2, null, null, 41, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (50, 'Scon de Queso', 2, null, null, 42, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (51, 'Biscotties de Almendras', 2, null, null, 5, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (52, 'Budín de Limón 350 gr.', 2, null, null, 6, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (53, 'Budín de Limón 1,200 gr.', 2, null, null, 61, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (54, 'Budín de Limón y Amapolas 2,000 gr.', 2, null, null, 62, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (55, 'Budin de Banana y Dulce de leche 1,200 gr', 2, null, null, 63, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (56, 'Budin de Banana y Dulce de leche 2,000 gr.', 2, null, null, 64, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (57, 'Budín de Naranja 350 gr.', 2, null, null, 65, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (58, 'Budín de Naranja 1,200 gr.', 2, null, null, 66, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (59, 'Budín de Naranja 2,000 gr.', 2, null, null, 67, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (60, 'Budín de Chocolate 350 gr.', 2, null, null, 68, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (61, 'Budín de Chocolate 1,200 gr.', 2, null, null, 69, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (62, 'Budín de Chocolate 2,000 gr.', 2, null, null, 610, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (63, 'Granola', 2, null, null, 7, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (64, 'Cheesecake clásico individual', 1, null, null, 10, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (65, 'Torta Cheesecake clásico 1000 gr.', 1, null, null, 101, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (66, 'Cheesecake de maracuya individual', 1, null, null, 102, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (67, 'Torta Cheesecake de maracuya 1000 gr.', 1, null, null, 103, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (68, 'Torta Brownie 1000 gr.', 1, null, null, 104, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (69, 'Torta Rogel individual', 1, null, null, 105, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (70, 'Torta Rogel 1000 gr.', 1, null, null, 106, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (71, 'Choco amargo individual', 1, null, null, 107, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (72, 'Torta Choco amargo 1000 gr.', 1, null, null, 108, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (73, 'Choco limón individual', 1, null, null, 109, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (74, 'Torta Choco limón 1000 gr.', 1, null, null, 1010, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (75, 'Choco frambuesa individual', 1, null, null, 1011, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (76, 'Torta Choco frambuesa 1000 gr.', 1, null, null, 1012, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (77, 'Catalana individual', 1, null, null, 1013, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (78, 'Torta Catalana 1000 gr.', 1, null, null, 1014, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (79, 'Financier individual', 1, null, null, 1015, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (80, 'Torta Financier 1000 gr.', 1, null, null, 1016, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (81, 'Textura de chocolate individual', 1, null, null, 1017, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (82, 'Torta Textura de chocolate 1000 gr.', 1, null, null, 1018, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (83, 'Mousse de de dulce de leche individual', 1, null, null, 1019, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (84, 'Torta Mousse de de dulce de leche 1000 gr.', 1, null, null, 1020, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (85, 'Choco pasión individual', 1, null, null, 1021, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (86, 'Torta Choco pasión 1000 gr.', 1, null, null, 1022, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (87, 'Caramel candela individual', 1, null, null, 1023, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (88, 'Torta Caramel candela 1000 gr.', 1, null, null, 1024, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (89, 'Fresh lucia individual', 1, null, null, 1025, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (90, 'Torta Fresh lucia 1000 gr.', 1, null, null, 1026, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (91, 'Aromas del sur individual', 1, null, null, 1027, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (92, 'Chocolate, naranja y avellana individual', 1, null, null, 1028, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (93, 'Torta Chocolate, naranja y avellana 1000 gr.', 1, null, null, 1029, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (94, 'Dona de chocolate y naranja individual', 1, null, null, 1030, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (95, 'Coco, frutilla y pimienta roja individual', 1, null, null, 1031, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (96, 'Torta Coco, frutilla y pimienta roja 1000 gr.', 1, null, null, 1032, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (97, 'Choco banana individual', 1, null, null, 1033, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (98, 'Torta Choco banana 1000 gr.', 1, null, null, 1034, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (99, 'Mousse de chocolate amargo y frambuesa individual', 1, null, null, 1035, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (100, 'Torta Mousse de chocolate amargo y frambuesa 1000 gr.', 1, null, null, 1036, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (101, 'Soufle de almendras individual', 1, null, null, 1037, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (102, 'Torta Soufle de almendras 1000 gr.', 1, null, null, 1038, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (103, 'Tarteleta de manzana, arándanos con crumble de amapola individual', 1, null, null, 1039, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (104, 'Tarta de manzana, arándanos con crumble de amapola ', 1, null, null, 1040, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (105, 'Tarteleta de peras y almendras (en época de estación) individual', 1, null, null, 1041, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (106, 'Tarta de peras y almendras (en época de estación)', 1, null, null, 1042, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (107, 'Tarteleta de higos (en época de estación) individual', 1, null, null, 1043, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (108, 'Tarta de higos (en época de estación)', 1, null, null, 1044, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (109, 'Crostata de limón individual', 1, null, null, 1045, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (110, 'Crostata de limón ', 1, null, null, 1046, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (111, 'Tarteleta de limón y merengue  individual', 1, null, null, 1047, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (112, 'Tarta de limón y merengue', 1, null, null, 1048, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (113, 'Tarteleta de caramelo, queso chocolate y avellanas acarameladas  individual', 1, null, null, 1049, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (114, 'Tarta de caramelo, queso chocolate y avellanas acarameladas', 1, null, null, 1050, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (115, 'Tarteleta de arándanos frescos y crema de almendras  individual', 1, null, null, 1051, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (116, 'Tarta de arándanos frescos y crema de almendras', 1, null, null, 1052, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (117, 'Caja de Macarons', 1, null, null, 1053, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (118, 'Torta especial por evento', 1, null, null, 1054, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (119, 'Finger Food Tarteleta de Manzana', 1, null, null, 201, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (120, 'Finger Food Tarteleta de Limón y merengue', 1, null, null, 202, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (121, 'Finger Food Tarta de caramelo, queso chocolate y avellanas acarameladas ', 1, null, null, 203, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (122, 'Finger Food Aromas del sur ', 1, null, null, 204, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (123, 'Finger Food Choco Pasión Limon ', 1, null, null, 205, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (124, 'Finger Food Choco Amargo con Frambuesa ', 1, null, null, 206, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (125, 'Finger Food Tarteleta de Maracuya', 1, null, null, 207, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (126, 'Placa Manzana con cassis y crumble de amapola ', 1, null, null, 30, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (127, 'Placa Coco y dulce de leche ', 1, null, null, 301, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (128, 'Cuadrado Coco y dulce de leche ', 1, null, null, 302, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (129, 'Placa Brownie con nuez ', 1, null, null, 302, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (130, 'Placa Pasta Frola', 1, null, null, 304, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (131, 'Cuadrado Pasta Frola', 1, null, null, 305, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (132, 'Placa Peras y almendras ', 1, null, null, 306, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (133, 'Lingote Carrot Cake ', 1, null, null, 40, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (134, 'Lingote Chocotorta ', 1, null, null, 401, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (135, 'Lingote Brownie  ', 1, null, null, 402, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (136, 'Medialuna cocida', 3, null, null, 50, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (137, 'Medialuna congelada', 3, null, null, 501, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (138, 'Croissant cocido chico', 3, null, null, 502, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (139, 'Croissant cocido grande', 3, null, null, 503, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (140, 'Croissant congelado', 3, null, null, 504, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (141, 'Pain au chocolat cocico chico', 3, null, null, 505, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (142, 'Pain au chocolat cocico grande', 3, null, null, 506, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (143, 'Pain au chocolat congelado', 3, null, null, 507, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (144, 'Cinamon Roll con Crema Pastelera', 3, null, null, 508, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (145, 'Cinamon Roll Tradicional', 3, null, null, 509, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (146, 'Panettone Naranjitas y pasas de uva 450 gr.', 3, null, null, 60, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (147, 'Panettone Naranjitas y pasas de uva 900 gr.', 3, null, null, 601, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (148, 'Panettone Chocolate con leche y chocolate amargo 450 gr.', 3, null, null, 602, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (149, 'Panettone Chocolate con leche y chocolate amargo 900gr.', 3, null, null, 603, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (150, 'Panettone Tradicional con frutas abrillandas y almendras 450 gr.', 3, null, null, 604, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (151, 'Panettone Tradicional con frutas abrillandas y almendras 900gr.', 3, null, null, 605, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (152, 'Panettone Almendras 450 gr.', 3, null, null, 606, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (153, 'Panettone Almendras 900gr.', 3, null, null, 607, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (154, 'Baguettin blanco', 4, null, null, 70, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (155, 'Baguettin salvado', 4, null, null, 701, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (156, 'Baguettin de Queso', 4, null, null, 702, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (157, 'Baguettin de Aceituna', 4, null, null, 703, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (158, 'Baguettin de Leche', 4, null, null, 704, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (159, 'Baguettin de Leche con amapolas', 4, null, null, 705, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (160, 'Baguettin de Cebollas', 4, null, null, 706, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (161, 'Baguettin brioche con semillas de amapola', 4, null, null, 707, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (162, 'Baguettin brioche con semillas de sesamo', 4, null, null, 708, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (163, 'Pan molde de Campo 900 gr.', 4, null, null, 80, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (164, 'Pan mini molde de Campo 400 gr.', 4, null, null, 801, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (165, 'Pan molde Salvado  900 gr.', 4, null, null, 802, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (166, 'Pan mini molde Salvado   400 gr.', 4, null, null, 803, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (167, 'Pan molde Multicereal 1000 gr.', 4, null, null, 804, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (168, 'Pan mini molde Multicereal 500 gr.', 4, null, null, 805, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (169, 'Pan molde Brioche 400 gr.', 4, null, null, 806, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (170, 'Pan mini molde Brioche 900 gr.', 4, null, null, 807, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (171, 'Pan molde Brioche y pasas de uva 1000 gr.', 4, null, null, 808, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (172, 'Pan mini molde de Brioche y pasas de uva 450 gr.', 4, null, null, 809, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (173, 'Ciabattas blancas', 4, null, null, 90, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (174, 'Ciabatta de Salvado', 4, null, null, 901, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (175, 'Ciabattas de Aceitunas ', 4, null, null, 902, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (176, 'Ciabatta blanca con Oregano y Polenta', 4, null, null, 903, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (177, 'Pretzel tradicional', 4, null, null, 100, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (178, 'Pretzel de Queso', 4, null, null, 1001, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (179, 'Bagel (con semillas de amapola)', 4, null, null, 1002, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (180, 'Pan pita blanco', 4, null, null, 1003, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (181, 'Pan pita salvado ', 4, null, null, 1004, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (182, 'Pan de hamburguesa  blanco de 10 cm', 4, null, null, 1100, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (183, 'Pan de hamburguesa integral de 10 cm', 4, null, null, 1101, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (184, 'Pan de hamburguesa brioche de 10 cm ', 4, null, null, 1102, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (185, 'Pan de hamburguesa Campero', 4, null, null, 1103, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (186, 'Pan de hamburguesa brioche de 6 cm ', 4, null, null, 1104, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (187, 'Pan de hamburguesa  blanco de 6 cm', 4, null, null, 1105, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (188, 'Mini Pan de Campo 30 gr ', 4, null, null, 1200, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (189, 'Mini Brioche 30 gr', 4, null, null, 1201, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (190, 'Mini Ciabatta 30 gr', 4, null, null, 1202, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (191, 'Mini Salvado 30 gr', 4, null, null, 1203, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (192, 'Mini Baguettin de Leche 30 gr', 4, null, null, 1204, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (193, 'Mini Multicereal 30 gr', 4, null, null, 1205, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (194, 'Pan Negro 85 gr.', 4, null, null, 1206, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (195, 'Pan Blanco 85 gr.', 4, null, null, 1207, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (196, 'Pan molde Campo redondo', 4, null, null, 1300, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (197, 'Hogaza 1000 gr.', 4, null, null, 1301, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (198, 'Zepelin Campo ', 4, null, null, 1302, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (199, 'Baguette 350 gr.', 4, null, null, 1303, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (200, 'Baguette 450 gr.', 4, null, null, 1304, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (201, 'Pan Aleman de centeno 600 gr.', 4, null, null, 1305, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (202, 'Pan integral de aceitunas negras 600 gr.', 4, null, null, 1306, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (203, 'Zepelin Centeno Chico 400 gr.', 4, null, null, 1307, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (204, 'Zepelin Centeno Grande 600 gr.', 4, null, null, 1308, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (205, 'Tarta de Calabaza y queso', 5, null, null, 1400, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (206, 'Tarta de Espinaca, cherry y queso', 5, null, null, 1401, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (207, 'Tarta de Zapallitos', 5, null, null, 1402, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (208, 'Tarta de Jamón y queso', 5, null, null, 1403, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (209, 'Tarta de Puerros', 5, null, null, 1404, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (210, 'Tarta de Cebolla', 5, null, null, 1405, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (211, 'Tarta de Calabaza y choclo', 5, null, null, 1406, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (212, 'Sandwich de Pastron y pickles de pepino', 5, null, null, 1500, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (213, 'Sandwich de Jamón Crudo y pulpeta', 5, null, null, 1501, null, null);
		INSERT INTO comandas.producto (id, nombre, categoria_id, precio_unitario, web_id, maxirest_id, ultima_modificacion, baja_logica) VALUES (214, 'Sandich de Vegetales Asados', 5, null, null, 1502, null, null);
        ";

        $this->execute($insertsSinWebId);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_131933_productos_produccion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_131933_productos_produccion cannot be reverted.\n";

        return false;
    }
    */
}
