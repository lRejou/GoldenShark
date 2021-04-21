<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421144614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account (id INT AUTO_INCREMENT NOT NULL, money INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bank_transaction (id INT AUTO_INCREMENT NOT NULL, bank_account_id INT DEFAULT NULL, amount INT NOT NULL, datetame DATETIME NOT NULL, info VARCHAR(255) DEFAULT NULL, INDEX IDX_50BCB3AE12CB990C (bank_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, bank_account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D19FA6012CB990C (bank_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_contract (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, salaire INT DEFAULT NULL, accepted TINYINT(1) DEFAULT NULL, INDEX IDX_BB5F2EDCA76ED395 (user_id), INDEX IDX_BB5F2EDCA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price INT DEFAULT NULL, perm_land TINYINT(1) DEFAULT NULL, perme_bank TINYINT(1) DEFAULT NULL, perm_entreprise TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE land (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, land_id VARCHAR(255) NOT NULL, mob_spawn TINYINT(1) NOT NULL, tnt TINYINT(1) NOT NULL, fire TINYINT(1) NOT NULL, INDEX IDX_A800D5D8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, grade_id INT DEFAULT NULL, bank_acount_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, vote_quantity INT DEFAULT NULL, vote_last_date DATETIME DEFAULT NULL, booster VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D649FE19A1A8 (grade_id), UNIQUE INDEX UNIQ_8D93D649FDD63233 (bank_acount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank_transaction ADD CONSTRAINT FK_50BCB3AE12CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6012CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE entreprise_contract ADD CONSTRAINT FK_BB5F2EDCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entreprise_contract ADD CONSTRAINT FK_BB5F2EDCA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE land ADD CONSTRAINT FK_A800D5D8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FDD63233 FOREIGN KEY (bank_acount_id) REFERENCES bank_account (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_transaction DROP FOREIGN KEY FK_50BCB3AE12CB990C');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6012CB990C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FDD63233');
        $this->addSql('ALTER TABLE entreprise_contract DROP FOREIGN KEY FK_BB5F2EDCA4AEAFEA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FE19A1A8');
        $this->addSql('ALTER TABLE entreprise_contract DROP FOREIGN KEY FK_BB5F2EDCA76ED395');
        $this->addSql('ALTER TABLE land DROP FOREIGN KEY FK_A800D5D8A76ED395');
        $this->addSql('DROP TABLE bank_account');
        $this->addSql('DROP TABLE bank_transaction');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_contract');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE land');
        $this->addSql('DROP TABLE user');
    }
}
