<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241117142316 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE idea
            (
                id        INT AUTO_INCREMENT NOT NULL,
                author_id INT                NOT NULL,
                content   LONGTEXT           NOT NULL,
                INDEX IDX_A8BCA45F675F31B (author_id),
                PRIMARY KEY (id)
            ) DEFAULT CHARACTER SET utf8mb4
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE user
            (
                id            INT AUTO_INCREMENT NOT NULL,
                login         VARCHAR(25)        NOT NULL,
                password_hash VARCHAR(255)       NOT NULL,
                UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login),
                PRIMARY KEY (id)
            ) DEFAULT CHARACTER SET utf8mb4
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE messenger_messages
            (
                id         BIGINT AUTO_INCREMENT NOT NULL,
                body       LONGTEXT              NOT NULL,
                headers    LONGTEXT              NOT NULL,
                queue_name VARCHAR(190)          NOT NULL,
                created_at DATETIME              NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
                delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
                INDEX IDX_75EA56E0FB7336F0 (queue_name), 
                INDEX IDX_75EA56E0E3BD61CE (available_at), 
                INDEX IDX_75EA56E016BA31DB (delivered_at), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 
            COLLATE `utf8mb4_unicode_ci` 
            ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE idea
            ADD CONSTRAINT FK_A8BCA45F675F31B FOREIGN KEY (author_id) REFERENCES user (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE idea DROP FOREIGN KEY FK_A8BCA45F675F31B');
        $this->addSql('DROP TABLE idea');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
