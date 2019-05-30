<?php

declare (strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529171320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }


    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->assSql('CREATE TABLE `rememberme_token ` (`series `   char (88)     UNIQUE PRIMARY KEY NOT NULL,`value `    char (88)     NOT NULL,`lastUsed ` datetime     NOT NULL, `class `    varchar (100) NOT NULL, `username ` varchar (200) NOT NULL)');
        $this->addSql('ALTER TABLE comment ADD debate_id INT NOT NULL, ADD agree SMALLINT NOT NULL, ADD author TINYTEXT NOT NULL, ADD content LONGTEXT NOT NULL, ADD created DATETIME NOT NULL, ADD votes INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5A22C588 FOREIGN KEY (debate_id) REFERENCES debate (id)');
        $this->addSql('CREATE INDEX IDX_9474526C5A22C588 ON comment (debate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE utf8mb4_general_ci, value CHAR(88) NOT NULL COLLATE utf8mb4_general_ci, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE utf8mb4_general_ci, username VARCHAR(200) NOT NULL COLLATE utf8mb4_general_ci, UNIQUE INDEX series (series), PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C5A22C588');
        $this->addSql('DROP INDEX IDX_9474526C5A22C588 ON comment');
        $this->addSql('ALTER TABLE comment DROP debate_id_id, DROP agree, DROP author, DROP content, DROP created, DROP votes');
    }
}
