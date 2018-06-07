<?php

use yii\db\Migration;

/**
 * Class m180123_133211_clientes_produccion
 */
class m180123_133211_clientes_produccion extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        return true;
      $clients = "
      INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(4, ' ', '429 bar', '429 bar', NULL, NULL, NULL, NULL, NULL, '429recoleta@gmail.com', 'Av. Las Heras 2429');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(5, 'aires green srl', 'Aires Green', 'aires green srl', NULL, NULL, NULL, NULL, NULL, 'aires@qwavee.com', 'Lavalle 441 ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(6, 'Miracle station s.a.', 'All Saints Belgrano', 'Miracle station s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Ciudad de la Paz 2298');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(7, 'Miracle station s.a.', 'All Saints Microcentro', 'Miracle station s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Corrientes 802');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(8, 'edurbanas s.a.', 'Almacen Bevant', 'edurbanas s.a.', NULL, NULL, NULL, NULL, NULL, 'rominafrajlich@yahoo.com.ar', 'Vicente Lopez 1827');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(9, 'Alparamis s.a.', 'Alparamis', 'Alparamis s.a.', NULL, NULL, NULL, NULL, NULL, 'basso@alparamis.com.ar', 'Av. Del Libertador 2229');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(10, ' ', 'Andra Bakery', 'Andra Bakery', NULL, NULL, NULL, NULL, NULL, '', 'Vicente Lopez 2238');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(11, 'Natfresc s.a.', 'Ba Green Martinez', 'Natfresc s.a.', NULL, NULL, NULL, NULL, NULL, 'buendia@ba-green.com.ar', 'Eduardo Costa 2028');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(12, 'Natfresc s.a.', 'Ba Green Reconquista', 'Natfresc s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Reconquista 536');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(13, 'Natfresc s.a.', 'Ba Green Vicente Lopez', 'Natfresc s.a.', NULL, NULL, NULL, NULL, NULL, '', 'H. Yrigoyen 501');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(14, ' ', 'Babel Suites', 'Babel Suites', NULL, NULL, NULL, NULL, NULL, 'manager@babelsuites.com.ar', 'Mexico 840');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(15, 'Parri Peña srl', 'Bar de Carnes', 'Parri Peña srl', NULL, NULL, NULL, NULL, NULL, 'dparra@grupotenedor.com', 'Peña 2287');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(16, 'Bar guapa s.a.', 'Bar Peugeout Loung Puerto Madero', 'Bar guapa s.a.', NULL, NULL, NULL, NULL, NULL, 'andreacelesteleon1990@gmail.com', 'Alicia Moreau de Justo 152');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(17, 'Bar guapa s.a.', 'Bar Peugeout Lounge', 'Bar guapa s.a.', NULL, NULL, NULL, NULL, NULL, 'jdiaz@barpeugeotlounge.com.ar', 'Honduras 5624');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(18, ' ', 'Barrio Cafetero', 'Barrio Cafetero', NULL, NULL, NULL, NULL, NULL, 'barriocafetero@gmail.com', 'Florida 833');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(19, 'coffee entertaiment srl', 'Bedford Station Arce', 'coffee entertaiment srl', NULL, NULL, NULL, NULL, NULL, 'leohsantos@hotmail.com', 'Arce 802');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(20, ' ', 'Berne Club', 'Berne Club', NULL, NULL, NULL, NULL, NULL, '', 'Medrano 1475');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(21, ' ', 'Birkin', 'Birkin', NULL, NULL, NULL, NULL, NULL, 'ponejuan@hotmail.com', 'Republica Arabe Siria 3061');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(22, ' ', 'Bote Coffee', 'Bote Coffee', NULL, NULL, NULL, NULL, NULL, 'administración@botecoffee.com', 'Callao 477');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(23, ' ', 'Bruni', 'Bruni', NULL, NULL, NULL, NULL, NULL, '', 'Castañeda 1899');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(24, 'el helado cubano s.a.', 'Buffala Helados', 'el helado cubano s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Av. Pueyrredon 2100 ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(25, ' ', 'Café Boccazzi', 'Café Boccazzi', NULL, NULL, NULL, NULL, NULL, 'admlalatina@gmail.com', 'Arce 940');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(26, 'Café de la plaza resto san nicoles s.a.', 'Café de la Plaza', 'Café de la plaza resto san nicoles s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Av. Lincoln 3990');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(27, 'La cordisa producciones s.a.', 'Café de los Periodistas', 'La cordisa producciones s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Concepcion Arenal 4865');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(28, 'alfixal srl', 'Cala', 'alfixal srl', NULL, NULL, NULL, NULL, NULL, '', 'peña 2101');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(29, 'barajar y dar de nuevo s.a.', 'Casa cruz', 'barajar y dar de nuevo s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Uriarte 1558');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(30, 'central cook s.a.', 'Central Cook', 'central cook s.a.', NULL, NULL, NULL, NULL, NULL, 'mjc@centralcook.com.ar', 'Av. Federico Lacroze 2300');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(31, 'cimino gelato srl', 'Cimino Gelato', 'cimino gelato srl', NULL, NULL, NULL, NULL, NULL, '', ' ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(32, 'eatalina srl', 'Core Italian Street Food', 'eatalina srl', NULL, NULL, NULL, NULL, NULL, 'marcobigotti@gmail.com', 'Maipu 819, CABA');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(33, 'alcorta sushi s.a. ', 'Dashi Alcorta', 'alcorta sushi s.a. ', NULL, NULL, NULL, NULL, NULL, 'info@dashi.com.ar', 'San Martin de Tours 3031');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(34, 'punto orione sa', 'Don Orione', 'punto orione sa', NULL, NULL, NULL, NULL, NULL, '', 'Del Libertador 3194, Vicente Lopez');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(35, 'el dorrego srl', 'Duque', 'el dorrego srl', NULL, NULL, NULL, NULL, NULL, '', 'Nicaragua 56086');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(36, 'rocha sol a. y noriega maria l (sh)', 'El Club de la Ensalada', 'rocha sol a. y noriega maria l (sh)', NULL, NULL, NULL, NULL, NULL, 'info@elclubdelaensalada.com.ar', 'Marcelo T de Alvear 877');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(37, 'Compañía General de Café srl', 'Establecimiento de Café Juncal', 'Compañía General de Café srl', NULL, NULL, NULL, NULL, NULL, '', 'Juncal 3500');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(38, 'Compañía General de Café srl', 'Establecimiento de Café Lavalle', 'Compañía General de Café srl', NULL, NULL, NULL, NULL, NULL, 'lavalle@estcafe.com.ar', 'Lavalle 1518');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(39, 'Compañía General de Café srl', 'Establecimiento de Café Pueyrredon', 'Compañía General de Café srl', NULL, NULL, NULL, NULL, NULL, '', 'Pueyrredon 1529');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(40, 'jghm srl', 'Establecimiento de Café Rodriguez Peña', 'jghm srl', NULL, NULL, NULL, NULL, NULL, 'rodriguezoena@gmail.com', 'Lavalle 1701');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(41, 'Raducci Daniela Silvana', 'Flora', 'Raducci Daniela Silvana', NULL, NULL, NULL, NULL, NULL, '', 'Av. Gutierrez Hudson 5365');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(42, 'Fresa fresco', 'Fresa Fresco', 'Fresa fresco', NULL, NULL, NULL, NULL, NULL, 'pedidos@frescourbano.com', 'Julio Roca 761');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(43, ' ', 'Full City Coffee House', 'Full City Coffee House', NULL, NULL, NULL, NULL, NULL, 'fullcityba@gmail.com', 'Thames 1535');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(44, 'Los borgas srl', 'Gallo Negro', 'Los borgas srl', NULL, NULL, NULL, NULL, NULL, '', 'Donado 1851 ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(45, 'gaspar café srl', 'Gaspar Café', 'gaspar café srl', NULL, NULL, NULL, NULL, NULL, 'gaspar@idehados.com.ar', 'Jose Cabrera 4725');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(46, 'Gaspar 2 sociedad de responsabilidad limitada', 'Gaspar Café 2', 'Gaspar 2 sociedad de responsabilidad limitada', NULL, NULL, NULL, NULL, NULL, 'gaspar@idehados.com.ar', 'Esmeralda 624');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(47, 'green bay market s.a.', 'Green Bay', 'green bay market s.a.', NULL, NULL, NULL, NULL, NULL, 'andreapaez@gmail.com', 'Boulevard Del Mirador 430');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(48, 'matias daniel celentano ', 'Hábito Café', 'matias daniel celentano ', NULL, NULL, NULL, NULL, NULL, 'schulzejavier@gmail.com', 'México 1152');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(49, 'harper ventures s.a.', 'Harper Juice & Coffee', 'harper ventures s.a.', NULL, NULL, NULL, NULL, NULL, 'molinad@punaam.com', 'Pueyrredon 1782');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(50, 'Foster Osvaldo Enrique', 'Honecker Chocolates', 'Foster Osvaldo Enrique', NULL, NULL, NULL, NULL, NULL, 'barbarafoster@honeckerchocolates.com.ar', 'Arenales 1620');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(51, ' ', 'Il Posto Mercato', 'Il Posto Mercato', NULL, NULL, NULL, NULL, NULL, 'postomercado@gmail.com', 'Soler 5502');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(52, 'r y hl s.a.', 'Illy ', 'r y hl s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Libertad 1150');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(53, 'zeca s.a.', 'Kona Bar', 'zeca s.a.', NULL, NULL, NULL, NULL, NULL, 'gabrielam@ginoclub.com.ar', 'Av. De Mayo 301, Ramos Mejia');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(54, ' ', 'La Apasionada', 'La Apasionada', NULL, NULL, NULL, NULL, NULL, 'silfita@yahoo.com.ar', 'Ayacucho 1388');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(55, 'Gastronomia Ñandu', 'La Dorita', 'Gastronomia Ñandu', NULL, NULL, NULL, NULL, NULL, '', 'Humboldt 1892');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(56, ' ', 'La motofeca', 'La motofeca', NULL, NULL, NULL, NULL, NULL, 'info@gotanegracafe.com', 'Paraguay 627');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(57, 'Marenco srl', 'Marenco', 'Marenco srl', NULL, NULL, NULL, NULL, NULL, '', 'H. Irigoyen y costanera, Zarate');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(58, 'diapri s.a.', 'Mercato Di Cavia', 'diapri s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Cavia 3090');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(59, ' ', 'Mezcal', 'Mezcal', NULL, NULL, NULL, NULL, NULL, 'alefluri@gmail.com', 'Costa Rica 4502');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(60, 'mision burger srl', 'Mission Burger ', 'mision burger srl', NULL, NULL, NULL, NULL, NULL, 'compras@grupotenedor.com', 'cerviño 3596');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(61, 'Yrigoyen 499 srl', 'Nana Vicente Lopez', 'Yrigoyen 499 srl', NULL, NULL, NULL, NULL, NULL, 'sofiareynal@gmail.com', 'H. Irygoyen ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(62, 'Delivery café s.a.', 'Negro Café Suipacha', 'Delivery café s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Suipacha 637');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(63, 'Grupo alf srl', 'Negro Cueva de Café', 'Grupo alf srl', NULL, NULL, NULL, NULL, NULL, 'agustin@grupoalfsrl.com', 'Marcelo T. De Alvear 790');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(64, 'Burger Group srl', 'Nicky', 'Burger Group srl', NULL, NULL, NULL, NULL, NULL, '', 'Malabia 1764');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(65, 'Aires Green srl', 'Nutrii', 'Aires Green srl', NULL, NULL, NULL, NULL, NULL, 'maria_florencia_91@hotmail.com', 'Lavalle 441 ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(66, ' ', 'Old Days Coffee', 'Old Days Coffee', NULL, NULL, NULL, NULL, NULL, 'oldayscoffee@gmail.com', 'Olga Cossettini 1182');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(67, ' ', 'Oslo', 'Oslo', NULL, NULL, NULL, NULL, NULL, 'claudiom@oslogourmet.com', 'Soldado de la independencia 788');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(68, ' ', 'Oviedo', 'Oviedo', NULL, NULL, NULL, NULL, NULL, 'oviedo@restaurantoviedo.com.ar', 'Antonio Beruti 2602');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(69, 'café rocamora srl', 'Padre coffee and beer', 'café rocamora srl', NULL, NULL, NULL, NULL, NULL, '', 'Borges 2008');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(70, 'Panaderia la defensa s.a.', 'Panadería de Pablo', 'Panaderia la defensa s.a.', NULL, NULL, NULL, NULL, NULL, '', 'defensa 274');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(71, 'inova s.a.', 'Punto Pizza', 'inova s.a.', NULL, NULL, NULL, NULL, NULL, 'costospp@gmail.com', 'Santos Dumont 4434');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(72, 'Carolina Bruzzoni', 'Rosso Caffé', 'Carolina Bruzzoni', NULL, NULL, NULL, NULL, NULL, 'carobruzzoni@yahoo.com', 'Tta. Gral. Juan Domingo Perón 731');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(73, 'two lions srl', 'Santal Café', 'two lions srl', NULL, NULL, NULL, NULL, NULL, '', 'Virrey del pino 2235 ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(74, 'sindicato de trabajadores de j', 'Sindicato de Trabajadores', 'sindicato de trabajadores de j', NULL, NULL, NULL, NULL, NULL, '', 'Adolfo Alsina 945');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(75, 'Punto Home srl', 'Soho Point', 'Punto Home srl', NULL, NULL, NULL, NULL, NULL, 'contact@sohopoint.com.ar', 'Paraguay 3261 PB');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(76, 'teglia s.a.', 'Teglia', 'teglia s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Av. Cramer 1997');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(77, 'the oldest de garcia carabal m', 'The Oldest', 'the oldest de garcia carabal m', NULL, NULL, NULL, NULL, NULL, 'theoldets@fibertel.com.ar', 'El Cano 3410');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(78, 'Lermos SA', 'Thee Catering', 'Lermos SA', NULL, NULL, NULL, NULL, NULL, '', 'Humboldt 1654');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(79, 'Gastronomica San Joaquin s.a.', 'Tiendas Naturales Cabello', 'Gastronomica San Joaquin s.a.', NULL, NULL, NULL, NULL, NULL, 'info@tiendas-naturales.com.ar', 'Cabello 3401');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(80, 'Gastronomica San Joaquin s.a.', 'Tiendas Naturales Gutierrez', 'Gastronomica San Joaquin s.a.', NULL, NULL, NULL, NULL, NULL, '', 'Juan Maria Gutierrez 3785');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(81, ' ', 'Tilo Cañitas', 'Tilo Cañitas', NULL, NULL, NULL, NULL, NULL, 'rodrirey@hotmail.com', 'Soldado de la Independencia 1009');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(82, ' ', 'Tilo Martínez', 'Tilo Martínez', NULL, NULL, NULL, NULL, NULL, 'rodrirey@hotmail.com', 'Gral. Alvear 199');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(83, ' ', 'Tilo Recoleta', 'Tilo Recoleta', NULL, NULL, NULL, NULL, NULL, 'rodrirey@hotmail.com', 'Billinghurst 2099');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(84, 'Tostado buenos aires srl', 'Tostado Cordoba', 'Tostado buenos aires srl', NULL, NULL, NULL, NULL, NULL, '', 'Cordoba 1501');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(85, 'Tostado café oeste srl', 'Tostado Ituzaingo', 'Tostado café oeste srl', NULL, NULL, NULL, NULL, NULL, 'cdevalenzuela@tostadocafeclub.com', 'Juncal 191');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(86, 'Tostado buenos aires srl', 'Tostado Juramento', 'Tostado buenos aires srl', NULL, NULL, NULL, NULL, NULL, '', 'Juramento 2101');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(87, 'Tostado buenos aires srl', 'Tostado Santa Fe', 'Tostado buenos aires srl', NULL, NULL, NULL, NULL, NULL, '', ' ');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(88, 'Benfur srl', 'Trevi', 'Benfur srl', NULL, NULL, NULL, NULL, NULL, '', 'Mitre 383, Capilla del señor');
INSERT INTO comandas.cliente
(id, razon_social, nombre, apellido, usuario_web, password_web, web_customer_id, maxirest_id, ultima_modificacion, email, direccion)
VALUES(89, 'karina abigail canete', 'Winna Café', 'karina abigail canete', NULL, NULL, NULL, NULL, NULL, 'winnacafe@gmail.com', 'Av. Congreso 5082');
      ";

        $this->execute($clients);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_133211_clientes_produccion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_133211_clientes_produccion cannot be reverted.\n";

        return false;
    }
    */
}
