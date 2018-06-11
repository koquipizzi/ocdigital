-- ------------------------
--  trigger codigo pedido
--  -----------------------
-- DROP TRIGGER tu_codigo_nombre_producto;
DELIMITER ;;
CREATE TRIGGER tu_codigo_nombre_producto
    BEFORE UPDATE ON producto
    FOR EACH ROW
BEGIN
    SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-',NEW.nombre) ;
END;;

-- DROP trigger ti_codigo_nombre_producto;
DELIMITER ;;
CREATE  TRIGGER ti_codigo_nombre_producto
    BEFORE INSERT ON producto
    FOR EACH ROW
BEGIN
      SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-', NEW.nombre);
END;;