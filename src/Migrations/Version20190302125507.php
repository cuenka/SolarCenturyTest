<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302125507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sc_employee (employee_id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, employee_date_created DATETIME NOT NULL, employee_date_modified DATETIME NOT NULL, employee_first_name VARCHAR(200) NOT NULL, employee_last_name VARCHAR(255) NOT NULL, INDEX IDX_A3C11E02979B1AD6 (company_id), INDEX employee_idx (employee_id), PRIMARY KEY(employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sc_company (company_id INT AUTO_INCREMENT NOT NULL, company_date_created DATETIME NOT NULL, company_date_modified DATETIME NOT NULL, company_name VARCHAR(200) NOT NULL, company_headquarters VARCHAR(255) NOT NULL, company_founded DATETIME DEFAULT NULL, INDEX company_idx (company_id), PRIMARY KEY(company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sc_employee ADD CONSTRAINT FK_A3C11E02979B1AD6 FOREIGN KEY (company_id) REFERENCES sc_company (company_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sc_employee DROP FOREIGN KEY FK_A3C11E02979B1AD6');
        $this->addSql('DROP TABLE sc_employee');
        $this->addSql('DROP TABLE sc_company');
    }
}
