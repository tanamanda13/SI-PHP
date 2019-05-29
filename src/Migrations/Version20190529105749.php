<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:src/Migrations/Version20190529092549.php
final class Version20190529092549 extends AbstractMigration
=======
final class Version20190529105749 extends AbstractMigration
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529105749.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20190529092549.php
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
=======
        $this->addSql('ALTER TABLE comment CHANGE debate_id debate_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5A22C588 FOREIGN KEY (debate_id_id) REFERENCES debate (id)');
        $this->addSql('CREATE INDEX IDX_9474526C5A22C588 ON comment (debate_id_id)');
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529105749.php
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD:src/Migrations/Version20190529092549.php
        $this->addSql('DROP TABLE user');
=======
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C5A22C588');
        $this->addSql('DROP INDEX IDX_9474526C5A22C588 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE debate_id_id debate_id INT NOT NULL');
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529105749.php
    }
}
