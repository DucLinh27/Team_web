<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620093711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D2ADD6D8C');
        $this->addSql('DROP INDEX IDX_773DE69D2ADD6D8C ON car');
        $this->addSql('ALTER TABLE car ADD supplier_id_id INT DEFAULT NULL, ADD car_brand VARCHAR(255) NOT NULL, DROP supplier_id, DROP car_id, CHANGE car_price car_price VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA65F9C7D FOREIGN KEY (supplier_id_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA65F9C7D ON car (supplier_id_id)');
        $this->addSql('ALTER TABLE customer ADD customer_mail VARCHAR(255) NOT NULL, ADD customer_phone VARCHAR(255) NOT NULL, ADD customer_address VARCHAR(255) NOT NULL, DROP customer_id, DROP customer_email, DROP phone_number, DROP address');
        $this->addSql('ALTER TABLE `order` ADD customer_id_id INT DEFAULT NULL, ADD car_id_id INT DEFAULT NULL, ADD discount VARCHAR(255) NOT NULL, DROP order_id, DROP date_order');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_F5299398B171EB6C ON `order` (customer_id_id)');
        $this->addSql('CREATE INDEX IDX_F5299398A0EF1B80 ON `order` (car_id_id)');
        $this->addSql('ALTER TABLE supplier DROP supplier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA65F9C7D');
        $this->addSql('DROP INDEX IDX_773DE69DA65F9C7D ON car');
        $this->addSql('ALTER TABLE car ADD supplier_id INT NOT NULL, ADD car_id INT NOT NULL, DROP supplier_id_id, DROP car_brand, CHANGE car_price car_price INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D2ADD6D8C ON car (supplier_id)');
        $this->addSql('ALTER TABLE customer ADD customer_id INT NOT NULL, ADD customer_email VARCHAR(255) NOT NULL, ADD phone_number INT NOT NULL, ADD address VARCHAR(255) NOT NULL, DROP customer_mail, DROP customer_phone, DROP customer_address');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B171EB6C');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A0EF1B80');
        $this->addSql('DROP INDEX IDX_F5299398B171EB6C ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398A0EF1B80 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD order_id INT NOT NULL, ADD date_order DATETIME NOT NULL, DROP customer_id_id, DROP car_id_id, DROP discount');
        $this->addSql('ALTER TABLE supplier ADD supplier_id INT NOT NULL');
    }
}
