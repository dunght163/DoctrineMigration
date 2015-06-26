<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
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

        $this->addSql('CREATE TABLE action_log (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_time DATE NOT NULL, ip VARCHAR(255) NOT NULL, server_ip VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, descr LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // modified
        //// clone data from log to action_log
        $this->addSql('INSERT INTO TABLE action_log (SELECT * FROM action_log)');

        // end - modified

        $this->addSql('DROP TABLE log');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_time DATE NOT NULL, ip VARCHAR(255) NOT NULL, server_ip VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, descr LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE action_log');
    }
}
