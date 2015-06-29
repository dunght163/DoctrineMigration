<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 *
 * Rename table. This not using create/drop table. Will be modified to use RENAME TABLE sql
 */
class Version20150626104956_RenameLogToActionLogTable extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // this will be wrong by using doctrine:migrations:diff -> disable this sql
        //$this->addSql('CREATE TABLE action_log (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_time DATE NOT NULL, ip VARCHAR(255) NOT NULL, server_ip VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, descr LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // modified: using rename table sql
        $this->addSql('RENAME TABLE log TO action_log');
        // end - modified

        // disable drop table
        //$this->addSql('DROP TABLE log');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // this will be wrong by using doctrine:migrations:diff -> disable this sql
        //$this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_time DATE NOT NULL, ip VARCHAR(255) NOT NULL, server_ip VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, descr LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // modified: using rename table sql
        $this->addSql('RENAME TABLE action_log TO log');
        // end - modified

        // disable drop table
        //$this->addSql('DROP TABLE action_log');
    }
}
