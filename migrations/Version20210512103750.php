<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512103750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account_stats (id INT AUTO_INCREMENT NOT NULL, bank_account_id INT NOT NULL, money BIGINT NOT NULL, date DATE NOT NULL, INDEX IDX_EB6DEFD012CB990C (bank_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank_account_stats ADD CONSTRAINT FK_EB6DEFD012CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('DROP TABLE bank_account_day');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account_day (id INT AUTO_INCREMENT NOT NULL, bank_acount_id INT NOT NULL, money BIGINT DEFAULT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_87D0C6B1FDD63233 (bank_acount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bank_account_day ADD CONSTRAINT FK_87D0C6B1FDD63233 FOREIGN KEY (bank_acount_id) REFERENCES bank_account (id)');
        $this->addSql('DROP TABLE bank_account_stats');
    }
}
