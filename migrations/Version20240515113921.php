<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515113921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique_actions_article (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, personne_modifiant_id INT DEFAULT NULL, quantité DOUBLE PRECISION NOT NULL, INDEX IDX_1E3890087294869C (article_id), INDEX IDX_1E389008AAFE321D (personne_modifiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique_actions_article ADD CONSTRAINT FK_1E3890087294869C FOREIGN KEY (article_id) REFERENCES production_article (id)');
        $this->addSql('ALTER TABLE historique_actions_article ADD CONSTRAINT FK_1E389008AAFE321D FOREIGN KEY (personne_modifiant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE production_article ADD can_be_produced TINYINT(1) DEFAULT NULL, ADD stock DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_actions_article DROP FOREIGN KEY FK_1E3890087294869C');
        $this->addSql('ALTER TABLE historique_actions_article DROP FOREIGN KEY FK_1E389008AAFE321D');
        $this->addSql('DROP TABLE historique_actions_article');
        $this->addSql('ALTER TABLE production_article DROP can_be_produced, DROP stock');
    }
}
