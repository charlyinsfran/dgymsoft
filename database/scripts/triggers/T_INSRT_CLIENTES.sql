delimiter //
 create trigger after_insert_clientes
	after INSERT on tb_clientes
   for each row
 begin
 
declare codigo int default 0;
declare codigousuario int default 0;
declare tabla varchar(50) default " ";
declare dato varchar(300) default " ";
declare fecha datetime;
 
 set codigo = new.id_clientes;
 set codigousuario = new.id_usuarios;
 set tabla = 'tb_clientes';
 set dato = concat('dato: ',new.nombre,' ',new.apellido,' C.I.N° ',new.cedula,' Tel: ',new.telefono); 
 set fecha = now();
 
 INSERT INTO auditoria_actions(id_usuario,accion,fecha_hora,tabla_afectada,dato,id_registro) 
  values (codigousuario,"INSERCION DATA",fecha,tabla,dato,codigo);
 
 
 end ;