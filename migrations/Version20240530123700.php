<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530123700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE signalement (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prefabloc_production ADD consommation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prefabloc_production ADD CONSTRAINT FK_6D5A9944C1076F84 FOREIGN KEY (consommation_id) REFERENCES saisie_production (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D5A9944C1076F84 ON prefabloc_production (consommation_id)');
        $this->addSql('ALTER TABLE saisie_production DROP FOREIGN KEY FK_291C8794ECC6147F');
        $this->addSql('DROP INDEX UNIQ_291C8794ECC6147F ON saisie_production');
        $this->addSql('ALTER TABLE saisie_production DROP production_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE signalement');
        $this->addSql('ALTER TABLE prefabloc_production DROP FOREIGN KEY FK_6D5A9944C1076F84');
        $this->addSql('DROP INDEX UNIQ_6D5A9944C1076F84 ON prefabloc_production');
        $this->addSql('ALTER TABLE prefabloc_production DROP consommation_id');
        $this->addSql('ALTER TABLE saisie_production ADD production_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE saisie_production ADD CONSTRAINT FK_291C8794ECC6147F FOREIGN KEY (production_id) REFERENCES prefabloc_production (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_291C8794ECC6147F ON saisie_production (production_id)');
    }
}
