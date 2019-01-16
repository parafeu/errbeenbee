<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116100837 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accommodation ADD capacity INT NOT NULL, ADD accType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE house ADD type VARCHAR(255) NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DBF396750 FOREIGN KEY (id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD usrType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE owner CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE owner ADD CONSTRAINT FK_CF60E67CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BBF396750 FOREIGN KEY (id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traveller CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE traveller ADD CONSTRAINT FK_92E7B427BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accommodation DROP capacity, DROP accType');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399DBF396750');
        $this->addSql('ALTER TABLE house DROP type, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE owner DROP FOREIGN KEY FK_CF60E67CBF396750');
        $this->addSql('ALTER TABLE owner CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BBF396750');
        $this->addSql('ALTER TABLE room CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE traveller DROP FOREIGN KEY FK_92E7B427BF396750');
        $this->addSql('ALTER TABLE traveller CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user DROP usrType');
    }
}
