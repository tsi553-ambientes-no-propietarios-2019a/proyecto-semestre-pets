<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709162210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE servicio (id INT AUTO_INCREMENT NOT NULL, servicio_paquete_id INT NOT NULL, hora_inicio DATETIME NOT NULL, hora_fin DATETIME NOT NULL, INDEX IDX_CB86F22A60A08C55 (servicio_paquete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paquete (id INT AUTO_INCREMENT NOT NULL, tipo_masc VARCHAR(255) NOT NULL, alimento VARCHAR(255) NOT NULL, aseo_masc VARCHAR(255) NOT NULL, precio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaccion (id INT AUTO_INCREMENT NOT NULL, transaccion_id INT NOT NULL, producto VARCHAR(255) NOT NULL, monto INT NOT NULL, divisa VARCHAR(10) NOT NULL, estado VARCHAR(100) NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_BFF96AF78DB9694F (transaccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A60A08C55 FOREIGN KEY (servicio_paquete_id) REFERENCES paquete (id)');
        $this->addSql('ALTER TABLE transaccion ADD CONSTRAINT FK_BFF96AF78DB9694F FOREIGN KEY (transaccion_id) REFERENCES pago_cliente (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A60A08C55');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('DROP TABLE paquete');
        $this->addSql('DROP TABLE transaccion');
    }
}
