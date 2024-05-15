<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506123024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE btpproduction ADD saisie_production_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE btpproduction ADD CONSTRAINT FK_88D21879FC9887F6 FOREIGN KEY (saisie_production_id) REFERENCES valromex_saisie_production (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88D21879FC9887F6 ON btpproduction (saisie_production_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE btpproduction DROP FOREIGN KEY FK_88D21879FC9887F6');
        $this->addSql('DROP INDEX UNIQ_88D21879FC9887F6 ON btpproduction');
        $this->addSql('ALTER TABLE btpproduction DROP saisie_production_id');
    }
}
