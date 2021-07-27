<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726221736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usr_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, street VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, author VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE file (id INT NOT NULL, author_id INT DEFAULT NULL, usr_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, size INT NOT NULL, type VARCHAR(255) NOT NULL, format VARCHAR(255) DEFAULT NULL, duration INT DEFAULT NULL, pages_number INT DEFAULT NULL, orientation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8C9F3610F675F31B ON file (author_id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610C69D3FB ON file (usr_id)');
        $this->addSql('CREATE TABLE usr (id INT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1762498CF5B7AF75 ON usr (address_id)');
        $this->addSql('CREATE TABLE usr_usr (usr_source INT NOT NULL, usr_target INT NOT NULL, PRIMARY KEY(usr_source, usr_target))');
        $this->addSql('CREATE INDEX IDX_56D56358EF6408D9 ON usr_usr (usr_source)');
        $this->addSql('CREATE INDEX IDX_56D56358F6815856 ON usr_usr (usr_target)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610C69D3FB FOREIGN KEY (usr_id) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usr ADD CONSTRAINT FK_1762498CF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usr_usr ADD CONSTRAINT FK_56D56358EF6408D9 FOREIGN KEY (usr_source) REFERENCES usr (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usr_usr ADD CONSTRAINT FK_56D56358F6815856 FOREIGN KEY (usr_target) REFERENCES usr (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usr DROP CONSTRAINT FK_1762498CF5B7AF75');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F3610F675F31B');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F3610C69D3FB');
        $this->addSql('ALTER TABLE usr_usr DROP CONSTRAINT FK_56D56358EF6408D9');
        $this->addSql('ALTER TABLE usr_usr DROP CONSTRAINT FK_56D56358F6815856');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usr_id_seq CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE usr');
        $this->addSql('DROP TABLE usr_usr');
    }
}
