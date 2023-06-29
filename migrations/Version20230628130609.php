<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628130609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characteristic (id INT AUTO_INCREMENT NOT NULL, reseau VARCHAR(255) NOT NULL, stockage INT NOT NULL, ecran VARCHAR(255) NOT NULL, ram VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobil (id INT AUTO_INCREMENT NOT NULL, characteristic_id INT DEFAULT NULL, category_id INT DEFAULT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, INDEX IDX_7FAD4167DEE9D12B (characteristic_id), INDEX IDX_7FAD416712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mobil ADD CONSTRAINT FK_7FAD4167DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id)');
        $this->addSql('ALTER TABLE mobil ADD CONSTRAINT FK_7FAD416712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mobil DROP FOREIGN KEY FK_7FAD4167DEE9D12B');
        $this->addSql('ALTER TABLE mobil DROP FOREIGN KEY FK_7FAD416712469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('DROP TABLE mobil');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
