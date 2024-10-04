-- Crear Base de datos
Create database medifast;

-- Tabla t_usuarios
CREATE TABLE t_usuarios (
    ID_usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_usuario VARCHAR(255) NOT NULL,
    Email_usuario VARCHAR(255) UNIQUE NOT NULL,
    Password_usuario VARCHAR(255) NOT NULL,
    Rol_usuario ENUM('sysadmin', 'Gerencia', 'Administrador') NOT NULL,
    Telefono_usuario BIGINT NOT NULL
);

-- Tabla t_medico
CREATE TABLE t_medico (
    medico_id INT AUTO_INCREMENT PRIMARY KEY,
    especialidad VARCHAR(30) NOT NULL,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES t_usuarios(ID_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_paciente
CREATE TABLE t_paciente (
    paciente_id INT AUTO_INCREMENT PRIMARY KEY,
    estado TINYINT(1) NOT NULL,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES t_usuarios(ID_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_cita
CREATE TABLE t_cita (
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado VARCHAR(15) NOT NULL,
    paciente_id INT,
    medico_id INT,
    FOREIGN KEY (paciente_id) REFERENCES t_paciente(paciente_id) ON DELETE CASCADE,
    FOREIGN KEY (medico_id) REFERENCES t_medico(medico_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_historia_clinica
CREATE TABLE t_historia_clinica (
    historia_clinica_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT,
    FOREIGN KEY (paciente_id) REFERENCES t_paciente(paciente_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_diagnostico
CREATE TABLE t_diagnostico (
    diagnostico_id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    tipo VARCHAR(15),
    resultado VARCHAR(80),
    descripcion VARCHAR(80),
    historia_clinica_id INT,
    FOREIGN KEY (historia_clinica_id) REFERENCES t_historia_clinica(historia_clinica_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_medicamento
CREATE TABLE t_medicamento (
    medicamento_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    dosis VARCHAR(15),
    tipo VARCHAR(30),
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL
) ENGINE=InnoDB;

-- Tabla t_autorizacion_medicamento
CREATE TABLE t_autorizacion_medicamento (
    autorizacion_medicamento_id INT AUTO_INCREMENT PRIMARY KEY,
    estado TINYINT(1) NOT NULL,
    fecha_solicitud DATE NOT NULL,
    paciente_id INT,
    medicamento_id INT,
    FOREIGN KEY (paciente_id) REFERENCES t_paciente(paciente_id) ON DELETE CASCADE,
    FOREIGN KEY (medicamento_id) REFERENCES t_medicamento(medicamento_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla t_mensaje
CREATE TABLE t_mensaje (
    mensaje_id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(500),
    fecha DATETIME NOT NULL,
    medico_id INT,
    paciente_id INT,
    FOREIGN KEY (medico_id) REFERENCES t_medico(medico_id) ON DELETE CASCADE,
    FOREIGN KEY (paciente_id) REFERENCES t_paciente(paciente_id) ON DELETE CASCADE
) ENGINE=InnoDB;


-- Crear los usuarios Administrador del sistema y Gerencia
INSERT INTO t_usuarios (Nombre_usuario, Email_usuario, Password_usuario, Rol_usuario, Telefono_usuario) 
VALUES 
    ('sysadmin', 'correo1@example.com', 'contraseña', 'sysadmin', 5551111111),
    ('Gerencia', 'correo2@example.com', '123456789', 'Gerencia', 5552222222),
    ('Administrador', 'correo3@example.com', '12345', 'Administrador', 5553333333),
    ('prueba', 'prueba@example.com', 'pepito', 'Administrador', 5551111111);

-- Insertar datos en t_usuarios
INSERT INTO t_usuarios (Nombre_usuario, Email_usuario, Password_usuario, Rol_usuario, Telefono_usuario) VALUES
('Juan Pérez', 'juan.perez@mail.com', 'password123', 'Administrador', 3001234567),
('María López', 'maria.lopez@mail.com', 'securepass', 'Gerencia', 3017654321),
('Pedro Gómez', 'pedro.gomez@mail.com', 'mypassword', 'sysadmin', 3123456789),
('Laura Martínez', 'laura.martinez@mail.com', 'laura123', 'Administrador', 3009876543),
('Carlos Rodríguez', 'carlos.rodriguez@mail.com', 'carpass987', 'Gerencia', 3112345678),
('Ana García', 'ana.garcia@mail.com', 'garcia123', 'sysadmin', 3108765432),
('Roberto Torres', 'roberto.torres@mail.com', 'torrespwd', 'Administrador', 3137654321),
('Sofía Morales', 'sofia.morales@mail.com', 'sofia789', 'Gerencia', 3201234567),
('Jorge Castro', 'jorge.castro@mail.com', 'jorge1234', 'sysadmin', 3126549870),
('Elena Vega', 'elena.vega@mail.com', 'elena567', 'Administrador', 3009988776);

-- Insertar datos en t_medico
INSERT INTO t_medico (especialidad, id_usuario) VALUES
('Cardiología', 1),
('Dermatología', 2),
('Pediatría', 3),
('Ginecología', 4),
('Oncología', 5),
('Neurología', 6),
('Oftalmología', 7),
('Traumatología', 8),
('Psiquiatría', 9),
('Urología', 10);

-- Insertar datos en t_paciente
INSERT INTO t_paciente (estado, id_usuario) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10);

-- Insertar datos en t_cita
INSERT INTO t_cita (fecha, hora, estado, paciente_id, medico_id) VALUES
('2024-10-01', '09:00:00', 'Pendiente', 1, 1),
('2024-10-01', '10:30:00', 'Confirmada', 2, 2),
('2024-10-02', '11:00:00', 'Pendiente', 3, 3),
('2024-10-03', '08:30:00', 'Cancelada', 4, 4),
('2024-10-04', '14:00:00', 'Confirmada', 5, 5),
('2024-10-05', '16:00:00', 'Pendiente', 6, 6),
('2024-10-06', '12:00:00', 'Confirmada', 7, 7),
('2024-10-07', '13:00:00', 'Pendiente', 8, 8),
('2024-10-08', '15:00:00', 'Confirmada', 9, 9),
('2024-10-09', '17:00:00', 'Pendiente', 10, 10);

-- Insertar datos en t_historia_clinica
INSERT INTO t_historia_clinica (paciente_id) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- Insertar datos en t_diagnostico
INSERT INTO t_diagnostico (fecha, tipo, resultado, descripcion, historia_clinica_id) VALUES
('2024-09-15', 'Radiografía', 'Normal', 'Radiografía de tórax normal', 1),
('2024-09-16', 'Ecografía', 'Anormal', 'Inflamación en el abdomen', 2),
('2024-09-17', 'Tomografía', 'Normal', 'Tomografía cerebral normal', 3),
('2024-09-18', 'Análisis de sangre', 'Anormal', 'Niveles altos de glucosa', 4),
('2024-09-19', 'Resonancia magnética', 'Normal', 'Resonancia de columna normal', 5),
('2024-09-20', 'Ecocardiograma', 'Anormal', 'Soplo cardíaco detectado', 6),
('2024-09-21', 'Mamografía', 'Normal', 'Mamografía sin hallazgos', 7),
('2024-09-22', 'Electrocardiograma', 'Normal', 'Electrocardiograma sin alteraciones', 8),
('2024-09-23', 'Colonoscopia', 'Anormal', 'Pólipos detectados en el colon', 9),
('2024-09-24', 'Prueba de esfuerzo', 'Normal', 'Prueba de esfuerzo sin complicaciones', 10);

-- Insertar datos en t_medicamento
INSERT INTO t_medicamento (nombre, dosis, tipo, fecha_inicio, fecha_fin) VALUES
('Paracetamol', '500mg', 'Analgésico', '2024-09-01', '2024-09-10'),
('Ibuprofeno', '200mg', 'Antiinflamatorio', '2024-09-05', '2024-09-15'),
('Amoxicilina', '500mg', 'Antibiótico', '2024-09-10', '2024-09-20'),
('Metformina', '850mg', 'Antidiabético', '2024-09-12', '2024-09-22'),
('Atorvastatina', '10mg', 'Hipolipemiante', '2024-09-15', '2024-09-25'),
('Omeprazol', '20mg', 'Antiácido', '2024-09-18', '2024-09-28'),
('Losartán', '50mg', 'Antihipertensivo', '2024-09-20', '2024-09-30'),
('Salbutamol', '100mcg', 'Broncodilatador', '2024-09-22', '2024-09-30'),
('Levotiroxina', '50mcg', 'Hormona tiroidea', '2024-09-25', '2024-10-05'),
('Furosemida', '40mg', 'Diurético', '2024-09-28', '2024-10-08');

-- Insertar datos en t_autorizacion_medicamento
INSERT INTO t_autorizacion_medicamento (estado, fecha_solicitud, paciente_id, medicamento_id) VALUES
(1, '2024-09-01', 1, 1),
(1, '2024-09-05', 2, 2),
(0, '2024-09-10', 3, 3),
(1, '2024-09-12', 4, 4),
(0, '2024-09-15', 5, 5),
(1, '2024-09-18', 6, 6),
(1, '2024-09-20', 7, 7),
(0, '2024-09-22', 8, 8),
(1, '2024-09-25', 9, 9),
(1, '2024-09-28', 10, 10);

-- Insertar datos en t_mensaje
INSERT INTO t_mensaje (descripcion, fecha, medico_id, paciente_id) VALUES
('Paciente reporta mejoría después del tratamiento', '2024-09-10 09:00:00', 1, 1),
('Paciente solicita información sobre su diagnóstico', '2024-09-11 10:30:00', 2, 2),
('Paciente se queja de efectos secundarios', '2024-09-12 11:00:00', 3, 3),
('Consulta sobre próxima cita médica', '2024-09-13 08:30:00', 4, 4),
('Resultados de exámenes disponibles para revisión', '2024-09-14 14:00:00', 5, 5),
('Solicita cambio de medicamento por alergia', '2024-09-15 16:00:00', 6, 6),
('Paciente reporta molestias recurrentes', '2024-09-16 12:00:00', 7, 7),
('Consulta sobre tratamiento recomendado', '2024-09-17 13:00:00', 8, 8),
('Revisión de exámenes adicionales solicitados', '2024-09-18 15:00:00', 9, 9),
('Paciente informa sobre resultados positivos del tratamiento', '2024-09-19 17:00:00', 10, 10);
