delimiter //
 create trigger after_update_trainer
	after update on tb_entrenadores
   for each row
 begin
 
declare codigo int default 0;
declare codigousuario int default 0;
declare tabla varchar(50) default " ";
declare dato varchar(500) default " ";
declare fecha datetime;
 
 set codigo = new.id_entrenadores;
 set codigousuario = new.idtb_usuarios;
 set tabla = 'tb_entrenadores';
 set dato = concat(new.nombre,' ',new.apellido,' ',new.cedula); 
 set fecha = now();
 
 INSERT INTO auditoria_actions(id_usuario,accion,fecha_hora,tabla_afectada,dato,id_registro) 
  values (codigousuario,"MODIFICACION",fecha,tabla,dato,codigo);
 
 
 end ;