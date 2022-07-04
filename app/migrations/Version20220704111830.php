<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704111830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campervan (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, order_quantity_limit INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_order (id INT AUTO_INCREMENT NOT NULL, start_station_id INT NOT NULL, end_station_id INT NOT NULL, campervan_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_6EC21D7753721DCB (start_station_id), INDEX IDX_6EC21D772FF5EABB (end_station_id), INDEX IDX_6EC21D77B9D53E94 (campervan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_order_equipment (id INT AUTO_INCREMENT NOT NULL, rental_orders_id INT NOT NULL, equipments_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_34B438AB701E9DD9 (rental_orders_id), INDEX IDX_34B438ABBD251DD7 (equipments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station_camper (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, campervan_id INT NOT NULL, available TINYINT(1) DEFAULT 1, created_at DATETIME NULL, updated_at DATETIME NULL, INDEX IDX_6F2E593021BDB235 (station_id), INDEX IDX_6F2E5930B9D53E94 (campervan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station_equipment (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL,  equipment_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_51BCBB9821BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental_order ADD CONSTRAINT FK_6EC21D7753721DCB FOREIGN KEY (start_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE rental_order ADD CONSTRAINT FK_6EC21D772FF5EABB FOREIGN KEY (end_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE rental_order ADD CONSTRAINT FK_6EC21D77B9D53E94 FOREIGN KEY (campervan_id) REFERENCES campervan (id)');
        $this->addSql('ALTER TABLE rental_order_equipment ADD CONSTRAINT FK_34B438AB701E9DD9 FOREIGN KEY (rental_orders_id) REFERENCES rental_order (id)');
        $this->addSql('ALTER TABLE rental_order_equipment ADD CONSTRAINT FK_34B438ABBD251DD7 FOREIGN KEY (equipments_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE station_camper ADD CONSTRAINT FK_6F2E593021BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE station_camper ADD CONSTRAINT FK_6F2E5930B9D53E94 FOREIGN KEY (campervan_id) REFERENCES campervan (id)');
        $this->addSql('ALTER TABLE station_equipment ADD CONSTRAINT FK_51BCBB9821BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE station_equipment ADD CONSTRAINT FK_51BCBB98517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_51BCBB98517FE9FE ON station_equipment (equipment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_order DROP FOREIGN KEY FK_6EC21D77B9D53E94');
        $this->addSql('ALTER TABLE station_camper DROP FOREIGN KEY FK_6F2E5930B9D53E94');
        $this->addSql('ALTER TABLE rental_order_equipment DROP FOREIGN KEY FK_34B438ABBD251DD7');
        $this->addSql('ALTER TABLE rental_order_equipment DROP FOREIGN KEY FK_34B438AB701E9DD9');
        $this->addSql('ALTER TABLE rental_order DROP FOREIGN KEY FK_6EC21D7753721DCB');
        $this->addSql('ALTER TABLE rental_order DROP FOREIGN KEY FK_6EC21D772FF5EABB');
        $this->addSql('ALTER TABLE station_camper DROP FOREIGN KEY FK_6F2E593021BDB235');
        $this->addSql('ALTER TABLE station_equipment DROP FOREIGN KEY FK_51BCBB9821BDB235');
        $this->addSql('ALTER TABLE station_equipment DROP FOREIGN KEY FK_51BCBB98517FE9FE');
        $this->addSql('DROP INDEX IDX_51BCBB98517FE9FE ON station_equipment');
        $this->addSql('DROP TABLE campervan');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE rental_order');
        $this->addSql('DROP TABLE rental_order_equipment');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE station_camper');
        $this->addSql('DROP TABLE station_equipment');
    }
}
