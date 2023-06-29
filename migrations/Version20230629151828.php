<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629151828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mobil DROP FOREIGN KEY FK_7FAD4167DEE9D12B');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('ALTER TABLE calculator ADD marque VARCHAR(255) NOT NULL, ADD modele VARCHAR(255) NOT NULL, ADD poster VARCHAR(255) NOT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP category');
        $this->addSql('DROP INDEX IDX_7FAD4167DEE9D12B ON mobil');
        $this->addSql('ALTER TABLE mobil ADD reseau VARCHAR(255) NOT NULL, ADD stockage INT NOT NULL, ADD ecran VARCHAR(255) NOT NULL, ADD ram VARCHAR(255) NOT NULL, ADD phone_condition VARCHAR(255) DEFAULT NULL, DROP characteristic_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characteristic (id INT AUTO_INCREMENT NOT NULL, reseau VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stockage INT NOT NULL, ecran VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ram VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_condition VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE calculator ADD category VARCHAR(255) DEFAULT NULL, DROP marque, DROP modele, DROP poster, DROP updated_at');
        $this->addSql('ALTER TABLE mobil ADD characteristic_id INT DEFAULT NULL, DROP reseau, DROP stockage, DROP ecran, DROP ram, DROP phone_condition');
        $this->addSql('ALTER TABLE mobil ADD CONSTRAINT FK_7FAD4167DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7FAD4167DEE9D12B ON mobil (characteristic_id)');
    }
}
