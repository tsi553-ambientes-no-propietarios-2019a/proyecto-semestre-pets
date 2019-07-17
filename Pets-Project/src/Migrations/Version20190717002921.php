<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717002921 extends AbstractMigration
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
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77FB60C59E');
        $this->addSql('DROP INDEX IDX_11298D77FB60C59E ON mascota');
        $this->addSql('ALTER TABLE mascota CHANGE mascota_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_11298D77A76ED395 ON mascota (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE usuario');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77A76ED395');
        $this->addSql('DROP INDEX IDX_11298D77A76ED395 ON mascota');
        $this->addSql('ALTER TABLE mascota CHANGE user_id mascota_id INT NOT NULL');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77FB60C59E FOREIGN KEY (mascota_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_11298D77FB60C59E ON mascota (mascota_id)');
    }
}
