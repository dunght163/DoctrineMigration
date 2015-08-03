<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150803085918_CreateAndUpdateUUIDOfProduct extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD uuid VARCHAR(255) DEFAULT NULL');

        $this->updateUUIDForProduct();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP uuid');
    }

    private function updateUUIDForProduct()
    {
        $this->addSql('CREATE TABLE product_tmp (INT id NOT NULL, VARCHAR uuid LENGTH 255)');

        $allProducts = $this->connection->executeQuery('SELECT id from product')->fetchAll();
        $allProductTemps = array_map(function ($adTag) {
            return [$adTag['id'], $this->createUUID()];
        }, $allProducts);

        $values = explode(', ', $allProductTemps);

        $this->addSql('INSERT INTO product_tmp (id, ref_id) VALUES (?)', [$values]);

        $this->addSql('UPDATE product t, product_tmp t_tmp SET t.uuid = t_tmp.uuid WHERE t.id = t_tmp.id');
    }

    private function createUUID()
    {
        return uniqid("", true);
    }
}
