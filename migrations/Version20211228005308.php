<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228005308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE caixa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE empresa_milha_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movimento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pessoa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE programa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE registro_entrada_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE registro_saida_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_entrada_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_saida_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE caixa (id INT NOT NULL, usuario_fechamento_id INT DEFAULT NULL, data_abertura TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data_fechamento TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, ativo BOOLEAN DEFAULT NULL, saldo_milhas INT NOT NULL, total_entradas INT NOT NULL, valor_entradas NUMERIC(10, 2) NOT NULL, total_saidas INT NOT NULL, valor_saidas NUMERIC(10, 2) NOT NULL, valor_estoque_milhas_periodo NUMERIC(10, 2) DEFAULT NULL, valor_lucro_milhas_periodo NUMERIC(10, 2) DEFAULT NULL, valor_milha_periodo NUMERIC(10, 2) DEFAULT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17F3879F1B762E7 ON caixa (usuario_fechamento_id)');
        $this->addSql('CREATE TABLE empresa_milha (id INT NOT NULL, nome VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movimento (id INT NOT NULL, caixa_id INT NOT NULL, usuario_id INT NOT NULL, tipo_operacao VARCHAR(1) NOT NULL, data TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valor NUMERIC(10, 2) NOT NULL, quantidade INT NOT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5BE0E915EA4446B8 ON movimento (caixa_id)');
        $this->addSql('CREATE INDEX IDX_5BE0E915DB38439E ON movimento (usuario_id)');
        $this->addSql('CREATE TABLE pessoa (id INT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) NOT NULL, data_nascimento DATE NOT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE programa (id INT NOT NULL, nome VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE registro_entrada (id INT NOT NULL, movimento_id INT NOT NULL, programa_id INT NOT NULL, tipo_entrada_id INT NOT NULL, usuario_id INT NOT NULL, milhas INT NOT NULL, valor NUMERIC(10, 2) NOT NULL, valor_milha NUMERIC(10, 2) NOT NULL, data_entrada TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11D826DD531A0E2D ON registro_entrada (movimento_id)');
        $this->addSql('CREATE INDEX IDX_11D826DDFD8A7328 ON registro_entrada (programa_id)');
        $this->addSql('CREATE INDEX IDX_11D826DD370E2002 ON registro_entrada (tipo_entrada_id)');
        $this->addSql('CREATE INDEX IDX_11D826DDDB38439E ON registro_entrada (usuario_id)');
        $this->addSql('CREATE TABLE registro_saida (id INT NOT NULL, movimento_id INT NOT NULL, empresa_milha_id INT NOT NULL, programa_id INT NOT NULL, tipo_saida_id INT NOT NULL, usuario_id INT NOT NULL, valor NUMERIC(10, 2) NOT NULL, milhas INT NOT NULL, valor_milha NUMERIC(10, 2) NOT NULL, data_saida TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data_compensacao TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_219DF362531A0E2D ON registro_saida (movimento_id)');
        $this->addSql('CREATE INDEX IDX_219DF362FC855B17 ON registro_saida (empresa_milha_id)');
        $this->addSql('CREATE INDEX IDX_219DF362FD8A7328 ON registro_saida (programa_id)');
        $this->addSql('CREATE INDEX IDX_219DF362E52A57D9 ON registro_saida (tipo_saida_id)');
        $this->addSql('CREATE INDEX IDX_219DF362DB38439E ON registro_saida (usuario_id)');
        $this->addSql('CREATE TABLE tipo_entrada (id INT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tipo_saida (id INT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE usuario (id INT NOT NULL, pessoa_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, data_cadastro TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data_atualizacao TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ativo BOOLEAN DEFAULT NULL, email VARCHAR(255) NOT NULL, codigo UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DF85E0677 ON usuario (username)');
        $this->addSql('CREATE INDEX IDX_2265B05DDF6FA0A5 ON usuario (pessoa_id)');
        $this->addSql('ALTER TABLE caixa ADD CONSTRAINT FK_17F3879F1B762E7 FOREIGN KEY (usuario_fechamento_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movimento ADD CONSTRAINT FK_5BE0E915EA4446B8 FOREIGN KEY (caixa_id) REFERENCES caixa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movimento ADD CONSTRAINT FK_5BE0E915DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_entrada ADD CONSTRAINT FK_11D826DD531A0E2D FOREIGN KEY (movimento_id) REFERENCES movimento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_entrada ADD CONSTRAINT FK_11D826DDFD8A7328 FOREIGN KEY (programa_id) REFERENCES programa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_entrada ADD CONSTRAINT FK_11D826DD370E2002 FOREIGN KEY (tipo_entrada_id) REFERENCES tipo_entrada (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_entrada ADD CONSTRAINT FK_11D826DDDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_saida ADD CONSTRAINT FK_219DF362531A0E2D FOREIGN KEY (movimento_id) REFERENCES movimento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_saida ADD CONSTRAINT FK_219DF362FC855B17 FOREIGN KEY (empresa_milha_id) REFERENCES empresa_milha (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_saida ADD CONSTRAINT FK_219DF362FD8A7328 FOREIGN KEY (programa_id) REFERENCES programa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_saida ADD CONSTRAINT FK_219DF362E52A57D9 FOREIGN KEY (tipo_saida_id) REFERENCES tipo_saida (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registro_saida ADD CONSTRAINT FK_219DF362DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DDF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movimento DROP CONSTRAINT FK_5BE0E915EA4446B8');
        $this->addSql('ALTER TABLE registro_saida DROP CONSTRAINT FK_219DF362FC855B17');
        $this->addSql('ALTER TABLE registro_entrada DROP CONSTRAINT FK_11D826DD531A0E2D');
        $this->addSql('ALTER TABLE registro_saida DROP CONSTRAINT FK_219DF362531A0E2D');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DDF6FA0A5');
        $this->addSql('ALTER TABLE registro_entrada DROP CONSTRAINT FK_11D826DDFD8A7328');
        $this->addSql('ALTER TABLE registro_saida DROP CONSTRAINT FK_219DF362FD8A7328');
        $this->addSql('ALTER TABLE registro_entrada DROP CONSTRAINT FK_11D826DD370E2002');
        $this->addSql('ALTER TABLE registro_saida DROP CONSTRAINT FK_219DF362E52A57D9');
        $this->addSql('ALTER TABLE caixa DROP CONSTRAINT FK_17F3879F1B762E7');
        $this->addSql('ALTER TABLE movimento DROP CONSTRAINT FK_5BE0E915DB38439E');
        $this->addSql('ALTER TABLE registro_entrada DROP CONSTRAINT FK_11D826DDDB38439E');
        $this->addSql('ALTER TABLE registro_saida DROP CONSTRAINT FK_219DF362DB38439E');
        $this->addSql('DROP SEQUENCE caixa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE empresa_milha_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE movimento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pessoa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE programa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE registro_entrada_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE registro_saida_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_entrada_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_saida_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuario_id_seq CASCADE');
        $this->addSql('DROP TABLE caixa');
        $this->addSql('DROP TABLE empresa_milha');
        $this->addSql('DROP TABLE movimento');
        $this->addSql('DROP TABLE pessoa');
        $this->addSql('DROP TABLE programa');
        $this->addSql('DROP TABLE registro_entrada');
        $this->addSql('DROP TABLE registro_saida');
        $this->addSql('DROP TABLE tipo_entrada');
        $this->addSql('DROP TABLE tipo_saida');
        $this->addSql('DROP TABLE usuario');
    }
}
