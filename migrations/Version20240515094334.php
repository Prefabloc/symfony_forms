<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515094334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE litige_qualite ADD societe_id INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE litige_qualite ADD CONSTRAINT FK_AE3617EAFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_AE3617EAFCF77503 ON litige_qualite (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE litige_qualite DROP FOREIGN KEY FK_AE3617EAFCF77503');
        $this->addSql('DROP INDEX IDX_AE3617EAFCF77503 ON litige_qualite');
        $this->addSql('ALTER TABLE litige_qualite DROP societe_id, DROP created_at');
    }
}
