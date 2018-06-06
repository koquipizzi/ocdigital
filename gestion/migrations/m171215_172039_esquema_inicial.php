<?php

use yii\db\Migration;

class m171215_172039_esquema_inicial extends Migration
{
    public function safeUp()
    {
        $this->execute("

            -- -----------------------------------------------------
            -- Table `cliente`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `cliente` ;

            CREATE TABLE IF NOT EXISTS `cliente` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `razon_social` VARCHAR(255) NULL,
              `nombre` VARCHAR(255) NOT NULL,
              `apellido` VARCHAR(255) NOT NULL,
              `usuario_web` VARCHAR(45) NULL,
              `password_web` VARCHAR(45) NULL,
              `web_customer_id` INT DEFAULT NULL,
              `maxirest_id` INT DEFAULT NULL,
              `ultima_modificacion` DATETIME DEFAULT NULL,
              `email` VARCHAR(255) NOT NULL,
              `direccion` VARCHAR(255) NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB;

            -- ----------------------------------------------------
            -- Table `log`
            -- ----------------------------------------------------
            DROP TABLE IF EXISTS `log` ;

            CREATE TABLE IF NOT EXISTS `log` (
                `ptime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `cont` INT NOT NULL,
                `pid` INT NOT NULL)
               ENGINE = InnoDB;

            -- ----------------------------------------------------
            -- Table `mail`
            -- ----------------------------------------------------
            DROP TABLE IF EXISTS `mail` ;

            CREATE TABLE `mail` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `accion` VARCHAR(45) NULL,
                `mails` VARCHAR(255) NULL,
                PRIMARY KEY (`id`))
            ENGINE = InnoDB;

            INSERT INTO comandas.mail
            (id, accion, mails)
            VALUES(1, 'Error de sincronización', 'alejandra@qwavee.com;faller@qwavee.com;hola@qwavee.com');


            -- -----------------------------------------------------
            -- Table `comanda`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `comanda` ;

            CREATE TABLE IF NOT EXISTS `comanda` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `fecha_produccion` DATETIME DEFAULT CURRENT_TIMESTAMP,
              `nota` BLOB NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB;


            -- -----------------------------------------------------
            -- Table `pedido`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `pedido` ;

            CREATE TABLE IF NOT EXISTS `pedido` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
              `fecha_produccion` DATETIME NULL,
              `fecha_entrega` DATETIME NULL,
              `web_id` INT NULL,
              `cliente_id` INT NOT NULL,
              `comanda_id` INT DEFAULT NULL,
              `precio_total` DECIMAL(8,2) NULL,
              `ship_company` VARCHAR(255) DEFAULT NULL,
              `ship_address_1` VARCHAR(255) DEFAULT NULL,
              `ship_address_2` VARCHAR(255) DEFAULT NULL,
              `ship_city` VARCHAR(255) DEFAULT NULL,
              `ship_state` VARCHAR(255) DEFAULT NULL,
              `ship_postcode` VARCHAR(255) DEFAULT NULL,
              `ship_country` VARCHAR(255) DEFAULT NULL,
              `estado` VARCHAR(100) NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_pedido_cliente1`
                FOREIGN KEY (`cliente_id`)
                REFERENCES `cliente` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_pedido_comanda1`
                FOREIGN KEY (`comanda_id`)
                REFERENCES `comanda` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_pedido_cliente1_idx` ON `pedido` (`cliente_id` ASC);

            CREATE INDEX `fk_pedido_comanda1_idx` ON `pedido` (`comanda_id` ASC);


            -- -----------------------------------------------------
            -- Table `rol`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `rol` ;

            CREATE TABLE IF NOT EXISTS `rol` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `nombre` VARCHAR(45) NULL,
              `defecto` int(11) DEFAULT 0,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB;


            -- -----------------------------------------------------
            -- Table `categoria`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `categoria` ;

            CREATE TABLE IF NOT EXISTS `categoria` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `nombre` VARCHAR(45) NULL,
              `web_id` INT(11) NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB;


            -- -----------------------------------------------------
            -- Table `producto`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `producto` ;

            CREATE TABLE IF NOT EXISTS `producto` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `nombre` VARCHAR(255) NULL,
              `categoria_id` INT NOT NULL,
              `precio_unitario` DECIMAL(8,2) NULL,
              `web_id` INT,
              `maxirest_id` INT,
              `ultima_modificacion` DATETIME DEFAULT NULL,
              `baja_logica` INT DEFAULT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_producto_categoria1`
                FOREIGN KEY (`categoria_id`)
                REFERENCES `categoria` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_producto_categoria1_idx` ON `producto` (`categoria_id` ASC);


            -- -----------------------------------------------------
            -- Table `producto_rol`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `producto_rol` ;

            CREATE TABLE IF NOT EXISTS `producto_rol` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `producto_id` INT NOT NULL,
              `rol_id` INT NOT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_producto_rol_rol`
                FOREIGN KEY (`rol_id`)
                REFERENCES `rol` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_producto_rol_producto`
                FOREIGN KEY (`producto_id`)
                REFERENCES `producto` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_producto_rol_rol_idx` ON `producto_rol` (`rol_id` ASC);

            CREATE INDEX `fk_producto_rol_producto_idx` ON `producto_rol` (`producto_id` ASC);

            -- -----------------------------------------------------
            -- Table `pedido_detalle`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `pedido_detalle` ;

            CREATE TABLE IF NOT EXISTS `pedido_detalle` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `pedido_id` INT NOT NULL,
              `producto_id` INT NOT NULL,
              `cantidad` INT NULL,
              `precio_linea` DECIMAL(8,2) NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_pedido_detalle_pedido1`
                FOREIGN KEY (`pedido_id`)
                REFERENCES `pedido` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_pedido_detalle_producto1`
                FOREIGN KEY (`producto_id`)
                REFERENCES `producto` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_pedido_detalle_pedido1_idx` ON `pedido_detalle` (`pedido_id` ASC);

            CREATE INDEX `fk_pedido_detalle_producto1_idx` ON `pedido_detalle` (`producto_id` ASC);


            -- -----------------------------------------------------
            -- Table `comanda_detalle`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `comanda_detalle` ;

            CREATE TABLE IF NOT EXISTS `comanda_detalle` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `cantidad_produccion` INT NULL,
              `comanda_id` INT NOT NULL,
              `producto_id` INT NOT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_comanda_detalle_comanda1`
                FOREIGN KEY (`comanda_id`)
                REFERENCES `comanda` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_comanda_detalle_producto1`
                FOREIGN KEY (`producto_id`)
                REFERENCES `producto` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_comanda_detalle_comanda1_idx` ON `comanda_detalle` (`comanda_id` ASC);

            CREATE INDEX `fk_comanda_detalle_producto1_idx` ON `comanda_detalle` (`producto_id` ASC);


            -- -----------------------------------------------------
            -- Table `cliente_rol`
            -- -----------------------------------------------------
            DROP TABLE IF EXISTS `cliente_rol` ;

            CREATE TABLE IF NOT EXISTS `cliente_rol` (
              `cliente_id` INT NOT NULL,
              `rol_id` INT NOT NULL,
              PRIMARY KEY (`cliente_id`, `rol_id`),
              CONSTRAINT `fk_cliente_has_rol_cliente1`
                FOREIGN KEY (`cliente_id`)
                REFERENCES `cliente` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_cliente_has_rol_rol1`
                FOREIGN KEY (`rol_id`)
                REFERENCES `rol` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE INDEX `fk_cliente_has_rol_rol1_idx` ON `cliente_rol` (`rol_id` ASC);

            CREATE INDEX `fk_cliente_has_rol_cliente1_idx` ON `cliente_rol` (`cliente_id` ASC);

            -- -----------------------------------------------------
            -- Data for table `categoria`
            -- -----------------------------------------------------
            INSERT INTO `categoria` (`id`, `nombre`,web_id) VALUES (1, 'Pastelería Fría',24);
            INSERT INTO `categoria` (`id`, `nombre`,web_id) VALUES (2, 'Pastelería Seca',25);
            INSERT INTO `categoria` (`id`, `nombre`,web_id) VALUES (3, 'Viennoiserie',23);
            INSERT INTO `categoria` (`id`, `nombre`,`web_id`) VALUES (4, 'Panadería',22);
            INSERT INTO `categoria` (`id`, `nombre`,`web_id`) VALUES (5, 'Salado',26);

            INSERT INTO `rol` (`id`, `nombre`, `defecto`) VALUES (0, 'customer', 1);
            INSERT INTO `rol` (`id`, `nombre`, `defecto`) VALUES (1, 'hidden', 0);

            COMMIT;
        ");
        $this->execute("
            DROP TRIGGER IF EXISTS ins_cliente;
            DROP TRIGGER IF EXISTS ins_rol;
            DROP TRIGGER IF EXISTS upd_rol;
            DROP TRIGGER IF EXISTS upd_rol_restriccion_solo_1_defecto;
            DROP TRIGGER IF EXISTS ins_rol_restriccion_solo_1_defecto;
        ");
        $this->execute("
            CREATE TRIGGER ins_cliente
            AFTER INSERT ON `cliente`
            FOR EACH ROW
            BEGIN
                    DECLARE rol_id INT(11);
                SET @rol_id := (SELECT ID FROM `rol` WHERE `defecto` = 1 LIMIT 1);
                IF (@rol_id IS NOT NULL) THEN
                            INSERT INTO `cliente_rol`(`cliente_id`, `rol_id`) VALUES(NEW.id,@rol_id);
                END IF;
            END
        ");
        $this->execute("
            CREATE TRIGGER upd_rol
            BEFORE UPDATE ON `rol`
            FOR EACH ROW
            SET
                NEW.defecto = IFNULL(NEW.defecto,0);
        ");
        $this->execute("
            CREATE TRIGGER ins_rol
            BEFORE INSERT ON `rol`
            FOR EACH ROW
            SET
                NEW.defecto = IFNULL(NEW.defecto,0);
        ");
        $this->execute("
            CREATE TRIGGER ins_rol_restriccion_solo_1_defecto
            AFTER INSERT ON `rol`
            FOR EACH ROW
            BEGIN
                DECLARE cant INT(11);
                SET @cant := (SELECT count(*) FROM `rol` WHERE `defecto` = 1);
                IF (@cant>1) THEN
                    SIGNAL SQLSTATE 'ERR0R' SET MESSAGE_TEXT = 'SOLO UN ROL PUEDE CONSIDERARSE COMO DEFAULT';
                END IF;
            END
        ");
        $this->execute("
            CREATE TRIGGER upd_rol_restriccion_solo_1_defecto
            AFTER UPDATE ON `rol`
            FOR EACH ROW
            BEGIN
                DECLARE cant INT(11);
                SET @cant := (SELECT count(*) FROM `rol` WHERE `defecto` = 1);
                IF (@cant>1) THEN
                    SIGNAL SQLSTATE 'ERR0R' SET MESSAGE_TEXT = 'SOLO UN ROL PUEDE CONSIDERARSE COMO DEFAULT';
                END IF;
            END
        ");
    }

    public function safeDown()
    {
        echo "m171215_172039_esquema_inicial cannot be reverted.\n";
        $this->execute("
            DROP TRIGGER IF EXISTS ins_cliente;
            DROP TRIGGER IF EXISTS ins_rol;
            DROP TRIGGER IF EXISTS upd_rol;
        ");

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_172039_esquema_inicial cannot be reverted.\n";

        return false;
    }
    */
}
