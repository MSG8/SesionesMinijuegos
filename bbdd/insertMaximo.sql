USE sesiones_minijuegos;

INSERT INTO Usuarios(correo, contrasenia)
VALUES 
    ('luis@fundacionloyola.net', '1234'),
    ('esperanza@fundacionloyola.net', '0000'),
    ('juanjo@fundacionloyola.net', 'contraseña'),
    ('lucia@fundacionloyola.net', 'no entres');

INSERT INTO Minijuegos(nombre, url)
VALUES 
    ('Multiplos', 'http://localhost/dwec/multiplos/'),
    ('Quimica', 'http://localhost/dwec/quimica/'),
    ('Basura', 'http://localhost/dwec/basura/'),
    ('Fichas', 'http://localhost/dwec/fichas/');

INSERT INTO Preferencia
VALUES 
    (1,1),
    (1,3),
    (1,2),
    (2,2),
    (2,4),
    (3,1),
    (4,2),
    (4,4);