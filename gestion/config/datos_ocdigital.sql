

-- ------------------------------------------
-- insert acciones para el rol gerente
-- ------------------------------------------

INSERT INTO auth_item (name,type)  values('Gerente',1);

INSERT INTO `auth_item_child` VALUES
 ('Gerente','/*');




-- gerente!
INSERT INTO `ocdigital`.`user`
(
`username`,
`password_hash`,
`status`
 )
VALUES
("Gerente",
 "$2y$10$EjA67mbBoEWTypjOsIPXa.t2jMMM9SLjVNECL3cq/iR.l2CcZfJdC"
 ,1);

INSERT INTO `ocdigital`.`auth_assignment`
(`item_name`,
`user_id`)
VALUES
("Gerente",
9);


-- ------------------------------------------
-- insert acciones para el rol Logistica
-- ------------------------------------------
insert into auth_item(name,type) values ('Logistica',1);

INSERT INTO `auth_item_child` VALUES
 ('Logistica','/*');


-- logistica!321
INSERT INTO `ocdigital`.`user`
(
`username`,
`password_hash`,
`status`
 )
VALUES
("Logistica",
 "$2y$10$TrkjYze3CA7cus5Mr3F1F.OfkFm5/l76TD4uOZMeN/kBmv2cvUUry"
 ,1);

INSERT INTO `ocdigital`.`auth_assignment`
(`item_name`,
`user_id`)
VALUES
("Logistica",
10);



