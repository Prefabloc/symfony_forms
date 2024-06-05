<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605061831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agregat_carriere_production_chargeuse (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_carriere_production_mobile (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, etage1 VARCHAR(255) DEFAULT NULL, etage2 VARCHAR(255) DEFAULT NULL, etage3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_carriere_production_pelle (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_concassage_production_chargeuse (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_concassage_production_pelle (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, societe_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, can_be_produced TINYINT(1) NOT NULL, stock DOUBLE PRECISION NOT NULL, INDEX IDX_23A0E66FCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE btpproduction (id INT AUTO_INCREMENT NOT NULL, saisie_production_id INT DEFAULT NULL, article_id INT DEFAULT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_88D21879FC9887F6 (saisie_production_id), INDEX IDX_88D218797294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carriere_saisie_debit (id INT AUTO_INCREMENT NOT NULL, type_article VARCHAR(50) NOT NULL, nbr_tonne VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carriere_saisie_pelle (id INT AUTO_INCREMENT NOT NULL, type_materiau VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concassage_saisie_chargeuse (id INT AUTO_INCREMENT NOT NULL, type_article VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concassage_saisie_debit (id INT AUTO_INCREMENT NOT NULL, type_article VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concassage_saisie_pelle (id INT AUTO_INCREMENT NOT NULL, type_materiau VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exforman_production_alimentation (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_actions_article (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, personne_modifiant_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_1E3890087294869C (article_id), INDEX IDX_1E389008AAFE321D (personne_modifiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identification_prestation (id INT AUTO_INCREMENT NOT NULL, societe VARCHAR(50) NOT NULL, nom_prenom VARCHAR(100) NOT NULL, prestation VARCHAR(100) NOT NULL, commanditaire VARCHAR(50) NOT NULL, heure_arrivee DATETIME NOT NULL, heure_depart DATETIME DEFAULT NULL, signature VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE litige_qualite (id INT AUTO_INCREMENT NOT NULL, societe_id INT NOT NULL, clients VARCHAR(255) NOT NULL, blv VARCHAR(255) NOT NULL, article VARCHAR(255) NOT NULL, volume INT NOT NULL, conformite VARCHAR(255) NOT NULL, INDEX IDX_AE3617EAFCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefabloc_production (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, consommation_id INT DEFAULT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, INDEX IDX_6D5A99447294869C (article_id), UNIQUE INDEX UNIQ_6D5A9944C1076F84 (consommation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparation_palette (id INT AUTO_INCREMENT NOT NULL, type_palette VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisie_alimentation (id INT AUTO_INCREMENT NOT NULL, type_materiau VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisie_debit (id INT AUTO_INCREMENT NOT NULL, type_article VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisie_declassement (id INT AUTO_INCREMENT NOT NULL, article VARCHAR(255) NOT NULL, motif_declassement VARCHAR(255) NOT NULL, quantite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisie_destockage (id INT AUTO_INCREMENT NOT NULL, type_article VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisie_production (id INT AUTO_INCREMENT NOT NULL, qte04 DOUBLE PRECISION NOT NULL, qte610 DOUBLE PRECISION NOT NULL, qte_cem DOUBLE PRECISION NOT NULL, qte_adjuvant DOUBLE PRECISION NOT NULL, qte_huile DOUBLE PRECISION NOT NULL, qte_eau DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, societe_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, INDEX IDX_8D93D649FCF77503 (societe_id), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valromex_saisie_declassement (id INT AUTO_INCREMENT NOT NULL, article VARCHAR(255) NOT NULL, motif_declassement VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valromex_saisie_production (id INT AUTO_INCREMENT NOT NULL, qte04 DOUBLE PRECISION NOT NULL, qte610 DOUBLE PRECISION NOT NULL, qte_cem DOUBLE PRECISION NOT NULL, qte_adjuvant DOUBLE PRECISION NOT NULL, qte_huile DOUBLE PRECISION NOT NULL, qte_eau DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE btpproduction ADD CONSTRAINT FK_88D21879FC9887F6 FOREIGN KEY (saisie_production_id) REFERENCES valromex_saisie_production (id)');
        $this->addSql('ALTER TABLE btpproduction ADD CONSTRAINT FK_88D218797294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE historique_actions_article ADD CONSTRAINT FK_1E3890087294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE historique_actions_article ADD CONSTRAINT FK_1E389008AAFE321D FOREIGN KEY (personne_modifiant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE litige_qualite ADD CONSTRAINT FK_AE3617EAFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE prefabloc_production ADD CONSTRAINT FK_6D5A99447294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE prefabloc_production ADD CONSTRAINT FK_6D5A9944C1076F84 FOREIGN KEY (consommation_id) REFERENCES saisie_production (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FCF77503');
        $this->addSql('ALTER TABLE btpproduction DROP FOREIGN KEY FK_88D21879FC9887F6');
        $this->addSql('ALTER TABLE btpproduction DROP FOREIGN KEY FK_88D218797294869C');
        $this->addSql('ALTER TABLE historique_actions_article DROP FOREIGN KEY FK_1E3890087294869C');
        $this->addSql('ALTER TABLE historique_actions_article DROP FOREIGN KEY FK_1E389008AAFE321D');
        $this->addSql('ALTER TABLE litige_qualite DROP FOREIGN KEY FK_AE3617EAFCF77503');
        $this->addSql('ALTER TABLE prefabloc_production DROP FOREIGN KEY FK_6D5A99447294869C');
        $this->addSql('ALTER TABLE prefabloc_production DROP FOREIGN KEY FK_6D5A9944C1076F84');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FCF77503');
        $this->addSql('DROP TABLE agregat_carriere_production_chargeuse');
        $this->addSql('DROP TABLE agregat_carriere_production_mobile');
        $this->addSql('DROP TABLE agregat_carriere_production_pelle');
        $this->addSql('DROP TABLE agregat_concassage_production_chargeuse');
        $this->addSql('DROP TABLE agregat_concassage_production_pelle');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE btpproduction');
        $this->addSql('DROP TABLE carriere_saisie_debit');
        $this->addSql('DROP TABLE carriere_saisie_pelle');
        $this->addSql('DROP TABLE concassage_saisie_chargeuse');
        $this->addSql('DROP TABLE concassage_saisie_debit');
        $this->addSql('DROP TABLE concassage_saisie_pelle');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE exforman_production_alimentation');
        $this->addSql('DROP TABLE historique_actions_article');
        $this->addSql('DROP TABLE identification_prestation');
        $this->addSql('DROP TABLE litige_qualite');
        $this->addSql('DROP TABLE prefabloc_production');
        $this->addSql('DROP TABLE reparation_palette');
        $this->addSql('DROP TABLE saisie_alimentation');
        $this->addSql('DROP TABLE saisie_debit');
        $this->addSql('DROP TABLE saisie_declassement');
        $this->addSql('DROP TABLE saisie_destockage');
        $this->addSql('DROP TABLE saisie_production');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE valromex_saisie_declassement');
        $this->addSql('DROP TABLE valromex_saisie_production');
    }
}
