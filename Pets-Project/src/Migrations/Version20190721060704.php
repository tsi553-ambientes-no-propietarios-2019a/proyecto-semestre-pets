<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190721060704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE valorizacion ADD paquete_id INT NOT NULL');
        $this->addSql('ALTER TABLE valorizacion ADD CONSTRAINT FK_B1B37DFC41E2D57E FOREIGN KEY (paquete_id) REFERENCES paquete (id)');
        $this->addSql('CREATE INDEX IDX_B1B37DFC41E2D57E ON valorizacion (paquete_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE valorizacion DROP FOREIGN KEY FK_B1B37DFC41E2D57E');
        $this->addSql('DROP INDEX IDX_B1B37DFC41E2D57E ON valorizacion');
        $this->addSql('ALTER TABLE valorizacion DROP paquete_id');
    }
}
