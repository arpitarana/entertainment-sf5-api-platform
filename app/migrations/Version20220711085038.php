<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711085038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_7BA2F5EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cast (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, director VARCHAR(255) NOT NULL, release_date DATETIME NOT NULL, INDEX IDX_1D5EF26F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_cast (movie_id INT NOT NULL, cast_id INT NOT NULL, INDEX IDX_E1DE98FB8F93B6FC (movie_id), INDEX IDX_E1DE98FB27B5E40F (cast_id), PRIMARY KEY(movie_id, cast_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ratings (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, INDEX IDX_CEB607C98F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE movie_cast ADD CONSTRAINT FK_E1DE98FB8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_cast ADD CONSTRAINT FK_E1DE98FB27B5E40F FOREIGN KEY (cast_id) REFERENCES cast (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ratings ADD CONSTRAINT FK_CEB607C98F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_cast DROP FOREIGN KEY FK_E1DE98FB27B5E40F');
        $this->addSql('ALTER TABLE movie_cast DROP FOREIGN KEY FK_E1DE98FB8F93B6FC');
        $this->addSql('ALTER TABLE ratings DROP FOREIGN KEY FK_CEB607C98F93B6FC');
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EBA76ED395');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F7E3C61F9');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE cast');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_cast');
        $this->addSql('DROP TABLE ratings');
        $this->addSql('DROP TABLE user');
    }
}
