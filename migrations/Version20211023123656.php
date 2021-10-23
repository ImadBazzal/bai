<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211023123656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, celebrity_id INT NOT NULL, representative_id INT NOT NULL, territory_id INT DEFAULT NULL, INDEX IDX_268B9C9D9D12EF95 (celebrity_id), INDEX IDX_268B9C9DFC3FF006 (representative_id), INDEX IDX_268B9C9D73F74AD4 (territory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE celebrity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, bio VARCHAR(1024) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, representative_id INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_E7927C74FC3FF006 (representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(191) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(191) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE manager (id INT AUTO_INCREMENT NOT NULL, celebrity_id INT NOT NULL, representative_id INT NOT NULL, territory_id INT DEFAULT NULL, INDEX IDX_FA2425B99D12EF95 (celebrity_id), INDEX IDX_FA2425B9FC3FF006 (representative_id), INDEX IDX_FA2425B973F74AD4 (territory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publicist (id INT AUTO_INCREMENT NOT NULL, celebrity_id INT NOT NULL, representative_id INT NOT NULL, territory_id INT DEFAULT NULL, INDEX IDX_38C8F80C9D12EF95 (celebrity_id), INDEX IDX_38C8F80CFC3FF006 (representative_id), INDEX IDX_38C8F80C73F74AD4 (territory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE representative (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE territory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D73F74AD4 FOREIGN KEY (territory_id) REFERENCES territory (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B99D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B973F74AD4 FOREIGN KEY (territory_id) REFERENCES territory (id)');
        $this->addSql('ALTER TABLE publicist ADD CONSTRAINT FK_38C8F80C9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id)');
        $this->addSql('ALTER TABLE publicist ADD CONSTRAINT FK_38C8F80CFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql('ALTER TABLE publicist ADD CONSTRAINT FK_38C8F80C73F74AD4 FOREIGN KEY (territory_id) REFERENCES territory (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D9D12EF95');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B99D12EF95');
        $this->addSql('ALTER TABLE publicist DROP FOREIGN KEY FK_38C8F80C9D12EF95');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DFC3FF006');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74FC3FF006');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B9FC3FF006');
        $this->addSql('ALTER TABLE publicist DROP FOREIGN KEY FK_38C8F80CFC3FF006');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D73F74AD4');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B973F74AD4');
        $this->addSql('ALTER TABLE publicist DROP FOREIGN KEY FK_38C8F80C73F74AD4');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE celebrity');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE publicist');
        $this->addSql('DROP TABLE representative');
        $this->addSql('DROP TABLE territory');
    }
}
