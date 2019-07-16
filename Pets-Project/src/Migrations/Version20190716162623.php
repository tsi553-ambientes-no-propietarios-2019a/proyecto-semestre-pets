<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716162623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paquete ADD anfitrion_id INT NOT NULL');
        $this->addSql('ALTER TABLE paquete ADD CONSTRAINT FK_12686A95C334648A FOREIGN KEY (anfitrion_id) REFERENCES anfitrion (id)');
        $this->addSql('CREATE INDEX IDX_12686A95C334648A ON paquete (anfitrion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paquete DROP FOREIGN KEY FK_12686A95C334648A');
        $this->addSql('DROP INDEX IDX_12686A95C334648A ON paquete');
        $this->addSql('ALTER TABLE paquete DROP anfitrion_id');
    }
}
