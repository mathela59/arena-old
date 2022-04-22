<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422052742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE characteristics_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE combat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE combat_line_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fighting_style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sentence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sentence_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE warrior_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE characteristics (id INT NOT NULL, warrior_id INT NOT NULL, strength INT NOT NULL, dexterity INT NOT NULL, speed INT NOT NULL, intelligence INT NOT NULL, will_power INT NOT NULL, luck INT NOT NULL, charism INT NOT NULL, stamina INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7037B156452AFEA4 ON characteristics (warrior_id)');
        $this->addSql('CREATE TABLE combat (id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE combat_warrior (combat_id INT NOT NULL, warrior_id INT NOT NULL, PRIMARY KEY(combat_id, warrior_id))');
        $this->addSql('CREATE INDEX IDX_1A86FC89FC7EEDB8 ON combat_warrior (combat_id)');
        $this->addSql('CREATE INDEX IDX_1A86FC89452AFEA4 ON combat_warrior (warrior_id)');
        $this->addSql('CREATE TABLE combat_line (id INT NOT NULL, combat_id INT NOT NULL, attacker_id INT NOT NULL, defender_id INT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4ADEE46BFC7EEDB8 ON combat_line (combat_id)');
        $this->addSql('CREATE INDEX IDX_4ADEE46B65F8CAE3 ON combat_line (attacker_id)');
        $this->addSql('CREATE INDEX IDX_4ADEE46B4A3E3B6F ON combat_line (defender_id)');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, warrior_id INT NOT NULL, slot_id INT NOT NULL, item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D338D583452AFEA4 ON equipment (warrior_id)');
        $this->addSql('CREATE INDEX IDX_D338D58359E5119C ON equipment (slot_id)');
        $this->addSql('CREATE INDEX IDX_D338D583126F525E ON equipment (item_id)');
        $this->addSql('CREATE TABLE fighting_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, requirements JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, modifiers JSON NOT NULL, requirements JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F1B251EC54C8C93 ON item (type_id)');
        $this->addSql('CREATE TABLE item_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, type_id INT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D664ED5C54C8C93 ON sentence (type_id)');
        $this->addSql('CREATE TABLE sentence_type (id INT NOT NULL, fighting_style_id INT DEFAULT NULL, breed_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, shortcode VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6390BBD013949A02 ON sentence_type (fighting_style_id)');
        $this->addSql('CREATE INDEX IDX_6390BBD0A8B4A30F ON sentence_type (breed_id)');
        $this->addSql('CREATE TABLE slot (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE warrior (id INT NOT NULL, race_id INT NOT NULL, style_id INT NOT NULL, name VARCHAR(255) NOT NULL, experience INT NOT NULL, rank INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E47A14B6E59D40D ON warrior (race_id)');
        $this->addSql('CREATE INDEX IDX_2E47A14BBACD6074 ON warrior (style_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE characteristics ADD CONSTRAINT FK_7037B156452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_warrior ADD CONSTRAINT FK_1A86FC89FC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_warrior ADD CONSTRAINT FK_1A86FC89452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46BFC7EEDB8 FOREIGN KEY (combat_id) REFERENCES combat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46B65F8CAE3 FOREIGN KEY (attacker_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE combat_line ADD CONSTRAINT FK_4ADEE46B4A3E3B6F FOREIGN KEY (defender_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583452AFEA4 FOREIGN KEY (warrior_id) REFERENCES warrior (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58359E5119C FOREIGN KEY (slot_id) REFERENCES slot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EC54C8C93 FOREIGN KEY (type_id) REFERENCES item_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED5C54C8C93 FOREIGN KEY (type_id) REFERENCES sentence_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence_type ADD CONSTRAINT FK_6390BBD013949A02 FOREIGN KEY (fighting_style_id) REFERENCES fighting_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence_type ADD CONSTRAINT FK_6390BBD0A8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14B6E59D40D FOREIGN KEY (race_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE warrior ADD CONSTRAINT FK_2E47A14BBACD6074 FOREIGN KEY (style_id) REFERENCES fighting_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sentence_type DROP CONSTRAINT FK_6390BBD0A8B4A30F');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14B6E59D40D');
        $this->addSql('ALTER TABLE combat_warrior DROP CONSTRAINT FK_1A86FC89FC7EEDB8');
        $this->addSql('ALTER TABLE combat_line DROP CONSTRAINT FK_4ADEE46BFC7EEDB8');
        $this->addSql('ALTER TABLE sentence_type DROP CONSTRAINT FK_6390BBD013949A02');
        $this->addSql('ALTER TABLE warrior DROP CONSTRAINT FK_2E47A14BBACD6074');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583126F525E');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251EC54C8C93');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED5C54C8C93');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D58359E5119C');
        $this->addSql('ALTER TABLE characteristics DROP CONSTRAINT FK_7037B156452AFEA4');
        $this->addSql('ALTER TABLE combat_warrior DROP CONSTRAINT FK_1A86FC89452AFEA4');
        $this->addSql('ALTER TABLE combat_line DROP CONSTRAINT FK_4ADEE46B65F8CAE3');
        $this->addSql('ALTER TABLE combat_line DROP CONSTRAINT FK_4ADEE46B4A3E3B6F');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D583452AFEA4');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE characteristics_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE combat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE combat_line_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fighting_style_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sentence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sentence_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slot_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE warrior_id_seq CASCADE');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE characteristics');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE combat_warrior');
        $this->addSql('DROP TABLE combat_line');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE fighting_style');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP TABLE sentence');
        $this->addSql('DROP TABLE sentence_type');
        $this->addSql('DROP TABLE slot');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE warrior');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
