-- INICIO DE LA MIGRACION


INSERT IGNORE INTO `permiso` (`tipo`, `codename`, `nombre`) VALUES
('lector_qr', 'run_lector_qr', 'Ejecutar Lector de QR');

INSERT INTO
    `migraciones` (
        `tipo`,
        `nombre`,
        `descripcion`,
        `archivo`
    )
VALUES (
        'DML',
        'Permisos de Lector de QR',
        'Agrega los permisos del sistema para el modulo de lector de QR',
        'mig_016_dml_permisos_lector_qr.sql'
    );

-- FIN DE LA MIGRACION