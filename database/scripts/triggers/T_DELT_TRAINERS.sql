delimiter //
 create trigger after_delete_trainer
	after delete on tb_entrenadores
   for each row
 begin
 
declare codigo int default 0;
declare codigousuario int default 0;
declare tabla varchar(50) default " ";
declare dato varchar(500) default " ";
declare fecha datetime;
 
 set codigo = old.id_entrenadores;
 set codigousuario = old.idtb_usuarios;
 set tabla = 'tb_entrenadores';
 set dato = concat(old.nombre,' ',old.apellido,' ',old.cedula); 
 set fecha = now();
 
 INSERT INTO auditoria_actions(id_usuario,accion,fecha_hora,tabla_afectada,dato,id_registro) 
  values (codigousuario,"Borrado",fecha,tabla,dato,codigo);
 
 
 end ;