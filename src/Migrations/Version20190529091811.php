<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
final class Version20190529091811 extends AbstractMigration
=======
final class Version20190529101602 extends AbstractMigration
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529101602.php
=======
final class Version20190529101602 extends AbstractMigration
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c:src/Migrations/Version20190529101602.php
=======
final class Version20190529091811 extends AbstractMigration
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE debate (id INT AUTO_INCREMENT NOT NULL, title TINYTEXT NOT NULL, description LONGTEXT NOT NULL, category TINYTEXT NOT NULL, author TINYTEXT NOT NULL, created DATETIME NOT NULL, side1 TINYTEXT NOT NULL, side2 TINYTEXT NOT NULL, side1_votes INT NOT NULL, side2_votes INT NOT NULL, total_votes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
=======
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD debate_id INT NOT NULL, ADD agree SMALLINT NOT NULL, ADD author TINYTEXT NOT NULL, ADD content LONGTEXT NOT NULL, ADD created DATETIME NOT NULL, ADD votes INT NOT NULL');
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529101602.php
=======
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD debate_id INT NOT NULL, ADD agree SMALLINT NOT NULL, ADD author TINYTEXT NOT NULL, ADD content LONGTEXT NOT NULL, ADD created DATETIME NOT NULL, ADD votes INT NOT NULL');
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c:src/Migrations/Version20190529101602.php
=======
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE debate (id INT AUTO_INCREMENT NOT NULL, title TINYTEXT NOT NULL, description LONGTEXT NOT NULL, category TINYTEXT NOT NULL, author TINYTEXT NOT NULL, created DATETIME NOT NULL, side1 TINYTEXT NOT NULL, side2 TINYTEXT NOT NULL, side1_votes INT NOT NULL, side2_votes INT NOT NULL, total_votes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

<<<<<<< HEAD
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
<<<<<<< HEAD:src/Migrations/Version20190529091811.php
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE debate');
=======
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE comment DROP debate_id, DROP agree, DROP author, DROP content, DROP created, DROP votes');
>>>>>>> ad2d568a389955102fbc039242182152c7f8c121:src/Migrations/Version20190529101602.php
=======
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE comment DROP debate_id, DROP agree, DROP author, DROP content, DROP created, DROP votes');
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c:src/Migrations/Version20190529101602.php
=======
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE debate');
>>>>>>> 687f42fba171a85f719f1b03870f4dba24b4339c
    }
}
