SELECT * FROM (
SELECT tb.nombre, tb.tipodoc, tb.documento, tb.sexo, tb.cuil, tb.fnacimiento, domicilio, iddist, iddept, idprovin, idnacion, codpostal FROM
(SELECT nombre, tipodoc, documento, sexo, cuil, fnacimiento FROM personas.fisica where nombre like 'PEREZ%JULIA%') as tb
Inner Join
ubicacion.vinculo
on
tb.documento = vinculo.documento) as tb1
Inner Join
ubicacion.distritos
on
tb1.iddist = distritos.id
where iddist = 894