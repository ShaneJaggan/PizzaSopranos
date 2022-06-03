<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602191508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_order ADD pizza_id INT NOT NULL');
        $this->addSql('ALTER TABLE pizza_order ADD CONSTRAINT FK_3589140D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
        $this->addSql('CREATE INDEX IDX_3589140D41D1D42 ON pizza_order (pizza_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_order DROP FOREIGN KEY FK_3589140D41D1D42');
        $this->addSql('DROP INDEX IDX_3589140D41D1D42 ON pizza_order');
        $this->addSql('ALTER TABLE pizza_order DROP pizza_id');
    }
}
