<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316213736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__chirm AS SELECT id, msg, likes FROM chirm');
        $this->addSql('DROP TABLE chirm');
        $this->addSql('CREATE TABLE chirm (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, creator_id INTEGER NOT NULL, msg VARCHAR(255) NOT NULL COLLATE BINARY, likes INTEGER NOT NULL, CONSTRAINT FK_8F2ED35261220EA6 FOREIGN KEY (creator_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chirm (id, msg, likes) SELECT id, msg, likes FROM __temp__chirm');
        $this->addSql('DROP TABLE __temp__chirm');
        $this->addSql('CREATE INDEX IDX_8F2ED35261220EA6 ON chirm (creator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_8F2ED35261220EA6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chirm AS SELECT id, msg, likes FROM chirm');
        $this->addSql('DROP TABLE chirm');
        $this->addSql('CREATE TABLE chirm (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, msg VARCHAR(255) NOT NULL, likes INTEGER NOT NULL)');
        $this->addSql('INSERT INTO chirm (id, msg, likes) SELECT id, msg, likes FROM __temp__chirm');
        $this->addSql('DROP TABLE __temp__chirm');
    }
}
