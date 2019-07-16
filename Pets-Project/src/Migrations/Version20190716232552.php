<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716232552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mascota (id INT AUTO_INCREMENT NOT NULL, mascota_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, age SMALLINT NOT NULL, raza VARCHAR(255) NOT NULL, INDEX IDX_11298D77FB60C59E (mascota_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicio (id INT AUTO_INCREMENT NOT NULL, servicio_paquete_id INT NOT NULL, pago_cliente_id INT NOT NULL, hora_inicio DATETIME NOT NULL, hora_fin DATETIME NOT NULL, INDEX IDX_CB86F22A60A08C55 (servicio_paquete_id), INDEX IDX_CB86F22A3FA497AE (pago_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, usuario VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, celular VARCHAR(10) NOT NULL, telefono VARCHAR(10) NOT NULL, direccion VARCHAR(255) NOT NULL, estado_cli INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cobro_anf (id INT AUTO_INCREMENT NOT NULL, id_transaccion_id INT NOT NULL, comision VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4E5936E5B0DFD449 (id_transaccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago_cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(25) NOT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anfitrion (id INT AUTO_INCREMENT NOT NULL, id_anfitrion_id INT NOT NULL, anfitrion_id INT NOT NULL, cuenta VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6DE0F10DE0F511F8 (id_anfitrion_id), UNIQUE INDEX UNIQ_6DE0F10DC334648A (anfitrion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paquete (id INT AUTO_INCREMENT NOT NULL, anfitrion_id INT NOT NULL, tipo_masc VARCHAR(255) NOT NULL, alimento VARCHAR(255) NOT NULL, aseo_masc VARCHAR(255) NOT NULL, precio VARCHAR(255) NOT NULL, INDEX IDX_12686A95C334648A (anfitrion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicios (id INT AUTO_INCREMENT NOT NULL, servicio_id INT NOT NULL, INDEX IDX_C07E802F71CAA3E7 (servicio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mascotas (id INT AUTO_INCREMENT NOT NULL, mascota_id INT NOT NULL, INDEX IDX_D57E0219FB60C59E (mascota_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaccion (id INT AUTO_INCREMENT NOT NULL, transaccion_id INT NOT NULL, producto VARCHAR(255) NOT NULL, monto INT NOT NULL, divisa VARCHAR(10) NOT NULL, estado VARCHAR(100) NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_BFF96AF78DB9694F (transaccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77FB60C59E FOREIGN KEY (mascota_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A60A08C55 FOREIGN KEY (servicio_paquete_id) REFERENCES paquete (id)');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A3FA497AE FOREIGN KEY (pago_cliente_id) REFERENCES pago_cliente (id)');
        $this->addSql('ALTER TABLE cobro_anf ADD CONSTRAINT FK_4E5936E5B0DFD449 FOREIGN KEY (id_transaccion_id) REFERENCES transaccion (id)');
        $this->addSql('ALTER TABLE anfitrion ADD CONSTRAINT FK_6DE0F10DE0F511F8 FOREIGN KEY (id_anfitrion_id) REFERENCES cobro_anf (id)');
        $this->addSql('ALTER TABLE anfitrion ADD CONSTRAINT FK_6DE0F10DC334648A FOREIGN KEY (anfitrion_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE paquete ADD CONSTRAINT FK_12686A95C334648A FOREIGN KEY (anfitrion_id) REFERENCES anfitrion (id)');
        $this->addSql('ALTER TABLE servicios ADD CONSTRAINT FK_C07E802F71CAA3E7 FOREIGN KEY (servicio_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE mascotas ADD CONSTRAINT FK_D57E0219FB60C59E FOREIGN KEY (mascota_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE transaccion ADD CONSTRAINT FK_BFF96AF78DB9694F FOREIGN KEY (transaccion_id) REFERENCES pago_cliente (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anfitrion DROP FOREIGN KEY FK_6DE0F10DE0F511F8');
        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A3FA497AE');
        $this->addSql('ALTER TABLE transaccion DROP FOREIGN KEY FK_BFF96AF78DB9694F');
        $this->addSql('ALTER TABLE paquete DROP FOREIGN KEY FK_12686A95C334648A');
        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A60A08C55');
        $this->addSql('ALTER TABLE cobro_anf DROP FOREIGN KEY FK_4E5936E5B0DFD449');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77FB60C59E');
        $this->addSql('ALTER TABLE anfitrion DROP FOREIGN KEY FK_6DE0F10DC334648A');
        $this->addSql('ALTER TABLE servicios DROP FOREIGN KEY FK_C07E802F71CAA3E7');
        $this->addSql('ALTER TABLE mascotas DROP FOREIGN KEY FK_D57E0219FB60C59E');
        $this->addSql('DROP TABLE mascota');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE cobro_anf');
        $this->addSql('DROP TABLE pago_cliente');
        $this->addSql('DROP TABLE anfitrion');
        $this->addSql('DROP TABLE paquete');
        $this->addSql('DROP TABLE servicios');
        $this->addSql('DROP TABLE mascotas');
        $this->addSql('DROP TABLE transaccion');
        $this->addSql('DROP TABLE fos_user');
    }
}
