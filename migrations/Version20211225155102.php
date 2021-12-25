<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225155102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_room (id INT AUTO_INCREMENT NOT NULL, class_id VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, amount_student INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, time_start DATE NOT NULL, time_end DATE NOT NULL, tuition DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, student_detail_id INT NOT NULL, student_id VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_B723AF33BFBEC23B (student_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_detail (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, age INT NOT NULL, gmail VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, semester_id INT DEFAULT NULL, subject_id VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, schedule DATE NOT NULL, material VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7A4A798B6F (semester_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject_class_room (subject_id INT NOT NULL, class_room_id INT NOT NULL, INDEX IDX_1D1AFE9623EDC87 (subject_id), INDEX IDX_1D1AFE969162176F (class_room_id), PRIMARY KEY(subject_id, class_room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, age INT NOT NULL, salary DOUBLE PRECISION NOT NULL, majors VARCHAR(100) NOT NULL, avatar VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_class_room (teacher_id INT NOT NULL, class_room_id INT NOT NULL, INDEX IDX_4CFDC47441807E1D (teacher_id), INDEX IDX_4CFDC4749162176F (class_room_id), PRIMARY KEY(teacher_id, class_room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BFBEC23B FOREIGN KEY (student_detail_id) REFERENCES student_detail (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id)');
        $this->addSql('ALTER TABLE subject_class_room ADD CONSTRAINT FK_1D1AFE9623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_class_room ADD CONSTRAINT FK_1D1AFE969162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_class_room ADD CONSTRAINT FK_4CFDC47441807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_class_room ADD CONSTRAINT FK_4CFDC4749162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject_class_room DROP FOREIGN KEY FK_1D1AFE969162176F');
        $this->addSql('ALTER TABLE teacher_class_room DROP FOREIGN KEY FK_4CFDC4749162176F');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A4A798B6F');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BFBEC23B');
        $this->addSql('ALTER TABLE subject_class_room DROP FOREIGN KEY FK_1D1AFE9623EDC87');
        $this->addSql('ALTER TABLE teacher_class_room DROP FOREIGN KEY FK_4CFDC47441807E1D');
        $this->addSql('DROP TABLE class_room');
        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_detail');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE subject_class_room');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE teacher_class_room');
    }
}
