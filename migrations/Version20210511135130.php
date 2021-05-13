<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511135130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account_day (id INT AUTO_INCREMENT NOT NULL, bank_acount_id INT NOT NULL, UNIQUE INDEX UNIQ_87D0C6B1FDD63233 (bank_acount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank_account_day ADD CONSTRAINT FK_87D0C6B1FDD63233 FOREIGN KEY (bank_acount_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE bank_account CHANGE money money INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bank_account_day');
        $this->addSql('ALTER TABLE bank_account CHANGE money money BIGINT DEFAULT NULL');
    }
}
