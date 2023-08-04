<?php

declare(strict_types=1);

namespace Koralex\GoodsOnCredit\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727104402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<'EOD'
            SET @dbname = DATABASE();
            SET @tablename = "oxarticles";
            SET @prepaymentColumn = "OXPREPAYMENT";
            SET @monthsremainColumn = "OXMONTHSREMAIN";
            SET @preparedStatement = (SELECT IF(
              (
                SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
                WHERE
                  (table_name = @tablename)
                  AND (table_schema = @dbname)
                  AND ((column_name = @prepaymentColumn)
                  OR (column_name = @monthsremainColumn))
              ) > 0,
              "SELECT 1",
              CONCAT("ALTER TABLE ", @tablename, " ADD ", @prepaymentColumn, " DOUBLE COMMENT 'Prepayment amount',
                                                   ADD ", @monthsremainColumn, " TINYINT(1) COMMENT 'Number of months to pay the remaining cost of the goods';")
              ));
            PREPARE alterIfNotExists FROM @preparedStatement;
            EXECUTE alterIfNotExists;
            DEALLOCATE PREPARE alterIfNotExists;
        EOD;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {

    }
}
