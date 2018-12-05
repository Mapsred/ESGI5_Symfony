<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181205091514 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE battle_pet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creature_id INT NOT NULL, spell_id INT DEFAULT NULL, item_id INT DEFAULT NULL, quality_id INT DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, species_id INT DEFAULT NULL, breed_id INT DEFAULT NULL, pet_quality_id INT DEFAULT NULL, level VARCHAR(255) DEFAULT NULL, health INT DEFAULT NULL, power INT DEFAULT NULL, speed INT DEFAULT NULL, battle_pet_guid VARCHAR(255) DEFAULT NULL, creature_name VARCHAR(255) NOT NULL, can_battle TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE battle_pet');
    }
}
