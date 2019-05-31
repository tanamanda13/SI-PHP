<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531055645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, debate_id INT NOT NULL, UNIQUE INDEX UNIQ_5A108564F675F31B (author_id), UNIQUE INDEX UNIQ_5A10856439A6B6F6 (debate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, debate_id INT NOT NULL, owner_id INT NOT NULL, agree SMALLINT NOT NULL, author TINYTEXT NOT NULL, content LONGTEXT NOT NULL, created DATETIME NOT NULL, votes INT NOT NULL, INDEX IDX_9474526C39A6B6F6 (debate_id), INDEX IDX_9474526C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE debate (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, title TINYTEXT NOT NULL, description LONGTEXT NOT NULL, category TINYTEXT NOT NULL, author TINYTEXT NOT NULL, created DATETIME NOT NULL, side1 TINYTEXT NOT NULL, side2 TINYTEXT NOT NULL, side1_votes INT NOT NULL, side2_votes INT NOT NULL, total_votes INT NOT NULL, INDEX IDX_DDC4A3687E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remberme_token (series INT AUTO_INCREMENT NOT NULL, value VARCHAR(88) NOT NULL, last_used DATETIME NOT NULL, class VARCHAR(100) NOT NULL, username VARCHAR(200) NOT NULL, PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A10856439A6B6F6 FOREIGN KEY (debate_id) REFERENCES debate (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C39A6B6F6 FOREIGN KEY (debate_id) REFERENCES debate (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE debate ADD CONSTRAINT FK_DDC4A3687E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE rememberme_token');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564F675F31B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7E3C61F9');
        $this->addSql('ALTER TABLE debate DROP FOREIGN KEY FK_DDC4A3687E3C61F9');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A10856439A6B6F6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C39A6B6F6');
        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE utf8mb4_general_ci, value CHAR(88) NOT NULL COLLATE utf8mb4_general_ci, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE utf8mb4_general_ci, username VARCHAR(200) NOT NULL COLLATE utf8mb4_general_ci, UNIQUE INDEX series (series), PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE debate');
        $this->addSql('DROP TABLE remberme_token');
    }
}
