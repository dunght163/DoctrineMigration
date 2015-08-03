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
        //1. fetch all from product
        $allProducts = $this->connection->executeQuery('SELECT id from product')->fetchAll();

        //check if has no product
        if (null === $allProducts || !is_array($allProducts) || count($allProducts) < 1) {
            $this->warnIf(true, '==== has ' . '0' . ' product');
            return;
        }

        $this->warnIf(true, '==== has ' . count($allProducts) . ' products');

        //2. create table product_tmp
        $this->addSql('CREATE TABLE product_tmp (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(255), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        //3. build data for product_tmp
        $allProductTemps = array_map(function ($prod) {
            return '('
            . '\'' . $prod['id'] . '\''
            . ', '
            . '\'' . $this->createUUID() . '\''
            . ')';
        }, $allProducts);

        $values = implode(', ', $allProductTemps);

        $this->warnIf(true, '==== values to update product uuid: ' . $values);

        //4. insert data for product_tmp
        //NOT YET RUN???: $this->addSql('INSERT INTO product_tmp (id, uuid) VALUES (?)', [$values]);
        $this->addSql('INSERT INTO product_tmp (id, uuid) VALUES ' . $values);

        //5. update uuid of product
        $this->addSql('UPDATE product t, product_tmp t_tmp SET t.uuid = t_tmp.uuid WHERE t.id = t_tmp.id');

        //6. drop table product_tmp
        $this->addSql('DROP TABLE product_tmp');
    }

    private function createUUID()
    {
        return uniqid("", true);
    }
}
