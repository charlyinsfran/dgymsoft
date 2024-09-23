delimiter //
 create trigger after_delete_rutinas
	after DELETE on tb_rutina
   for each row
 begin
 
declare codigo int default 0;
declare codigousuario int default 0;
declare tabla varchar(20) default " ";
declare dato varchar(50) default " ";
declare fecha datetime;
 
 set codigo = OLD.id_rutina;
 set codigousuario = OLD.idusuario;
 set tabla = 'tb_rutina';
 set dato = concat('dato: ',OLD.descripcion); 
 set fecha = now();
 
 INSERT INTO auditoria_actions(id_usuario,accion,fecha_hora,tabla_afectada,dato,id_registro) 
  values (codigousuario,"BORRADO",fecha,tabla,dato,codigo);
 
 
 end ;