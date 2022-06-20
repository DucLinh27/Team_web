<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620075736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B171EB6C');
        $this->addSql('ALTER TABLE `order` ADD car_id_id INT DEFAULT NULL, ADD discount VARCHAR(255) NOT NULL, DROP order_discount, DROP car');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A0EF1B80 ON `order` (car_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A0EF1B80');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B171EB6C');
        $this->addSql('DROP INDEX IDX_F5299398A0EF1B80 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD car VARCHAR(255) NOT NULL, DROP car_id_id, CHANGE discount order_discount VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B171EB6C FOREIGN KEY (customer_id_id) REFERENCES car (id)');
    }
}
