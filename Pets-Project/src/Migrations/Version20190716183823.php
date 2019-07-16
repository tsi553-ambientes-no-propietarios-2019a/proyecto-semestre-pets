<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716183823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, usuario VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, celular VARCHAR(10) NOT NULL, telefono VARCHAR(10) NOT NULL, direccion VARCHAR(255) NOT NULL, estado_cli INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mascota (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, age SMALLINT NOT NULL, raza VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicio (id INT AUTO_INCREMENT NOT NULL, servicio_paquete_id INT NOT NULL, pago_cliente_id INT NOT NULL, hora_inicio DATETIME NOT NULL, hora_fin DATETIME NOT NULL, INDEX IDX_CB86F22A60A08C55 (servicio_paquete_id), INDEX IDX_CB86F22A3FA497AE (pago_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paquete (id INT AUTO_INCREMENT NOT NULL, anfitrion_id INT NOT NULL, tipo_masc VARCHAR(255) NOT NULL, alimento VARCHAR(255) NOT NULL, aseo_masc VARCHAR(255) NOT NULL, precio VARCHAR(255) NOT NULL, INDEX IDX_12686A95C334648A (anfitrion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A60A08C55 FOREIGN KEY (servicio_paquete_id) REFERENCES paquete (id)');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A3FA497AE FOREIGN KEY (pago_cliente_id) REFERENCES pago_cliente (id)');
        $this->addSql('ALTER TABLE paquete ADD CONSTRAINT FK_12686A95C334648A FOREIGN KEY (anfitrion_id) REFERENCES anfitrion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A60A08C55');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE mascota');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('DROP TABLE paquete');
    }
}
