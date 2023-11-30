<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130134749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaussure (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_43D47897BCF5E72D (categorie_id), INDEX IDX_43D478974827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaussure_pointure (chaussure_id INT NOT NULL, pointure_id INT NOT NULL, INDEX IDX_20249BEF8458E35 (chaussure_id), INDEX IDX_20249BED5CAF962 (pointure_id), PRIMARY KEY(chaussure_id, pointure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointure (id INT AUTO_INCREMENT NOT NULL, pointure DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3CB446CFBCF5E72D (categorie_id), INDEX IDX_3CB446CF4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement_taille (vetement_id INT NOT NULL, taille_id INT NOT NULL, INDEX IDX_338D8365969D8B67 (vetement_id), INDEX IDX_338D8365FF25611A (taille_id), PRIMARY KEY(vetement_id, taille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chaussure ADD CONSTRAINT FK_43D47897BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE chaussure ADD CONSTRAINT FK_43D478974827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE chaussure_pointure ADD CONSTRAINT FK_20249BEF8458E35 FOREIGN KEY (chaussure_id) REFERENCES chaussure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaussure_pointure ADD CONSTRAINT FK_20249BED5CAF962 FOREIGN KEY (pointure_id) REFERENCES pointure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE vetement_taille ADD CONSTRAINT FK_338D8365969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vetement_taille ADD CONSTRAINT FK_338D8365FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaussure DROP FOREIGN KEY FK_43D47897BCF5E72D');
        $this->addSql('ALTER TABLE chaussure DROP FOREIGN KEY FK_43D478974827B9B2');
        $this->addSql('ALTER TABLE chaussure_pointure DROP FOREIGN KEY FK_20249BEF8458E35');
        $this->addSql('ALTER TABLE chaussure_pointure DROP FOREIGN KEY FK_20249BED5CAF962');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFBCF5E72D');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF4827B9B2');
        $this->addSql('ALTER TABLE vetement_taille DROP FOREIGN KEY FK_338D8365969D8B67');
        $this->addSql('ALTER TABLE vetement_taille DROP FOREIGN KEY FK_338D8365FF25611A');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE chaussure');
        $this->addSql('DROP TABLE chaussure_pointure');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE pointure');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE vetement');
        $this->addSql('DROP TABLE vetement_taille');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
