<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191109185903 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BackupLocation CHANGE host host VARCHAR(255) NOT NULL, CHANGE maxParallelJobs maxParallelJobs INT NOT NULL');
        $this->addSql('ALTER TABLE Client CHANGE maxParallelJobs maxParallelJobs INT NOT NULL, CHANGE data data LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE Job DROP FOREIGN KEY FK_C395A618615D27E1');
        $this->addSql('ALTER TABLE Job ADD checkDiskUsage TINYINT(1) NOT NULL, CHANGE backupLocation_id backupLocation_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_c395a618615d27e1 ON Job');
        $this->addSql('CREATE INDEX IDX_C395A61817EE0EA ON Job (backupLocation_id)');
        $this->addSql('ALTER TABLE Job ADD CONSTRAINT FK_C395A618615D27E1 FOREIGN KEY (backupLocation_id) REFERENCES BackupLocation (id)');
        $this->addSql('ALTER TABLE Queue CHANGE runningSince runningSince DATETIME NOT NULL, CHANGE data data LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BackupLocation CHANGE host host VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE maxParallelJobs maxParallelJobs INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE Client CHANGE maxParallelJobs maxParallelJobs INT DEFAULT 1 NOT NULL, CHANGE data data LONGTEXT DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE Job DROP FOREIGN KEY FK_C395A61817EE0EA');
        $this->addSql('ALTER TABLE Job DROP checkDiskUsage, CHANGE backupLocation_id backupLocation_id INT NOT NULL');
        $this->addSql('DROP INDEX idx_c395a61817ee0ea ON Job');
        $this->addSql('CREATE INDEX IDX_C395A618615D27E1 ON Job (backupLocation_id)');
        $this->addSql('ALTER TABLE Job ADD CONSTRAINT FK_C395A61817EE0EA FOREIGN KEY (backupLocation_id) REFERENCES BackupLocation (id)');
        $this->addSql('ALTER TABLE Queue CHANGE runningSince runningSince DATETIME DEFAULT NULL, CHANGE data data LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
